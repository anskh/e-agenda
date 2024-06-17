<?php

declare(strict_types=1);

namespace App\Model;

use Core\Model\FormModel;

class UserForm extends FormModel
{
    public $id = null;
    public ?string $username = null;
    public ?string $password = null;
    public ?string $repassword = null;
    public ?string $nama = null;
    public ?string $role = null;
    public ?string $fungsi = null;

    public function __construct(bool $is_edit = false)
    {
        $this->rules = [
            'username' => self::REQUIRED,
            'password' => self::REQUIRED,
            'nama'=>[self::REQUIRED,[self::MIN_LENGTH, 4]],
            'role'=>[self::REQUIRED,[self::IN_LIST,['user','admin','user,admin','admin,user']]],
            'fungsi'=>[self::REQUIRED,[self::LENGTH, 5]]
        ];
        if(!$is_edit){
            $this->rules['repassword'] = [self::REQUIRED, [self::MATCH_FIELD, 'password']];
        }
        $this->labels = [
            'username' => 'Username',
            'password' => 'Password',
            'repassword' => 'Ulangi Password',
            'nama' => 'Nama',
            'role' => 'Role',
            'fungsi' => 'Bagian/Fungsi'
        ];
        parent::__construct($is_edit);
    }
}
