<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi e-Agenda">
    <meta name="author" content="Khaerul Anas">

    <!-- Title -->
    <title>.:: E-Agenda ::.</title>

    <!-- Favicon icon -->
    <link rel="icon" href="<?= asset('/img/favicon.ico') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= asset('/img/favicon.ico') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= asset('/css/main.css') ?>">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?= asset('/css/all.min.css') ?>" />
    <script src="<?= asset('/js/main.js') ?>"></script>
</head>

<body>
    <!-- Header -->
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-white shadow">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2 w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>
                </button>
                <a class="navbar-brand hidden-dark"><img src="<?= asset('/img/logo.svg') ?>"><span class="navbar-brand text-mute"> E-Agenda</span></a>

            </div>
        </nav>
    </header>
    <!-- Main Content -->
    <main class="d-flex flex-grow-1 align-items-center">
        <div class="content container max-w-md">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 mt-5 text-center">Masuk</h5>
                    <?php

                    use Core\Helper\Enum;
                    use Core\Http\ViewComponent\BootstrapFormFactory;

                    $form = BootstrapFormFactory::create($model);
                    ?>
                    <?= $form->begin(base_url('/login'), 'POST', ['enctype' => 'multipart/form-data', 'class' => 'needs-validation', 'novalidate']) ?>

                    <?php if ($this->session->hasFlash()) { ?>
                        <?= render_flash($this->session->flash()) ?>
                    <?php } ?>
                    <?php if ($model->hasError()) { ?>
                        <?= render_error_form($model) ?>
                    <?php } ?>
                    <?= $form->csrfField() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label"><?= $model->getLabel('username') ?></label>
                        <?= $form->field('username', ['class' => 'form-control', 'required', 'autofocus'])->textField() ?>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label"><?= $model->getLabel('password') ?></label>
                        <?= $form->field('password', ['class' => 'form-control', 'required'])->passField() ?>
                    </div>
                    <div class="mb-3">
                        <label for="tahun" class="form-label"><?= $model->getLabel('tahun') ?></label>
                        <?= $form->select('tahun', Enum::range(2024, intval(date('Y'))), ['required', 'class' => 'form-select'], intval(date('Y'))) ?>
                    </div>
                </div>
                <div class="card-footer text-end py-3">
                    <button class="btn btn-primary">Login</button>
                </div>
                <?= $form->end() ?>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer class="footer mt-auto bg-white shadow py-4">
        <div class="container-fluid px-lg-5">
            <!-- copyright -->
            <div class="copyright text-center mb-2 mb-md-0">
                ..:: &copy; <?= date("Y") ?> - Fungsi IPDS BPS Provinsi Riau ::..
            </div>
        </div>
    </footer>

</body>

</html>