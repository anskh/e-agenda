<?php

declare(strict_types=1);

namespace App\Model;

use Core\Model\FormModel;

class LaporanKeluarForm extends FormModel
{
    public ?string $jenis = null;
    public ?string $start = null;
    public ?string $end = null;

    public function __construct(bool $is_edit = false)
    {
        $this->rules = [
            'jenis' => self::REQUIRED,
            'start' => [self::REQUIRED,[self::DATE,'Y-m-d']],
            'end' => [self::REQUIRED,[self::DATE,'Y-m-d']]
        ];
        $this->labels = [
            'jenis' => 'Jenis Naskah',
            'start' => 'Tanggal Mulai',
            'end' => 'Tanggal Berakhir'
        ];
        parent::__construct($is_edit);
    }
}
