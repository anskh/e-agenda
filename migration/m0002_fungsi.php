<?php declare(strict_types=1);

use Core\Db\Migration;

class m0002_fungsi extends Migration
{
    public function __construct()
    {
        $this->table = 'fungsi';
    }
    public function up(): bool
    { 
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->db()->getTable($this->table) . "(
            `kode` VARCHAR(5) NOT NULL,
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
                'kode' => '14000',
                'nama'=> 'BPS Provinsi Riau',
                'create_at' => time()
            ],
            [
                'kode' => '14510',
                'nama'=> 'Bagian Umum',
                'create_at' => time()
            ],
            [
                'kode' => '14520',
                'nama'=> 'Fungsi Statistik Sosial',
                'create_at' => time()
            ],
            [
                'kode' => '14530',
                'nama'=> 'Fungsi Statistik Produksi',
                'create_at' => time()
            ],
            [
                'kode' => '14540',
                'nama'=> 'Fungsi Statistik Distribusi',
                'create_at' => time()
            ],
            [
                'kode' => '14550',
                'nama'=> 'Fungsi Nerwilis',
                'create_at' => time()
            ],
            [
                'kode' => '14560',
                'nama'=> 'Fungsi IPDS',
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