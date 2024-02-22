<div class="content-header">
    <h4 class="content-title ~mx-auto">Ubah Password</h4>
</div>
<div class="content-body">
    <div class="card mb-5 col-xl-6">
        <?php

        use Core\Http\ViewComponent\BootstrapFormFactory;

        $form = BootstrapFormFactory::create($model);
        ?>
        <?= $form->begin(route('edit_password'), 'POST', ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate']) ?>
        <div class="card-body">
            <h4 class="card-title py-1 mb-5">Formulir Ubah Password</h4>
            <?php if ($this->session->hasFlash()) { ?>
                <?= render_flash($this->session->flash()) ?>
            <?php } ?>
            <?php if ($model->hasError()) { ?>
                <?= render_error_form($model) ?>
            <?php } ?>
            <?= $form->csrfField() ?>
            <div class="row">
                <div class="col-xl-6">
                    <label class="form-label" for="oldpassword"><?= $model->getLabel('oldpassword') ?><span class="text-danger">*</span></label>
                    <?= $form->field('oldpassword', ['class' => 'form-control', 'required', 'autofocus'])->passField() ?>
                </div>
            </div>
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
        </div>
        <div class="card-footer text-end">
            <!-- button kembali ke halaman tampil data -->
            <a href="<?= route('profil') ?>" class="btn btn-secondary rounded-pill py-2 px-4">Batal</a>
            <!-- button simpan data -->
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary rounded-pill py-2 px-4">
        </div>
        <?= $form->end() ?>
    </div>
</div>