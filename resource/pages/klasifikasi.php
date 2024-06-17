<?php

use App\Model\KlasifikasiModel;
use Core\Helper\Url;
$pagination = KlasifikasiModel::pager();
?>
<div class="content-header">
    <h4 class="content-title">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <rect x="4" y="4" width="16" height="16" rx="2"></rect>
            <line x1="4" y1="10" x2="20" y2="10"></line>
            <line x1="10" y1="4" x2="10" y2="20"></line>
        </svg>
        <span>Master Klasifikasi Naskah Dinas</span>
    </h4>
</div>
<div class="content-body">
    <?php if ($this->session->hasFlash()) {?>
        <?= render_flash($this->session->flash()) ?>
    <?php } ?>

    <div class="card mb-4">
        <div class="card-header bg-white border-bottom">
            <div>
                <h5 class="card-title mb-0">Daftar Klasifikasi Naskah Dinas</h5>
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
                    <div class="col-auto"><input name="q" onchange="this.form.submit()" class="form-control" placeholder="kode atau nama" value="<?= (empty($_GET['q']) ? '' : $_GET['q'])  ?>"></div>
                </form>
            </div>
            <?php if(auth()->hasPermission('entri_klasifikasi')) { ?>
            <div>
                <a href="<?= route('entri_klasifikasi') ?>" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add</a>
            </div>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead class="table-light">
                    <th class="text-center">No.</th>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama</th>
                    <?php if (auth()->hasRole('admin')) : ?>
                        <th class="text-center">Aksi</th>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <?php
                    // variabel untuk nomor urut tabel
                    $no = 1;
                    foreach ($data as $row) {
                    ?>
                        <tr>
                            <td width="60" class="text-center"><?= $no++ ?></td>
                            <td width="70"><?= $row['kode'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <?php if (auth()->hasPermission('edit_klasifikasi') && auth()->hasPermission('delete_klasifikasi')) { ?>
                                <td width="210" class="text-center">
                                    <div>
                                        <!-- button form ubah data -->
                                        <a href="<?= base_url('/klasifikasi/edit/' . $row['kode']) ?>" class="btn btn-xs btn-success"> <i class="fa-solid fa-pencil me-1"></i> Ubah </a>
                                        <!-- button modal hapus data -->
                                        <button type="button" class="btn btn-danger btn-xs" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>"> <i class="fa-solid fa-trash-can me-1"></i> Hapus </button>
                                        <!-- Modal hapus data -->
                                        <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            <i class="fa-regular fa-trash-can me-2"></i> Hapus Data Klasifikasi
                                                        </h1>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <p class="mb-2">Anda yakin ingin menghapus data klasifikasi?</p>
                                                        <!-- informasi data yang akan dihapus -->
                                                        <p class="fw-bold mb-2"><?= $row['kode']; ?> <span class="fw-normal">-</span> <?= $row['nama'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary rounded-pill px-3 me-2" data-bs-dismiss="modal">Batal</button>
                                                        <!-- button proses hapus data -->
                                                        <a href="<?= base_url('/klasifikasi/delete/' . $row['kode'])  ?>" class="btn btn-danger rounded-pill px-3">Ya, Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            <?php } ?>
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