<?php declare(strict_types=1);

namespace App\Model;

use Core\Model\DbModel;

/**
 * NaskahMasukModel
 */
class NaskahMasukModel extends NaskahModel
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
            'tahun',
            'nomor_naskah',
            'perihal',
            'tanggal',
            'asal',
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
        return db()->getTable('naskah_masuk');
    }
}