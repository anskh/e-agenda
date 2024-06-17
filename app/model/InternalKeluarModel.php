<?php declare(strict_types=1);

namespace App\Model;

/**
 * InternalKeluarModel
 */
class InternalKeluarModel extends NaskahModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->fields = [
            'akses',
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
        return db()->getTable('internal_keluar');
    }
}