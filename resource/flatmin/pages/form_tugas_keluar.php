<div class="content-header">
    <h4 class="content-title ~mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <polyline points="9 11 12 14 20 6"></polyline>
            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
        </svg>&nbsp;
        <span>Surat Tugas Keluar</span>
    </h4>
</div>
<?php

use App\Model\AksesModel;
use App\Model\FungsiModel;
use App\Model\KlasifikasiModel;
use Core\Http\ViewComponent\BootstrapFormFactory;
use Core\Helper\Service;

$tahun = Service::session()->get('tahun');
$form = BootstrapFormFactory::create($model);
if ($model->isEdit()) {
    $action = route('edit_tugas_keluar') . $model->id;
} else {
    $action = route('entri_tugas_keluar');
}
?>
<div class="content-body">
    <div class="card mb-5 col-xl-8">
        <?= $form->begin($action, 'POST', ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate']) ?>
        <div class="card-body">
            <h4 class="card-title py-1 mb-5"><?= $model->isEdit() ? 'Ubah ' : 'Tambah ' ?>Nota Dinas Keluar</h4>
            <?php
            if ($model->hasError()) { ?>
                <?= render_error_form($model) ?>
            <?php } ?>
            <?= $form->csrfField() ?>
            <div class="row mb-3">
                <div class="col-xl-3">
                    <label class="text-muted" for="nomor"><?= $model->getLabel('nomor') ?><span class="text-danger">*</span></label>
                    <?= $form->input('nomor', 'text', ['class' => 'form-control', 'disabled', 'readonly']) ?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-xl-3">
                    <label class="text-muted" for="akses"><?= $model->getLabel('akses') ?><span class="text-danger">*</span></label>
                    <?= $form->select('akses', AksesModel::all('kode,nama'), ['required', 'class' => 'form-select'], $model->akses, 'kode', 'nama') ?>
                </div>
                <div class="mb-3 col-xl-4">
                    <label class="text-muted" for="fungsi"><?= $model->getLabel('fungsi') ?><span class="text-danger">*</span></label>
                    <?= $form->select('fungsi', FungsiModel::all('kode,nama'), ['required', 'class' => 'form-select'], $model->fungsi, 'kode', 'nama') ?>
                </div>
                <div class="mb-3 col-xl-2">
                    <label class="text-muted" for="klasifikasi"><?= $model->getLabel('klasifikasi') ?><span class="text-danger">*</span></label>
                    <?= $form->list('klasifikasi', KlasifikasiModel::findColumn(['is_item=' => 1], 'kode'), ['required', 'class' => 'form-control']) ?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label class="text-muted" for="perihal"><?= $model->getLabel('perihal') ?><span class="text-danger">*</span></label>
                    <?= $form->field('perihal', ['required', 'class' => 'form-control'])->textField() ?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label class="text-muted" for="tujuan"><?= $model->getLabel('tujuan') ?><span class="text-danger">*</span></label>
                    <?= $form->field('tujuan', ['required', 'class' => 'form-control'])->textField() ?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-xl-3">
                    <label class="text-muted" for="tanggal"><?= $model->getLabel('tanggal') ?><span class="text-danger">*</span></label>
                    <?= $form->field('tanggal', ['required', 'class' => 'form-control'])->dateField() ?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label class="text-muted" for="file_input"><?= $model->getLabel('file') ?>
                        <?php if ($model->isEdit() && $model->file) { ?>
                            : <a target="_blank" href="<?= upload("/{$tahun}/tugas_keluar/" . $model->file) ?>"><i class="fa-solid fa-file-pdf"></i></a>
                        <?php } ?>
                    </label>
                    <?= $form->file('file_input', ['class' => 'form-control', 'accept' => 'application/pdf']) ?>
                </div>
                <div class="mb-3"></div>
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label class="text-muted" for="tujuan"><?= $model->getLabel('keterangan') ?></label>
                    <?= $form->field('keterangan', ['class' => 'form-control'])->textField() ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <!-- button kembali ke halaman tampil data -->
            <a href="<?= route('tugas_keluar') ?>" class="btn btn-secondary rounded-pill py-2 px-4">Batal</a>
            <!-- button simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary rounded-pill py-2 px-4">
        </div>
        <?= $form->end() ?>
    </div>

</div>