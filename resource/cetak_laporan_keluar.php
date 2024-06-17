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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= asset('/css/main.css') ?>">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?= asset('/css/all.min.css') ?>" />
    <!-- Bootstrap JS -->
    <script src="<?= asset('/js/main.js') ?>"></script>
</head>

<body>
    <main class="content container mx-auto">
        <div class="content-header">
            <h4 class="content-title mx-auto">Buku Agenda Naskah Dinas Keluar</h4>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-xl-2">Satuan Kerja:</div><div class="col-xl-10">BPS Provinsi Riau</div>
                <div class="col-xl-2">Jenis Naskah:</div><div class="col-xl-10"><?= $jenis ?></div>
                <div class="col-xl-2">Tanggal Mulai:</div><div class="col-xl-10"><?= $start ?></div>
                <div class="col-xl-2">Tanggal Berakhir:</div><div class="col-xl-10"><?= $stop ?></div>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered table-striped table-hover" style="width:100%">
                    <thead class="table-light">
                        <th class="text-center">No.</th>
                        <th class="text-center">Nomor Naskah</th>
                        <th class="text-center">Perihal</th>
                        <th class="text-center">Tujuan/Penerima</th>
                        <th class="text-center">Tanggal</th>
                    </thead>
                    <tbody>
                        <?php
                        // variabel untuk nomor urut tabel
                        $no = 1;
                        foreach ($data as $row) {
                        ?>
                            <tr>
                                <td width="60" class="text-center"><?= $no++ ?></td>
                                <td width="250"><?= $row['nomor_naskah'] ?></td>
                                <td><?= $row['perihal'] ?></td>
                                <td><?= $row['tujuan'] ?></td>
                                <td width="150" class="text-center"><?= $row['tanggal'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script> window.print();</script>
</body>

</html>