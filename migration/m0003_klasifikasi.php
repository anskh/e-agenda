<?php declare(strict_types=1);

use Core\Db\Migration;

class m0003_klasifikasi extends Migration
{
    public function __construct()
    {
        $this->table = 'klasifikasi';
    }
    public function up(): bool
    { 
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->db()->getTable($this->table) . "(
            `kode` VARCHAR(10) NOT NULL,
            `nama` VARCHAR(255) NOT NULL,
            `is_item` INT(11) NOT NULL default 1,
            `create_at` INT(11) NOT NULL,
            `update_at` INT(11) NULL,
            PRIMARY KEY (`kode`)
        )ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;";

        try
        {
            $this->db()->exec($sql);
        }catch(Exception $e){
            return false;
        }
         
        return true;
    }

    public function seed(): bool
    {
        return false;
    }
}