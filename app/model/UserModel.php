<?php declare(strict_types=1);

namespace App\Model;

use Core\Model\DbModel;

/**
 * UserModel
 */
class UserModel extends DbModel
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
            'username',
            'password',
            'nama',
            'role',
            'fungsi',
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
        return db()->getTable('user');
    }
}