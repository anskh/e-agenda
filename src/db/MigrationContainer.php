<?php

declare(strict_types=1);

namespace Core\Db;

use Core\Helper\Config;
use Exception;
use PDO;

/**
 * Migration Container
 * -----------
 * Class to handle apply migration
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package Core\Db
 */
class MigrationContainer
{
    private string $table;    
    
    /**
     * __construct
     *
     * @param  mixed $action
     * @param  mixed $connection
     * @return void
     */
    public function __construct(private string $action, private string $connection)
    {
        $this->table = Config::get('db.migrations.table');
    }    
     
    /**
     * db
     *
     * @return Database
     */
    protected function db(): Database
    {
        return DatabaseFactory::create($this->connection);
    }
    
    /**
     * applyMigration
     *
     * @return void
     */
    public function applyMigration(): void
    {
        try {
            $this->createIfNotExistMigrationsTable();
            $appliedMigrations = $this->getAppliedMigrations();

            $newMigrations = [];
            $path = Config::get('db.migrations.path');
            $files = scandir($path);
            if (is_array($files)) {
                $toApplyMigrations = array_diff($files, $appliedMigrations);

                foreach ($toApplyMigrations as $migration) {
                    if ($migration === '.' || $migration === '..') {
                        continue;
                    }

                    require_once $path . "/{$migration}";
                    $className = pathinfo($migration, PATHINFO_FILENAME);
                    $instance = new $className;
                    $this->log("Applying migration {$this->action} {$migration}");
                    if ($instance->{$this->action}()) {
                        if($this->action !== 'seed'){                            
                            $this->db()->delete($this->table, "migration='{$migration}'");
                        }else{
                            $this->db()->delete($this->table, "migration='{$migration}' and action='down'");
                        }
                        $newMigrations[] = $migration;
                        $this->log("Applied migration {$this->action} {$migration}");
                    } else {
                        $this->log("No applyable migration {$this->action} {$migration}");
                    }
                }
            } else {
                $this->log("No files to migrate.");
            }

            if (!empty($newMigrations)) {
                $this->saveMigrations($newMigrations);
            } else {
                $this->log("All migrations are applied");
            }
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
    
    /**
     * createIfNotExistMigrationsTable
     *
     * @return void
     */
    protected function createIfNotExistMigrationsTable()
    {
        $type = $this->db()->getType();
        $sql = '';
        $table = $this->db()->getTable($this->table);

        switch ($type) {
            case Database::MYSQL:
                $sql = "CREATE TABLE IF NOT EXISTS {$table} (" .
                    "`id` INT NOT NULL AUTO_INCREMENT ," .
                    "`migration` VARCHAR(255) NOT NULL," .
                    "`action` VARCHAR(20) NOT NULL," .
                    "`create_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP," .
                    "PRIMARY KEY (`id`)," .
                    "UNIQUE(`migration`, `action`))" .
                    "ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;";
                break;
            case Database::SQLITE:
                $sql = "CREATE TABLE IF NOT EXISTS {$table} (" .
                    "\"id\" INT NOT NULL AUTO_INCREMENT ," .
                    "\"migration\" VARCHAR(255) NOT NULL," .
                    "\"action\" VARCHAR(20) NOT NULL," .
                    "\"create_at\" TIMESTAMP DEFAULT CURRENT_TIMESTAMP," .
                    "PRIMARY KEY (\"id\")," .
                    "UNIQUE(\"migration\", \"action\"));";
                break;
            case Database::SQLSRV:
                $sql = "IF OBJECT_ID('{$table}', 'U') IS NULL CREATE TABLE {$table} (" .
                    "[id] INT IDENTITY(1,1)," .
                    "[migration] VARCHAR(255) NOT NULL," .
                    "[action] VARCHAR(20) NOT NULL," .
                    "[create_at] DATETIME DEFAULT CURRENT_TIMESTAMP," .
                    "PRIMARY KEY ([id])," .
                    "UNIQUE([migration],[action]));";
                break;
            case Database::PGSQL:
                $sql = "CREATE TABLE IF NOT EXISTS {$table} (" .
                    "\"id\" serial, " .
                    "\"migration\" VARCHAR(255) NOT NULL," .
                    "\"action\" VARCHAR(20) NOT NULL," .
                    "\"create_at\" TIMESTAMP DEFAULT CURRENT_TIMESTAMP," .
                    "PRIMARY KEY (\"id\")," .
                    "UNIQUE(\"migration\",\"action\"));";
                break;
            default:
        }
        $this->db()->exec($sql);
    }
    
        
    /**
     * getAppliedMigrations
     *
     * @return array
     */
    protected function getAppliedMigrations(): array
    {
        return $this->db()->select($this->table, 'migration',  "action='{$this->action}'", 0, -1, null, PDO::FETCH_COLUMN);
    }
    
    /**
     * saveMigrations
     *
     * @param  mixed $migrations
     * @return void
     */
    protected function saveMigrations(array $migrations)
    {
        $values = implode(",", array_map(fn ($m) => "('$m','$this->action')", $migrations));
        $table = $this->db()->getTable($this->table);
        $this->db()->exec("INSERT INTO {$table}(" . $this->db()->e('migration') . "," . $this->db()->e('action') . ") VALUES {$values}");
    }
    
    /**
     * log
     *
     * @param  mixed $message
     * @return void
     */
    protected function log(string $message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }
}
