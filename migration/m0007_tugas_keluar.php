<?php declare(strict_types=1);

use Core\Db\Migration;

class m0007_tugas_keluar extends Migration
{
    public function __construct()
    {
        $this->table = 'tugas_keluar';
    }
    public function up(): bool
    { 
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->db()->getTable($this->table) . "(
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `akses` VARCHAR(10) NOT NULL,
            `nomor` VARCHAR(10) NOT NULL,
            `fungsi` VARCHAR(5) NOT NULL,
            `klasifikasi` VARCHAR(10) NOT NULL,
            `tahun` VARCHAR(4) NOT NULL,
            `nomor_naskah` VARCHAR(50) NOT NULL UNIQUE,
            `perihal` VARCHAR(255) NOT NULL,
            `tujuan` VARCHAR(255) NOT NULL,
            `tanggal` DATE NOT NULL,
            `file` VARCHAR(255) NULL,
            `keterangan` VARCHAR(255) NULL,
            `user_create` INT(11) NOT NULL,
            `user_update` INT(11) NULL,
            `create_at` INT(11) NOT NULL,
            `update_at` INT(11) NULL,
            PRIMARY KEY(`id`)
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