<?php

declare(strict_types=1);

namespace Core\Db;

use Core\AppFactory;
use Exception;

/**
 * Migration
 * -----------
 * Class to handle migration file
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Db
 */
abstract class Migration
{
    protected string $table;
    protected string $create_at = 'create_at';
    protected string $update_at = 'update_at';
    
    private ?Database $db = null;
    
    /**
     * up
     *
     * @return bool
     */
    public abstract function up(): bool;
    
    /**
     * seed
     *
     * @return bool
     */
    public abstract function seed(): bool;
    
    /**
     * down
     *
     * @return bool
     */
    public function down(): bool
    {
        try {
            $this->db()->dropIfExist($this->table);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }    
    /**
     * db
     *
     * @return Database
     */
    protected function db(): Database
    {
        if ($this->db === null) {
            $this->db = DatabaseFactory::create(AppFactory::create()->connection);
        }
        return $this->db;
    }
}
