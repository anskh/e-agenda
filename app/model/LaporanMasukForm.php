<?php

declare(strict_types=1);

namespace App\Model;

use Core\Model\FormModel;

class LaporanMasukForm extends FormModel
{
    public ?string $start = null;
    public ?string $end = null;

    public function __construct(bool $is_edit = false)
    {
        $this->rules = [
            'start' => [self::REQUIRED,[self::DATE,'Y-m-d']],
            'end' => [self::REQUIRED,[self::DATE,'Y-m-d']]
        ];
        $this->labels = [
            'start' => 'Tanggal Mulai',
            'end' => 'Tanggal Berakhir'
        ];
        parent::__construct($is_edit);
    }
}
