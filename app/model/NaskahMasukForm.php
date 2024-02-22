<?php

declare(strict_types=1);

namespace App\Model;

use Core\Model\FormModel;

class NaskahMasukForm extends FormModel
{
    public ?int $id=null;
    public ?string $nomor = null;
    public ?string $nomor_naskah = null;
    public ?string $perihal = null;
    public ?string $tanggal = null;
    public $file_input = null;
    public ?string $file = null;
    public ?string $asal = null;
    public ?string $keterangan = null;

    public function __construct(bool $is_edit = false)
    {
        $this->rules = [
            'nomor' => [self::REQUIRED, self::NUMERIC],
            'nomor_naskah' => self::REQUIRED,
            'perihal' => self::REQUIRED,
            'tanggal' => [self::REQUIRED,[self::DATE,'Y-m-d']],
            'asal' => self::REQUIRED
        ];
        $this->labels = [
            'nomor' => 'Nomor Urut',
            'nomor_naskah' => 'Nomor Naskah',
            'perihal' => 'Perihal',
            'tanggal' => 'Tanggal',
            'asal' => 'Asal/Pengirim',
            'file' => 'File',
            'keterangan' => 'Keterangan/Isi'
        ];
        parent::__construct($is_edit);
    }
}
