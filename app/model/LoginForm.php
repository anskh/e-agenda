<?php

declare(strict_types=1);

namespace App\Model;

use Core\Model\FormModel;

class LoginForm extends FormModel
{
    public ?string $username = null;
    public ?string $password = null;
    public ?string $tahun = null;

    public function __construct(bool $is_edit = false)
    {
        $this->rules = [
            'username' => self::REQUIRED,
            'password' => self::REQUIRED,
            'tahun' => [self::REQUIRED, self::NUMERIC]
        ];
        $this->labels = [
            'username' => 'Username',
            'password' => 'Password',
            'tahun' => 'Tahun'
        ];
        parent::__construct($is_edit);
    }
}
