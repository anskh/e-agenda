<?php

declare(strict_types=1);

namespace App\Model;

use Core\Model\FormModel;

class KlasifikasiForm extends FormModel
{
    public ?string $kode = null;
    public ?string $nama = null;

    public function __construct(bool $is_edit = false)
    {
        $this->rules = [
            'kode' => [self::REQUIRED, [self::MIN_LENGTH, 2], [self::CONTAINS, '.']],
            'nama' => [self::REQUIRED, [self::MIN_LENGTH, 4]]
        ];
        $this->labels = [
            'kode' => 'Kode',
            'nama' => 'Nama'
        ];
        parent::__construct($is_edit);
    }
}
