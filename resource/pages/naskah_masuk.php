<?php

use App\Model\NaskahMasukModel;
use Core\Helper\Service;
use Core\Helper\Url;
$pagination = NaskahMasukModel::pager();
$tahun = Service::session()->get('tahun');
?>
<div class="content-header">
    <h4 class="content-title">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <polyline points="9 11 12 14 20 6"></polyline>
            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
        </svg>
        <span>Naskah Dinas Masuk</span>
    </h4>
</div>
<div class="content-body">
    <?php if ($this->session->hasFlash()) {?>
        <?= render_flash($this->session->flash()) ?>
    <?php } ?>

    <div class="card mb-4">
        <div class="card-header bg-white border-bottom">
            <div>
                <h5 class="card-title mb-0">Daftar Naskah Dinas Masuk</h5>
            </div>
            <div class="ms-auto me-5">
                <form method="GET" action="<?= Url::getCurrentPath() ?>" class="row">
                    <div class="col-auto">
                        <select name="limit" onchange="this.form.submit()" class="form-select py-2">
                            <option value="10" <?= ($pagination->per_page === 10 ? 'selected' : '') ?>>10</option>
                            <option value="25" <?= ($pagination->per_page === 25 ? 'selected' : '') ?>>25</option>
                            <option value="50" <?= ($pagination->per_page === 50 ? 'selected' : '') ?>>50</option>
                            <option value="100" <?= ($pagination->per_page === 100 ? 'selected' : '') ?>>100</option>
                        </select>
                    </div>
                    <input name="page" value="<?= $pagination->current_page ?>" type="hidden">
                    <div class="col-auto"><input name="q" onchange="this.form.submit()" class="form-control" placeholder="nomor naskah atau perihal" value="<?= (empty($_GET['q']) ? '' : $_GET['q'])  ?>"></div>
                </form>
            </div>
            <div>
                <a href="<?= route('entri_naskah_masuk') ?>" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add</a>
            </div>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead class="table-light">
                    <th class="text-center">No.</th>
                    <th class="text-center">No. Naskah</th>
                    <th class="text-center">Perihal / File</th>
                    <th class="text-center">Asal/Pengirim</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Aksi</th>
                </thead>
                <tbody>
                    <?php
                    // variabel untuk nomor urut tabel
                    $no = 1;
                    foreach ($data as $row) {
                    ?>
                        <tr>
                            <td width="60" class="text-center"><?= $no++ ?></td>
                            <td width="210" class="text-center"><?= $row['nomor_naskah'] ?></td>
                            <td>
                                <div class="align-items-center">
                                    <?= $row['perihal'] ?>
                                </div>
                                <div class="align-items-center">
                                    <?php if ($row['file']) { ?>
                                        File : <a target="_blank" href="<?= upload("/{$tahun}/naskah_masuk/" . $row['file']) ?>"><i class="fa-solid fa-file-pdf"></i></a>
                                    <?php } ?>
                                </div>
                            </td>
                            <td width="200"><?= $row['asal'] ?></td>
                            <td width="120"><?= $row['tanggal'] ?></td>
                            <td width="210" class="text-center">
                                <div>
                                    <!-- button form ubah data -->
                                    <a href="<?= route('edit_naskah_masuk') . $row['id'] ?>" class="btn btn-success btn-xs"> <i class="fa-solid fa-pencil me-1"></i> Ubah </a>
                                    <!-- button modal hapus data -->
                                    <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>"> <i class="fa-solid fa-trash-can me-1"></i> Hapus </button>
                                    <!-- Modal hapus data -->
                                    <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        <i class="fa-regular fa-trash-can me-2"></i> Hapus Naskah Dinas Masuk
                                                    </h1>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p class="mb-2">Anda yakin ingin menghapus naskah dinas masuk ini?</p>
                                                    <!-- informasi data yang akan dihapus -->
                                                    <p class="fw-bold mb-2"><?= $row['nomor_naskah'] ?> <span class="fw-normal">-</span> <?= $row['perihal'] ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary rounded-pill px-3 me-2" data-bs-dismiss="modal">Batal</button>
                                                    <!-- button proses hapus data -->
                                                    <a href="<?= route('delete_naskah_masuk') . $row['id'] ?>" class="btn btn-danger rounded-pill px-3">Ya, Hapus</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white d-md-flex align-items-center">
            <div class="me-auto">
                <span class="text-secondary">Showing <?= $no>1?1:0 ?> to <?= $no - 1 ?> of <?= $pagination->total_records ?> entries</span>
            </div>
            <?= $pagination ?>
        </div>
    </div>
</div>