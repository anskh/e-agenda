<?php

use App\Model\UserModel;
use Core\Helper\Url;

$pagination = UserModel::pager(); 
?>
<div class="content-header">
    <h4 class="content-title">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <circle cx="12" cy="7" r="4"></circle>
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
        </svg>&nbsp;
        <span>Pengguna</span>
    </h4>
</div>
<div class="content-body">
    <?php if (session()->hasFlash()) {
        $flashes = session()->flash();
        if (is_array($flashes)) {
            foreach ($flashes as $flash) {
    ?>
                <div class="alert alert-<?= $flash->getType() ?> shadow" role="alert">
                    <div class="pe-3 me-auto">
                        <p class="fw-semibold mb-0"><?= $flash ?></p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>

    <div class="card mb-4">
        <div class="card-header bg-white border-bottom">
            <div>
                <h5 class="card-title mb-0">Daftar Pengguna</h5>
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
                    <div class="col-auto"><input name="q" onchange="this.form.submit()" class="form-control" placeholder="username atau nama" value="<?= (empty($_GET['q']) ? '' : $_GET['q'])  ?>"></div>
                </form>
            </div>
            <?php if(auth()->hasPermission('entri_user')){ ?>
            <div>
                <a href="<?= route('entri_user') ?>" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add</a>
            </div>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered table-striped table-hover" style="width:100%">
                <thead class="table-light">
                    <th class="text-center">No.</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Fungsi</th>
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
                            <td width="100"><?= $row['username'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td width="120"><?= $row['role'] ?></td>
                            <td width="80"><?= $row['fungsi'] ?></td>
                            <?php if (auth()->hasRole('admin')) : ?>
                                <td width="210" class="text-center">
                                    <div>
                                        <!-- button form ubah data -->
                                        <a href="<?= base_url('/user/edit/' . $row['id']) ?>" class="btn btn-xs btn-success"><i class="fa-solid fa-pencil me-1"></i>Ubah</a>
                                        <!-- button modal hapus data -->
                                        <button type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $no ?>"> <i class="fa-solid fa-trash-can me-1"></i>Hapus</button>
                                        <!-- Modal hapus data -->
                                        <div class="modal fade" id="modalHapus<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            <i class="fa-regular fa-trash-can me-2"></i> Hapus Data Pengguna
                                                        </h1>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <p class="mb-2">Anda yakin ingin menghapus data pengguna?</p>
                                                        <!-- informasi data yang akan dihapus -->
                                                        <p class="fw-bold mb-2"><?= $row['username'] ?> <span class="fw-normal">-</span> <?= $row['nama'] ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary rounded-pill px-3 me-2" data-bs-dismiss="modal">Batal</button>
                                                        <!-- button proses hapus data -->
                                                        <a href="<?= base_url('/user/delete/' . $row['id'])  ?>" class="btn btn-danger rounded-pill px-3">Ya, Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white d-md-flex align-items-center">
            <div class="me-auto">
                <span class="text-secondary">Showing <?= $no > 1 ? 1 : 0 ?> to <?= $no - 1 ?> of <?= $pagination->total_records ?> entries</span>
            </div>
            <?= $pagination ?>
        </div>
    </div>
</div>