<?php declare(strict_types=1);

namespace App\Model;

use Core\Model\DbModel;

/**
 * NaskahModel
 */
class NaskahModel extends DbModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = static::table();
        parent::__construct();
    }

    /**
     * getNomorTerakhir
     *
     * @param  mixed $tahun
     * @return int
     */
    public static function getNomorTerakhir(string $tahun) : int
    {
        $stmt = static::db()->query("SELECT MAX(CAST(`nomor` AS UNSIGNED)) as `last` FROM " . static::table() ." WHERE `tahun`='" . $tahun . "' LIMIT 1");
        $result = $stmt->fetchColumn();

        return is_bool($result) ? 0 : intval($result);
    }
}