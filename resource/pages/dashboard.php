<?php

use App\Helper\Service;
use App\Model\DinasKeluarModel;
use App\Model\EksternalKeluarModel;
use App\Model\InternalKeluarModel;
use App\Model\MemoKeluarModel;
use App\Model\NaskahMasukModel;
use App\Model\NotaKeluarModel;
use App\Model\TugasKeluarModel;
use App\Model\UserModel;

$tahun = Service::session()->get('tahun');
$memo = MemoKeluarModel::recordCount(['tahun='=>$tahun]);
$nota = NotaKeluarModel::recordCount(['tahun='=>$tahun]);
$tugas = TugasKeluarModel::recordCount(['tahun='=>$tahun]);
$dinas = DinasKeluarModel::recordCount(['tahun='=>$tahun]);
$internal = InternalKeluarModel::recordCount(['tahun='=>$tahun]);
$eksternal = EksternalKeluarModel::recordCount(['tahun='=>$tahun]);
$total = $memo + $nota + $tugas + $dinas + $internal + $eksternal;
?>
<div class="content-header">
    <h4 class="content-title ~mx-auto">Dashboard</h4>
</div>
<?php if ($this->session->hasFlash()) { ?>
    <?= render_flash($this->session->flash()) ?>
<?php } ?>
<div class="content-body">
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card mb-4">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <div class="w-12 h-12 bg-success me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                            <svg class="h-6 w-6 text-white" x-description="Heroicon name: outline/mail-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="mb-1">
                            <span class="text-secondary">Jumlah Naskah Dinas Masuk</span>
                        </div>
                        <span class="h3 mb-0 lh-1"><?= NaskahMasukModel::recordCount(['tahun='=>$tahun]) ?></span>
                    </div>
                </div>
                <?php if (auth()->hasPermission('naskah_masuk')) { ?>
                    <div class="card-footer py-3">
                        <a href="<?= route('naskah_masuk') ?>" class="text-decoration-none">Selengkapnya...</a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card mb-4">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <div class="w-12 h-12 bg-primary me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                            <svg class="h-6 w-6 text-white" x-description="Heroicon name: outline/cursor-click" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="mb-1">
                            <span class="text-secondary">Jumlah Naskah Dinas Keluar</span>
                        </div>
                        <span class="h3 mb-0 lh-1"><?= $total ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card mb-4">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <div class="w-12 h-12 bg-info me-4 rounded-3 d-flex align-items-center justify-content-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="">
                            <small class="text-secondary">Jumlah Pengguna</small>
                        </div>
                        <div class="d-flex justify-content-end">
                            <span class="h2 mb-0 lh-1"><?= UserModel::recordCount() ?></span>
                        </div>
                    </div>
                </div>
                <?php if (auth()->hasPermission('user')) { ?>
                    <div class="card-footer py-3">
                        <a href="<?= route('user') ?>" class="text-decoration-none">Selengkapnya...</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="content-header">
        <h5 class="content-title">Naskah Dinas Keluar menurut Jenisnya Tahun <?= $tahun ?></h5>
    </div>
    <div class="card mb-4 col-xl-8">
        <table class="table table-striped table-hover mb-0">
            <thead>
                <tr>
                    <th class="text-center" scope="col">NO</th>
                    <th class="text-center" scope="col">JENIS NASKAH DINAS</th>
                    <th class="text-center" scope="col">JUMLAH</th>
                    <?php if (auth()->hasRole('user')) { ?>
                        <th class="text-center" scope="col">AKSI</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center" width="60">1</td>
                    <td>Memorandum</td>
                    <td class="text-center"><?= $memo ?></td>
                    <?php if (auth()->hasPermission('memo_keluar')) { ?>
                        <td class="text-center"><a href="<?= route('memo_keluar') ?>" class="text-decoration-none">Selengkapnya...</a></th>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="text-center">2</td>
                    <td>Nota Dinas/KAK/Form Belanja</td>
                    <td class="text-center"><?= $nota ?></td>
                    <?php if (auth()->hasPermission('nota_keluar')) { ?>
                        <td class="text-center"><a href="<?= route('nota_keluar') ?>" class="text-decoration-none">Selengkapnya...</a></th>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="text-center">3</td>
                    <td>Surat Tugas</td>
                    <td class="text-center"><?= $tugas ?></td>
                    <?php if (auth()->hasPermission('tugas_keluar')) { ?>
                        <td class="text-center"><a href="<?= route('tugas_keluar') ?>" class="text-decoration-none">Selengkapnya...</a></th>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="text-center">4</td>
                    <td>Surat Dinas</td>
                    <td class="text-center"><?= $dinas ?></td>
                    <?php if (auth()->hasPermission('dinas_keluar')) { ?>
                        <td class="text-center"><a href="<?= route('dinas_keluar') ?>" class="text-decoration-none">Selengkapnya...</a></th>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="text-center">5</td>
                    <td>Undangan Internal</td>
                    <td class="text-center"><?= $internal ?></td>
                    <?php if (auth()->hasPermission('internal_keluar')) { ?>
                        <td class="text-center"><a href="<?= route('internal_keluar') ?>" class="text-decoration-none">Selengkapnya...</a></th>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="text-center">6</td>
                    <td>Undangan Eksternal</td>
                    <td class="text-center"><?= $eksternal ?></td>
                    <?php if (auth()->hasPermission('eksternal_keluar')) { ?>
                        <td class="text-center"><a href="<?= route('eksternal_keluar') ?>" class="text-decoration-none">Selengkapnya...</a></th>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>