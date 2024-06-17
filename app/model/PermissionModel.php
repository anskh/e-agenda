<?php declare(strict_types=1);

namespace App\Model;

use Core\Model\DbModel;

/**
 * PermissionModel
 */
class PermissionModel extends DbModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = static::table();
        $this->fields = [
            'nama',
            'user',
            'admin',
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
        return db()->getTable('permission');
    }
}