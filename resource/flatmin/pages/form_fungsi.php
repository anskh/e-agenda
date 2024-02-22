<div class="content-header">
    <h4 class="content-title ~mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <rect x="4" y="4" width="16" height="16" rx="2"></rect>
            <line x1="4" y1="10" x2="20" y2="10"></line>
            <line x1="10" y1="4" x2="10" y2="20"></line>
        </svg>&nbsp;
        <span>Bagian/Fungsi</span>
    </h4>
</div>
<?php

use Core\Http\ViewComponent\BootstrapFormFactory;

$form = BootstrapFormFactory::create($model);
if ($model->isEdit()) {
    $action = route('edit_fungsi') . $model->kode;
} else {
    $action = route('entri_fungsi');
}
?>
<div class="content-body">
    <div class="card mb-5 col-xl-8">
        <?= $form->begin($action, 'POST', ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate']) ?>
        <div class="card-body">
            <h4 class="card-title py-1 mb-5"><?= $model->isEdit() ? 'Ubah ' : 'Tambah ' ?>Bagian/Fungsi</h4>
            <?php
            if ($model->hasError()) { ?>
                <?= render_error_form($model) ?>
            <?php } ?>
            <?= $form->csrfField() ?>
            <div class="row mb-3">
                <div class="col-xl-2">
                    <label class="form-label" for="kode"><?= $model->getLabel('kode') ?><span class="text-danger">*</span></label>
                    <?php if ($model->isEdit()) {
                        echo $form->field('kode', ['class' => 'form-control', 'disabled', 'readonly'])->textField();
                    } else {
                        echo $form->field('kode', ['class' => 'form-control disable', 'required', 'autofocus'])->textField();
                    } ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="pt-2 col-xl">
                    <label class="form-label" for="nama"><?= $model->getLabel('nama') ?><span class="text-danger">*</span></label>
                    <?php if ($model->isEdit()) {
                        echo $form->field('nama', ['class' => 'form-control', 'required', 'autofocus'])->textField();
                    } else {
                        echo $form->field('nama', ['class' => 'form-control', 'required'])->textField();
                    } ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <!-- button kembali ke halaman tampil data -->
            <a href="<?= route('fungsi') ?>" class="btn btn-secondary rounded-pill py-2 px-4">Batal</a>
            <!-- button simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary rounded-pill py-2 px-4">
        </div>
        <?= $form->end() ?>
    </div>

</div>