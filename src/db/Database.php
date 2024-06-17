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
 * @package Corephp\Db
 */
class Database
{
    private PDO $pdo;
    private string $name;
    private string $prefix;
    private string $type;

    const DSN   = 'dsn';
    const USER  = 'user';
    const PASS  = 'password';

    const MYSQL  = 'mysql';
    const SQLITE = 'sqlite';
    const PGSQL  = 'pgsql';
    const SQLSRV = 'sqlsrv';

    /**
     * __construct
     *
     * @param  mixed $name
     * @param  mixed $dsn
     * @param  mixed $username
     * @param  mixed $password
     * @param  mixed $prefix
     * @param  mixed $options
     * @return void
     */
    public function __construct(string $name, string $dsn, ?string $username = null, ?string $password = null, string $prefix = '', ?array $options = null)
    {
        $this->name = $name;
        $this->prefix = $prefix;
        $this->pdo = new PDO($dsn, $username, $password, $options);
        $this->type = $this->pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
    }

    /**
     * exec
     *
     * @param  mixed $sql
     * @return int|false
     */
    public function exec($sql)
    {
        return $this->pdo->exec($sql);
    }

    /**
     * query
     *
     * @param  mixed $sql
     * @return PDOStatement|false
     */
    public function query($sql)
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
            $data = array_filter($data, function ($val) {
                return is_null($val) ? false: true;
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
     * @param  string $table
     * @param  array|string|null $where
     * @return int
     */
    public function update(array $data, string $table, $where = null): int
    {
        $affectedRows = 0;

        if (!$data) {
            return $affectedRows;
        }

        $nullString = '';
        $filterData = [];
        foreach ($data as $key => $val) {
            if (is_null($val)) {
                $nullString .= "$key=NULL,";
            } else {
                $filterData[$key] = $val;
            }
        }

        if (!empty($filterData)) {
            $sql = "UPDATE $table SET $nullString" . implode(',', array_map(fn ($attr) => $this->e($attr) . "=?", array_keys($filterData)));
        } else {
            $nullString = rtrim($nullString, ',');
            $sql = "UPDATE $table SET $nullString";
        }

        $criteria = is_array($where) ? QueryHelper::parseWhere($where) : $where ?? '';
        if ($criteria) {
            $criteria = ' WHERE ' . $criteria;
        }
        $sql .= $criteria;

        $stmt = $this->pdo->prepare($sql . ";");

        $params = is_array($where) ? array_merge(array_values($filterData), QueryHelper::parseParams($where)) : array_values($filterData);
        $params = array_filter($params, function ($val) {
            return is_null($val) ? false : true;
        });
        if ($stmt->execute($params)) {
            return $stmt->rowCount();
        }

        return $affectedRows;
    }

    /**
     * delete
     *
     * @param  string $table
     * @param  array|string|null  $where
     * @return int
     */
    public function delete(string $table, $where = null): int
    {
        $sql = "DELETE FROM $table";
        $criteria = is_array($where) ? QueryHelper::parseWhere($where) : $where ?? '';
        if ($criteria) {
            $criteria = ' WHERE ' . $criteria;
        }
        $sql .= $criteria;
        $stmt = $this->pdo->prepare($sql . ";");
        if (is_array($where)) {
            $values = QueryHelper::parseParams($where);
            if ($stmt->execute($values)) {
                return $stmt->rowCount();
            }
        } else {
            if ($stmt->execute()) {
                return $stmt->rowCount();
            }
        }

        return 0;
    }


    /**
     * select
     *
     * @param  string $table
     * @param  string $column
     * @param  array|string|null  $where
     * @param  int $limit
     * @param  int $offset
     * @param  ?string $orderby
     * @param  int $fetch
     * @return array
     */
    public function select(string $table, string $column = '*', $where = null, int $limit = 0, int $offset = -1, ?string $orderby = null, int $fetch = PDO::FETCH_ASSOC): array
    {
        $sql = "SELECT $column FROM $table";
        $criteria = is_array($where) ? QueryHelper::parseWhere($where) : $where ?? '';
        if ($criteria) {
            $criteria = ' WHERE ' . $criteria;
        }
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
        if (is_array($where)) {
            $values = QueryHelper::parseParams($where);
            $stmt->execute($values);
        } else {
            $stmt->execute();
        }
        if ($limit === 1) {
            $result = $stmt->fetch($fetch);
        } else {
            $result = $stmt->fetchAll($fetch);
        }
        return is_array($result) ? $result : [];
    }

    /**
     * getRow
     *
     * @param  string $table
     * @param  string $column
     * @param  array|string|null  $where
     * @return array
     */
    public function getRow(string $table, string $column = '*', $where = null): array
    {
        return $this->select($table, $column, $where, 1);
    }

    /**
     * getRecordCount
     *
     * @param  string $table
     * @param  array|string|null  $where
     * @return int
     */
    public function getRecordCount(string $table, $where = null): int
    {
        $criteria = is_array($where) ? QueryHelper::parseWhere($where) : $where ?? '';
        if ($criteria) {
            $criteria = ' WHERE ' . $criteria;
        }
        $stmt = $this->pdo->prepare('SELECT COUNT(FOUND_ROWS()) as `record_count` FROM ' . $table . $criteria);
        if (is_array($where)) {
            $values = QueryHelper::parseParams($where);
            $stmt->execute($values);
        } else {
            $stmt->execute();
        }
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return is_bool($result) ? 0 : intval($result);
    }

    /**
     * recordExists
     *
     * @param  string $table
     * @param  array|string|null  $where
     * @return bool
     */
    public function recordExists(string $table, $where = null): bool
    {
        $criteria = is_array($where) ? QueryHelper::parseWhere($where) : $where ?? '';
        if ($criteria) {
            $criteria = ' WHERE ' . $criteria;
        }
        $stmt = $this->pdo->prepare('SELECT EXISTS(SELECT * FROM ' . $table . $criteria . ' LIMIT 1) as `is_exists`');
        if (is_array($where)) {
            $values = QueryHelper::parseParams($where);
            $stmt->execute($values);
        } else {
            $stmt->execute();
        }
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return intval($result) === 1 ? true : false;
    }
    /**
     * drop
     *
     * @param  mixed $table
     * @return bool
     */
    public function drop(string $table): bool
    {
        $result = $this->pdo->exec("DROP TABLE {$table}");
        if ($result === false) {
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
    public function dropIfExist(string $table): bool
    {
        $result = $this->pdo->exec("DROP TABLE IF EXISTS {$table}");
        if ($result === false) {
            return false;
        }
        return true;
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
