<?php declare(strict_types=1);

use Core\Db\Migration;

class m0012_permission extends Migration
{
    public function __construct()
    {
        $this->table = 'permission';
    }
    public function up(): bool
    { 
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->db()->getTable($this->table) . "(
            `nama` VARCHAR(100) NOT NULL,
            `user` INT(1) NOT NULL DEFAULT 0,
            `admin` INT(1) NOT NULL DEFAULT 0,
            `create_at` INT(11) NOT NULL,
            `update_at` INT(11) NULL,
            PRIMARY KEY(`nama`)
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
            ['nama' => 'home','user'=>1,'admin'=>1,'create_at'=>time()],
            ['nama' => 'edit_password','user'=>1,'admin'=>1,'create_at'=>time()],
            ['nama' => 'profil','user'=>1,'admin'=>1,'create_at'=>time()],
            ['nama' => 'login','user'=>1,'admin'=>1,'create_at'=>time()],
            ['nama' => 'logout','user'=>1,'admin'=>1,'create_at'=>time()],
            ['nama' => 'user','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'entri_user','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'edit_user','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'delete_user','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'klasifikasi','user'=>1,'admin'=>1,'create_at'=>time()],
            ['nama' => 'entri_klasifikasi','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'edit_klasifikasi','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'delete_klasifikasi','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'fungsi','user'=>1,'admin'=>1,'create_at'=>time()],
            ['nama' => 'entri_fungsi','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'edit_fungsi','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'delete_fungsi','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'akses','user'=>1,'admin'=>1,'create_at'=>time()],
            ['nama' => 'entri_akses','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'edit_akses','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'delete_akses','user'=>0,'admin'=>1,'create_at'=>time()],
            ['nama' => 'memo_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'entri_memo_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'edit_memo_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'delete_memo_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'nota_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'entri_nota_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'edit_nota_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'delete_nota_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'tugas_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'entri_tugas_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'edit_tugas_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'delete_tugas_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'dinas_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'entri_dinas_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'edit_dinas_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'delete_dinas_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'internal_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'entri_internal_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'edit_internal_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'delete_internal_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'eksternal_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'entri_eksternal_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'edit_eksternal_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'delete_eksternal_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'naskah_masuk','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'entri_naskah_masuk','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'edit_naskah_masuk','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'delete_naskah_masuk','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'laporan_masuk','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'cetak_laporan_masuk','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'laporan_keluar','user'=>1,'admin'=>0,'create_at'=>time()],
            ['nama' => 'cetak_laporan_keluar','user'=>1,'admin'=>0,'create_at'=>time()]
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