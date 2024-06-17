<?php declare(strict_types=1);

namespace Core\Model;

use Core\AppFactory;
use Core\Db\Database;
use Core\Db\DatabaseFactory;
use Core\Http\ViewComponent\BootstrapPagination;
use PDO;

/**
 * DbModel
 * -----------
 * DbModel
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Model
 */
abstract class DbModel extends Model
{
    const ID = 'id';

    protected string $table;
    protected bool $autoIncrement = true;
    protected string $primaryKey = 'id';
    protected array $fields = [];
    protected Database $db;
    protected bool $editMode = false;
    static BootstrapPagination $pager;
    
    /**
     * __construct
     *
     * @param  mixed $db
     * @return void
     */
    public function __construct(?Database $db = null)
    {
        $this->db = $db ?? DatabaseFactory::create(AppFactory::create()->connection);

        if(!isset($this->table)){
            $arr = explode('\\', static::class);
            $this->table = $this->db->getTable(strtolower(end($arr)));
        }
        if(empty($this->fields)){
            $this->generateFields();
        }
    }
        
    /**
     * db
     *
     * @param  mixed $db
     * @return Database
     */
    protected static function db(?Database $db = null) : Database
    {
        return $db ?? DatabaseFactory::create(AppFactory::create()->connection);
    }

    
    /**
     * getTable
     *
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }
    
    /**
     * getPrimaryKey
     *
     * @return string
     */
    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }
    
    /**
     * getFields
     *
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }
        
    /**
     * load
     *
     * @param  string|int $pk
     * @return bool
     */
    public function load($pk): bool
    {
        $data = $this->db->select($this->table, '*', [$this->primaryKey . "=" => $pk], 1);
        
        if($data){
            foreach($data as $row){
                $this->fill($row);
            }
            return true;
        }

        return false;
    }
    
    /**
     * save
     *
     * @return bool
     */
    public function save(): bool
    {
        $data = [];
        foreach($this->fields as $field){
            $data[$field] = $this->{$field} ?? null;
        }

        return $this->db->insert($data, $this->table) > 0 ? true: false;
    }
         
    /**
     * getRecordCount
     *
     * @param  array|string|null  $where
     * @return int
     */
    public function getRecordCount($where = null): int
    {
        return $this->db->getRecordCount($this->table, $where);
    }    
    
    /**
     * isExists
     *
     * @param  array|string|null  $where
     * @return bool
     */
    public function isExists($where = null): bool
    {
        return $this->db->recordExists(static::table(), $where);
    }
    
    /**
     * generateFields
     *
     * @return void
     */
    protected function generateFields(): void
    {
        $stmt = $this->db->query("SELECT * FROM " . $this->db->e($this->table) . " LIMIT 0;");
        $columnCount = $stmt->columnCount();
        for ($i = 0; $i < $columnCount; $i++) {
            $col = $stmt->getColumnMeta($i);
            $this->fields[] = $col['name'];
        }

        if($this->autoIncrement){
            unset($this->fields[$this->primaryKey]);
        }
    }
    
    /**
     * table
     *
     * @return string
     */
    public static function table(): string
    {
        $arr = explode('\\', static::class);
        return static::db()->getTable(strtolower(end($arr)));
    }
    
    /**
     * primaryKey
     *
     * @return string
     */
    public static function primaryKey(): string
    {
        return static::ID;
    }

    
    /**
     * create
     *
     * @param  mixed $data
     * @param  mixed $db
     * @return int
     */
    public static function create(array $data, ?Database $db=null): int
    {
        return static::db($db)->insert($data, static::table());
    }
    
    /**
     * update
     *
     * @param  array $data
     * @param  array|string|null  $where
     * @param  mixed $db
     * @return int
     */
    public static function update(array $data, $where = null,?Database $db=null): int
    {
        return static::db($db)->update($data, static::table(), $where);
    }
    
    /**
     * delete
     *
     * @param  array|string|null  $where
     * @param  ?Database $db
     * @return int
     */
    public static function delete($where = null,?Database $db=null): int
    {
        return static::db($db)->delete(static::table(), $where);
    }
    
    /**
     * all
     *
     * @param  mixed $column
     * @param  mixed $limit
     * @param  mixed $offset
     * @param  mixed $orderby
     * @param  mixed $db
     * @return array
     */
    public static function all(string $column = '*', int $limit = 0, int $offset = -1, ?string $orderby = null,?Database $db=null): array
    {
        return static::db($db)->select(static::table(), $column, null, $limit, $offset, $orderby);
    }

    /**
     * allColumn
     *
     * @param  mixed $column
     * @param  mixed $limit
     * @param  mixed $offset
     * @param  mixed $orderby
     * @param  mixed $db
     * @return array
     */
    public static function allColumn(string $column, int $limit = 0, int $offset = -1, ?string $orderby = null, ?Database $db=null): array
    {
        return static::db($db)->select(static::table(), $column, null, $limit, $offset, $orderby, PDO::FETCH_COLUMN);
    }
    
    /**
     * row
     *
     * @param  string $column
     * @param  array|string|null  $where
     * @param  ?Database $db
     * @return array
     */
    public static function row(string $column = '*', $where = null, ?Database $db=null): array
    {       
        return static::db($db)->getRow(static::table(), $column, $where);
    }    
        
    /**
     * recordCount
     *
     * @param  array|string|null  $where
     * @param  ?Database $db
     * @return int
     */
    public static function recordCount($where = null, ?Database $db=null): int
    {       
        return static::db($db)->getRecordCount(static::table(), $where);
    }
    
    /**
     * find
     *
     * @param  array|string|null  $where
     * @param  string $column
     * @param  int $limit
     * @param  ?string $orderby
     * @param  ?Database $db
     * @return array
     */
    public static function find($where = null, string $column = '*', int $limit = 0, int $offset = -1, ?string $orderby = null, ?Database $db=null): array
    {
        return static::db($db)->select(static::table(), $column, $where, $limit, $offset, $orderby);
    }

    /**
     * paginate
     *
     * @param  array|string|null  $where
     * @param  string $column
     * @param  ?string $orderby
     * @param  ?Database $db
     * @return array
     */
    public static function paginate($where = null, string $column = '*', ?string $orderby = null, ?Database $db=null): array
    {
        $pager = new BootstrapPagination(static::recordCount($where));
        static::$pager = $pager;
        return static::db($db)->select(static::table(), $column, $where, $pager->per_page, $pager->offset, $orderby);
    }
    
    /**
     * pager
     *
     * @return BootstrapPagination
     */
    public static function pager(): BootstrapPagination
    {
        return static::$pager;
    }
              
    /**
     * findColumn
     *
     * @param  array|string|null  $where
     * @param  string $column
     * @param  int $limit
     * @param  int $offset
     * @param  ?string $orderby
     * @param  ?Database $db
     * @return array
     */
    public static function findColumn($where = null, string $column = '*', int $limit = 0, int $offset = -1, ?string $orderby = null, ?Database $db=null): array
    {
        return static::db($db)->select(static::table(), $column, $where, $limit, $offset, $orderby, PDO::FETCH_COLUMN);
    }

    /**
     * exists
     *
     * @param  array|string|null  $where
     * @param  ?Database $db
     * @return bool
     */
    public static function exists($where = null, ?Database $db=null): bool
    {
        return static::db($db)->recordExists(static::table(), $where);
    }
}