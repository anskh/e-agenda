<?php declare(strict_types=1);

use Core\Db\Migration;

class m0001_user extends Migration
{
    public function __construct()
    {
        $this->table = 'user';
    }
    public function up(): bool
    { 
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->db()->getTable($this->table) . "(
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `username` VARCHAR(255) NOT NULL UNIQUE,
            `password` VARCHAR(255) NOT NULL,
            `nama` VARCHAR(255) NOT NULL,
            `role` VARCHAR(255) NOT NULL,
            `fungsi` VARCHAR(5) NOT NULL,
            `create_at` INT(11) NOT NULL,
            `update_at` INT(11) NULL,
            PRIMARY KEY (`id`)
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
                'username' => 'admin',
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'nama'=> 'Administrator',
                'role'=>'admin',
                'fungsi'=>'14000',
                'create_at' => time()
            ],
            [
                'username' => 'ipds',
                'password' => password_hash('ipds', PASSWORD_BCRYPT),
                'nama'=> 'User Fungsi IPDS',
                'role'=>'user',
                'fungsi'=>'14560',
                'create_at' => time()
            ],
            [
                'username' => 'umum',
                'password' => password_hash('umum', PASSWORD_BCRYPT),
                'nama'=> 'User Bagian Umum',
                'role'=>'user',
                'fungsi'=>'14510',
                'create_at' => time()
            ],
            [
                'username' => 'sosial',
                'password' => password_hash('sosial', PASSWORD_BCRYPT),
                'nama'=> 'User Fungsi Statistik Sosial',
                'role'=>'user',
                'fungsi'=>'14520',
                'create_at' => time()
            ],
            [
                'username' => 'produksi',
                'password' => password_hash('produksi', PASSWORD_BCRYPT),
                'nama'=> 'User Fungsi Statistik Produksi',
                'role'=>'user',
                'fungsi'=>'14530',
                'create_at' => time()
            ],
            [
                'username' => 'distribusi',
                'password' => password_hash('distribusi', PASSWORD_BCRYPT),
                'nama'=> 'User Fungsi Statistik Distribusi',
                'role'=>'user',
                'fungsi'=>'14540',
                'create_at' => time()
            ],
            [
                'username' => 'neraca',
                'password' => password_hash('neraca', PASSWORD_BCRYPT),
                'nama'=> 'User Fungsi Nerwilis',
                'role'=>'user',
                'fungsi'=>'14550',
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