<?php declare(strict_types=1);

use Core\Db\Migration;

class m0004_akses extends Migration
{
    public function __construct()
    {
        $this->table = 'akses';
    }
    public function up(): bool
    { 
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->db()->getTable($this->table) . "(
            `kode` VARCHAR(10) NOT NULL,
            `nama` VARCHAR(255) NOT NULL,
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
        $data = [
            [
                'kode' => 'B',
                'nama'=> 'Biasa',
                'create_at' => time()
            ],
            [
                'kode' => 'R',
                'nama'=> 'Rahasia',
                'create_at' => time()
            ],
            [
                'kode' => 'T',
                'nama'=> 'Terbatas',
                'create_at' => time()
            ]
        ];

        try
        {
            $this->db()->insert($data, $this->table, true);
        }catch(Exception $e){
            return false;
        }
         
        return true;
    }
}