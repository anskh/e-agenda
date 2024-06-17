<?php

declare(strict_types=1);

namespace App\Model;

use Core\Model\FormModel;

class PasswordForm extends FormModel
{
    public $id = null;
    public ?string $password = null;
    public ?string $oldpassword = null;
    public ?string $repassword = null;

    public function __construct(bool $is_edit = false)
    {
        $this->rules = [
            'password' => [self::REQUIRED,[self::NOT_MATCH_FIELD, 'oldpassword']],
            'oldpassword' => self::REQUIRED,
            'repassword' => [self::REQUIRED,[self::MATCH_FIELD, 'password']]
        ];
        $this->labels = [
            'oldpassword' => 'Password Lama',
            'password' => 'Password Baru',
            'repassword' => 'Ulangi Password Baru',
        ];
        parent::__construct($is_edit);
    }
}
