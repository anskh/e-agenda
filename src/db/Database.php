<?php

declare(strict_types=1);

namespace Core\Db;

use PDO;
use PDOStatement;

/**
 * Database
 * -----------
 * Class for working with database
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Db
 */
class Database
{
    private PDO $pdo;
    private string $name;
    private string $prefix;
    private string $type;

    const DSN   = 'dsn';
    const USER  = 'user';
    const PASS  = 'pass';

    const MYSQL  = 'mysql';
    const SQLITE = 'sqlite';
    const PGSQL  = 'pgsql';
    const SQLSRV = 'sqlsrv';
    
    /**
     * __construct
     *
     * @param  mixed $name
     * @param  mixed $dsn
     * @param  mixed $user
     * @param  mixed $pass
     * @param  mixed $prefix
     * @param  mixed $options
     * @return void
     */
    public function __construct(string $name, string $dsn, string $user, string $pass, string $prefix = '', ?array $options =null)
    {
        $this->name = $name;
        $this->prefix = $prefix;
        $this->pdo = new PDO($dsn, $user, $pass, $options);
        $this->type = $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    }
    
    /**
     * exec
     *
     * @param  mixed $sql
     * @return int
     */
    public function exec($sql): int|false
    {
        return $this->pdo->exec($sql);
    }    

    /**
     * query
     *
     * @param  mixed $sql
     * @return PDOStatement
     */
    public function query($sql): PDOStatement|false
    {
        return $this->pdo->query($sql);
    }
        
    /**
     * getConnectionName
     *
     * @return string
     */
    public function getConnectionName(): string
    {
        return $this->name;
    }    
    /**
     * getDbPrefix
     *
     * @return string
     */
    public function getDbPrefix(): string
    {
        return $this->prefix;
    }    
    /**
     * getTable
     *
     * @param  mixed $table
     * @return string
     */
    public function getTable(string $table): string
    {
        return $this->e($this->prefix . $table);
    }
    
    /**
     * insert
     *
     * @param  mixed $data
     * @param  mixed $table
     * @param  mixed $insertBatch
     * @return int
     */
    public function insert(array $data, string $table, bool $insertBatch = false): int
    {
        $affectedRows = 0;

        if (!$data) {
            return $affectedRows;
        }

        if ($insertBatch) {
            foreach ($data as $row) {
                $affectedRows += $this->insert($row, $table);
            }
        } else {
            $table = $this->getTable($table);
            $data = array_filter($data, function(mixed $val){
                return $val ? true : false;
            });
            $keys = array_keys($data);
            $sql = "INSERT INTO $table(" .  implode(',', array_map(fn ($attr) => $this->e($attr), $keys)) . ")VALUES(" . implode(',', array_fill(0, count($keys), '?')) . ");";
            $stmt = $this->pdo->prepare($sql);
            if ($stmt->execute(array_values($data))) {
                $affectedRows += $stmt->rowCount();
            }
        }

        return $affectedRows;
    }
    
    /**
     * update
     *
     * @param  mixed $data
     * @param  mixed $table
     * @param  mixed $where
     * @return int
     */
    public function update(array $data, string $table, array|string|null $where = null): int
    {
        $affectedRows = 0;

        if (!$data) {
            return $affectedRows;
        }

        $table = $this->getTable($table);

        $nullString = '';
        $filterData = [];
        foreach ($data as $key => $val) {
            if (!$val) {
                $nullString .= "$key=NULL,";
            } else {
                $filterData[$key] = $val;
            }
        }

        if ($filterData) {
            $sql = "UPDATE $table SET $nullString" . implode(',', array_map(fn ($attr) => $this->e($attr) . "=?", array_keys($filterData)));
        } else {
            $nullString = rtrim($nullString, ',');
            $sql = "UPDATE $table SET $nullString";
        }

        $criteria = $this->parseWhere($where);
        if(is_array($where) && count($where ?? []) > 2) {
            array_pop($where);
        }
        $sql .= $criteria;
        
        $stmt = $this->pdo->prepare($sql . ";");

        $params = is_array($where) ? array_merge(array_values($filterData), array_values($where)) : array_values($filterData);
        $params = array_filter($params, function(mixed $val){
            return $val ? true : false;
        });
        if ($stmt->execute($params)) {
            return $stmt->rowCount();
        }

        return $affectedRows;
    }
    
    /**
     * delete
     *
     * @param  mixed $table
     * @param  mixed $where
     * @return int
     */
    public function delete(string $table, array|string|null $where = null): int
    {
        $table = $this->getTable($table);
        $sql = "DELETE FROM $table";
        $criteria = $this->parseWhere($where);
        $sql .= $criteria;
        $stmt = $this->pdo->prepare($sql . ";");
        if(is_array($where)){
            if(count($where)>2){
                array_pop($where);
            }
            if($stmt->execute(array_values($where))){
                return $stmt->rowCount();
            }
        }else{
            if($stmt->execute()){
                return $stmt->rowCount();
            }
        }

        return 0;
    }
    
