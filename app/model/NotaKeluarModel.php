<?php declare(strict_types=1);

namespace App\Model;

use Core\Model\DbModel;

/**
 * NotaKeluarModel
 */
class NotaKeluarModel extends NaskahModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->fields = [
            'nomor',
            'fungsi',
            'klasifikasi',
            'tahun',
            'nomor_naskah',
            'perihal',
            'tanggal',
            'tujuan',
            'file',
            'keterangan',
            'user_create',
            'user_update',
            'create_at',
            'updated_at'
        ];
        parent::__construct();
    }
    
    /**
     * table
     *
     * @return string
     */
    public static function table(): string
    {
        return db()->getTable('nota_keluar');
    }
}