<?php

declare(strict_types=1);

namespace App\Model;

use Core\Model\FormModel;

class EksternalKeluarForm extends FormModel
{
    public ?int $id=null;
    public ?string $akses = null;
    public ?string $nomor = null;
    public ?string $fungsi = null;
    public ?string $klasifikasi = null;
    public ?string $nomor_naskah = null;
    public ?string $perihal = null;
    public ?string $tanggal = null;
    public $file_input = null;
    public ?string $file = null;
    public ?string $tujuan = null;
    public ?string $keterangan = null;

    public function __construct(bool $is_edit = false)
    {
        $this->rules = [
            'akses' => self::REQUIRED,
            'nomor' => [self::REQUIRED, self::NUMERIC],
            'fungsi' => self::REQUIRED,
            'klasifikasi' => self::REQUIRED,
            'nomor_naskah' => self::REQUIRED,
            'perihal' => self::REQUIRED,
            'tanggal' => [self::REQUIRED,[self::DATE,'Y-m-d']],
            'tujuan' => self::REQUIRED
        ];
        $this->labels = [
            'akses' => 'Akses/Keamanan Surat',
            'nomor' => 'Nomor Urut',
            'fungsi' => 'Bagian/Fungsi',
            'klasifikasi' => 'Klasifikasi',
            'perihal' => 'Perihal',
            'tanggal' => 'Tanggal',
            'tujuan' => 'Tujuan/Penerima',
            'file' => 'File',
            'keterangan' => 'Keterangan/Isi'
        ];
        parent::__construct($is_edit);
    }

    public function generateNomorNaskah(): void
    {
        $this->nomor_naskah =  sprintf("%s-%s/%s/%s/%s"
            ,$this->akses
            ,$this->nomor
            ,$this->fungsi
            ,$this->klasifikasi
            ,substr($this->tanggal,0,4)
        );
    }
}
