<?php

use Core\Helper\Url;
use Core\Http\ViewComponent\BootstrapFormFactory;

$form = BootstrapFormFactory::create($model);
?>
<div class="content-header">
    <h4 class="content-title ~mx-auto">Laporan Naskah Dinas Keluar</h4>
</div>
<div class="content-body">
    <div class="card mb-5 col-xl-6">
        <?= $form->begin(Url::getCurrentPath(), 'POST', ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate']) ?>
        <div class="card-body">
            <h4 class="card-title py-1 mb-5">Cetak Laporan Naskah Dinas Keluar</h4>
            <?php
            if ($model->hasError()) { ?>
                <?= render_error_form($model) ?>
            <?php } ?>
            <?= $form->csrfField() ?>
            <div class="row mb-3">
                <div class="col-xl-6">
                    <label class="text-muted mb-2" for="jenis"><?= $model->getLabel('jenis') ?><span class="text-danger">*</span></label>
                    <?= $form->select('jenis', [
                        ['key'=>'memo','val'=>'Memorandum'],
                        ['key'=>'nota','val'=>'Nota Dinas/KAK/Form Belanja'],
                        ['key'=>'surtug','val'=>'Surat Tugas'],
                        ['key'=>'dinas','val'=>'Surat Dinas'],
                        ['key'=>'internal','val'=>'Undangan Internal'],
                        ['key'=>'eksternal','val'=>'Undangan Eksternal']], 
                        ['required', 'autofocus', 'class' => 'form-select'],null,'key','val') ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-xl-6">
                    <label class="form-label" for="start"><?= $model->getLabel('start') ?><span class="text-danger">*</span></label>
                    <?= $form->field('start', ['class' => 'form-control', 'required'])->dateField() ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-xl-6">
                    <label class="form-label" for="end"><?= $model->getLabel('end') ?><span class="text-danger">*</span></label>
                    <?= $form->field('end', ['class' => 'form-control', 'required'])->dateField() ?>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <!-- button simpan data -->
            <input type="submit" name="cetak" value="Cetak" class="btn btn-primary rounded-pill py-2 px-4">
        </div>
        <?= $form->end() ?>
    </div>

</div>