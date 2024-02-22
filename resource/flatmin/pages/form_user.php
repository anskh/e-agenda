<div class="content-header">
    <h4 class="content-title ~mx-auto"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <circle cx="12" cy="7" r="4"></circle>
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
        </svg>&nbsp;
        <span>Pengaturan Pengguna</span>
    </h4>
</div>
<?php

use App\Model\FungsiModel;
use Core\Http\ViewComponent\BootstrapFormFactory;

$form = BootstrapFormFactory::create($model);

if ($model->isEdit()) {
    $action = route('edit_user') . $model->id;
} else {
    $action = route('entri_user');
}
?>
<div class="content-body">
    <div class="card mb-5 col-xl-6">
        <?= $form->begin($action, 'POST', ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate']) ?>
        <div class="card-body">
            <h4 class="card-title py-1 mb-5"><?= $model->isEdit() ? 'Ubah ' : 'Tambah ' ?>Pengguna</h4>
            <?php
            if ($model->hasError()) { ?>
                <?= render_error_form($model) ?>
            <?php } ?>
            <?= $form->csrfField() ?>
            <div class="row mb-3">
                <div class="col-xl-6">
                    <label class="form-label" for="username"><?= $model->getLabel('username') ?><span class="text-danger">*</span></label>
                    <?php if ($model->isEdit()) { ?>
                        <?= $form->field('username', ['class' => 'form-control', 'disabled', 'readonly'])->textField() ?>
                    <?php } else { ?>
                        <?= $form->field('username', ['class' => 'form-control', 'required', 'autofocus'])->textField() ?>
                    <?php } ?>
                </div>
            </div>
            <?php if ($model->isEdit() === false) : ?>
                <div class="row mb-3">
                    <div class="col-xl-6">
                        <label class="form-label" for="password"><?= $model->getLabel('password') ?><span class="text-danger">*</span></label>
                        <?= $form->field('password', ['class' => 'form-control', 'required'])->passField() ?>
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label" for="repassword"><?= $model->getLabel('repassword') ?><span class="text-danger">*</span></label>
                        <?= $form->field('repassword', ['class' => 'form-control', 'required'])->passField() ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label" for="nama"><?= $model->getLabel('nama') ?><span class="text-danger">*</span></label>
                    <?php if ($model->isEdit()) : ?>
                        <?= $form->field('nama', ['class' => 'form-control', 'required', 'autofocus'])->textField() ?>
                    <?php else : ?>
                        <?= $form->field('nama', ['class' => 'form-control', 'required'])->textField() ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-xl-6">
                    <label class="form-label" for="role"><?= $model->getLabel('role') ?><span class="text-danger">*</span></label>
                    <?= $form->field('role', ['class' => 'form-control', 'required'])->textField() ?>
                    <div class="form-hint">
                        <small>Isikan nama role dan pisahkan dengan tanda koma untuk lebih dari satu role.</small>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-xl-6">
                    <label class="text-muted mb-2" for="fungsi"><?= $model->getLabel('fungsi') ?><span class="text-danger">*</span></label>
                    <?= $form->select('fungsi', FungsiModel::all('kode,nama'), ['required', 'class' => 'form-select'], $model->fungsi, 'kode', 'nama') ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <!-- button kembali ke halaman tampil data -->
            <a href="<?= route('user') ?>" class="btn btn-secondary rounded-pill py-2 px-4">Batal</a>
            <!-- button simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary rounded-pill py-2 px-4">
        </div>
        <?= $form->end() ?>
    </div>

</div>