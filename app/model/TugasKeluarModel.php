<?php declare(strict_types=1);

namespace App\Model;

use Core\Model\DbModel;

/**
 * TugasKeluarModel
 */
class TugasKeluarModel extends DbModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'tugas_keluar';
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
        return 'tugas_keluar';
    }
    
    /**
     * getNomorTerakhir
     *
     * @param  mixed $tahun
     * @return int
     */
    public static function getNomorTerakhir(string $tahun) : int
    {
        $stmt = static::db()->query("SELECT MAX(CAST(`nomor` AS UNSIGNED)) as `last` FROM " . static::db()->getTable(static::table()) ." WHERE `tahun`='" . $tahun . "' LIMIT 1");
        $result = $stmt->fetchColumn();

        return $result ? $result : 0;
    }
}