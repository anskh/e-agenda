<?php declare(strict_types=1);

namespace App\Model;

use Core\Model\DbModel;

class KlasifikasiModel extends DbModel
{
    public function __construct()
    {
        $this->table = 'klasifikasi';
        $this->fields = [
            'kode',
            'nama',
            'create_at',
            'updated_at'
        ];
        $this->primaryKey = 'kode';
        $this->autoIncrement = false;
        parent::__construct();
    }

    public static function table(): string
    {
        return 'klasifikasi';
    }
    public static function primaryKey(): string{
        return 'kode';
    }
}