    /**
     * select
     *
     * @param  mixed $table
     * @param  mixed $column
     * @param  mixed $where
     * @param  mixed $limit
     * @param  mixed $orderby
     * @param  mixed $fetch
     * @return array
     */
    public function select(string $table, string $column = '*', array|string|null $where = null, int $limit=0, int $offset= -1, string|null $orderby = null, int $fetch = PDO::FETCH_ASSOC): array
    { 
        return $this->select_query($table, $column, $where, $limit, $offset, $orderby, $fetch);
    }
    
    /**
     * select_query
     *
     * @param  mixed $table
     * @param  mixed $column
     * @param  mixed $where
     * @param  int $limit
     * @param  int $offset
     * @param  mixed $orderby
     * @param  mixed $fetch
     * @return array
     */
    private function select_query(string $table, string $column = '*', array|string|null $where = null, int $limit = 0, int $offset = -1, string|null $orderby = null, int $fetch = PDO::FETCH_ASSOC): array {
        $table = $this->getTable($table);
        $sql = "SELECT $column FROM $table";
        $criteria = $this->parseWhere($where);
        $sql .= $criteria;
        $result = [];

        if ($orderby) {
            $sql .= " ORDER BY " . $orderby;
        }

        if ($offset >= 0) {
            $sql .= " LIMIT {$offset}";
            if ($limit > 0) {
                $sql .= ",{$limit}";
            }
        }
        
        $stmt = $this->pdo->prepare($sql . ";");
        if(is_array($where)){
            if(count($where)>2){
                array_pop($where);
            }
            $stmt->execute(array_values($where));
        }else{
            $stmt->execute();
        }
        if($limit===1){
            $result = $stmt->fetch($fetch);
        }else{
            $result = $stmt->fetchAll($fetch);
        }
        return $result ? $result: [];
    }
    
    /**
     * getRow
     *
     * @param  mixed $table
     * @param  mixed $column
     * @param  mixed $where
     * @return array
     */
    public function getRow(string $table, string $column = '*', array|string|null $where = null): array
    {       
        return $this->select_query($table, $column, $where, 1);
    }
    
    /**
     * getRecordCount
     *
     * @param  mixed $table
     * @param  mixed $where
     * @return int
     */
    public function getRecordCount(string $table, array|string|null $where = null) : int {
        $table = $this->getTable($table);
        $criteria = $this->parseWhere($where); 
        $stmt = $this->pdo->prepare('SELECT COUNT(FOUND_ROWS()) as `record_count` FROM ' . $table . $criteria);
        if(is_array($where)){
            if(count($where)>2){
                array_pop($where);
            }
            $stmt->execute(array_values($where));
        }else{
            $stmt->execute();
        }
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result === false ? 0 : $result;
    }
        
    /**
     * recordExists
     *
     * @param  mixed $table
     * @param  mixed $where
     * @return bool
     */
    public function recordExists(string $table, array|string|null $where = null) : bool {
        $table = $this->getTable($table);
        $criteria = $this->parseWhere($where);  
        $stmt = $this->pdo->prepare('SELECT EXISTS(SELECT * FROM ' . $table . $criteria .' LIMIT 1) as `is_exists`');
        if(is_array($where)){
            if(count($where)>2){
                array_pop($where);
            }
            $stmt->execute(array_values($where));
        }else{
            $stmt->execute();
        }
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result === 1 ? true: false;
    }    
    /**
     * drop
     *
     * @param  mixed $table
     * @return bool
     */
    public function drop(string $table) : bool
    {
        $result = $this->pdo->exec("DROP TABLE {$this->getTable($table)}");
        if($result === false) {
            return false;
        }
        return true;
    }    
    /**
     * dropIfExist
     *
     * @param  mixed $table
     * @return bool
     */
    public function dropIfExist(string $table) : bool
    {
        $result = $this->pdo->exec("DROP TABLE IF EXISTS {$this->getTable($table)}");
        if($result === false) {
            return false;
        }
        return true;
    }    
    /**
     * parseWhere
     *
     * @param  mixed $where
     * @return string
     */
    public function parseWhere(string|array|null $where = null) : string
    {
        $string_where = '';
        if ($where) {
            if (is_string($where)):
                $string_where .= " WHERE " . $where;
            elseif (is_array($where)):
                $op = '';
                if (count($where) > 2) {
                    $op = ' ' . array_pop($where) . ' ';
                }
                $keys = array_keys($where);
                $whereParams = array_map(fn ($attr) => "$attr?", $keys);
                $string_where .= " WHERE " . implode($op, $whereParams);
            endif;
        }
        return $string_where;
    }
    
    /**
     * getType
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    
    /**
     * e
     *
     * @param  mixed $attribute
     * @return string
     */
    public function e(string $attribute): string
    {
        $type = $this->getType();

        switch ($type) {
            case static::MYSQL:
                return '`' . $attribute . '`';
                break;
            case static::SQLITE:
            case static::PGSQL:
                return '"' . $attribute . '"';
                break;
            case static::SQLSRV:
                return '[' . $attribute . ']';
                break;
            default:
                return $attribute;
        }
    }
}
