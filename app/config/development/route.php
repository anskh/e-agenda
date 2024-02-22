<?php declare(strict_types=1);

use App\Handler\AuthHandler;
use App\Handler\AdminHandler;
use App\Handler\DinasKeluarHandler;
use App\Handler\EksternalKeluarHandler;
use App\Handler\InternalKeluarHandler;
use App\Handler\LaporanKeluarHandler;
use App\Handler\LaporanMasukHandler;
use App\Handler\MasterHandler;
use App\Handler\MemoKeluarHandler;
use App\Handler\NaskahMasukHandler;
use App\Handler\NotaKeluarHandler;
use App\Handler\TugasKeluarHandler;

return [
    'home' => ['GET', '/', AdminHandler::class],
    'edit_password' => [['GET','POST'], '/password', [AdminHandler::class, 'editPassword']],
    'profil' => ['GET', '/profil', [AdminHandler::class, 'profil']],

    'login' => [['GET','POST'], '/login', AuthHandler::class],
    'logout' => ['GET', '/logout', [AuthHandler::class, 'logout']],
    'user' => ['GET', '/user', [AuthHandler::class, 'user']],
    'entri_user' => [['GET','POST'], '/user/entri', [AuthHandler::class, 'entriUser']],
    'edit_user' => [['GET','POST'], '/user/edit/{userid}', [AuthHandler::class, 'editUser']],
    'delete_user' => [['GET','POST'], '/user/delete/{userid}', [AuthHandler::class, 'deleteUser']], 

    'klasifikasi' => ['GET', '/klasifikasi', [MasterHandler::class, 'klasifikasi']],
    'entri_klasifikasi' => [['GET','POST'], '/klasifikasi/entri', [MasterHandler::class, 'entriKlasifikasi']],
    'edit_klasifikasi' => [['GET','POST'], '/klasifikasi/edit/{kode}', [MasterHandler::class, 'editKlasifikasi']],
    'delete_klasifikasi' => ['GET', '/klasifikasi/delete/{kode}', [MasterHandler::class, 'deleteKlasifikasi']],
    
    'fungsi' => ['GET', '/fungsi', [MasterHandler::class, 'fungsi']],
    'entri_fungsi' => [['GET','POST'], '/fungsi/entri', [MasterHandler::class, 'entriFungsi']],
    'edit_fungsi' => [['GET','POST'], '/fungsi/edit/{kode}', [MasterHandler::class, 'editFungsi']],
    'delete_fungsi' => ['GET', '/fungsi/delete/{kode}', [MasterHandler::class, 'deleteFungsi']],

    'akses' => ['GET', '/akses', [MasterHandler::class, 'akses']],
    'entri_akses' => [['GET','POST'], '/akses/entri', [MasterHandler::class, 'entriAkses']],
    'edit_akses' => [['GET','POST'], '/akses/edit/{kode}', [MasterHandler::class, 'editAkses']],
    'delete_akses' => ['GET', '/akses/delete/{kode}', [MasterHandler::class, 'deleteAkses']],

    'memo_keluar' => ['GET', '/memo-keluar', MemoKeluarHandler::class],
    'entri_memo_keluar' => [['GET','POST'], '/memo-keluar/entri', [MemoKeluarHandler::class, 'entriMemo']],
    'edit_memo_keluar' => [['GET','POST'], '/memo-keluar/edit/{id}', [MemoKeluarHandler::class, 'editMemo']],
    'delete_memo_keluar' => ['GET', '/memo-keluar/delete/{id}', [MemoKeluarHandler::class, 'deleteMemo']],

    'nota_keluar' => ['GET', '/nota-keluar', NotaKeluarHandler::class],
    'entri_nota_keluar' => [['GET','POST'], '/nota-keluar/entri', [NotaKeluarHandler::class, 'entriNota']],
    'edit_nota_keluar' => [['GET','POST'], '/nota-keluar/edit/{id}', [NotaKeluarHandler::class, 'editNota']],
    'delete_nota_keluar' => ['GET', '/nota-keluar/delete/{id}', [NotaKeluarHandler::class, 'deleteNota']],

    'tugas_keluar' => ['GET', '/tugas-keluar', TugasKeluarHandler::class],
    'entri_tugas_keluar' => [['GET','POST'], '/tugas-keluar/entri', [TugasKeluarHandler::class, 'entriTugas']],
    'edit_tugas_keluar' => [['GET','POST'], '/tugas-keluar/edit/{id}', [TugasKeluarHandler::class, 'editTugas']],
    'delete_tugas_keluar' => ['GET', '/tugas-keluar/delete/{id}', [TugasKeluarHandler::class, 'deleteTugas']],

    'dinas_keluar' => ['GET', '/dinas-keluar', DinasKeluarHandler::class],
    'entri_dinas_keluar' => [['GET','POST'], '/dinas-keluar/entri', [DinasKeluarHandler::class, 'entriDinas']],
    'edit_dinas_keluar' => [['GET','POST'], '/dinas-keluar/edit/{id}', [DinasKeluarHandler::class, 'editDinas']],
    'delete_dinas_keluar' => ['GET', '/dinas-keluar/delete/{id}', [DinasKeluarHandler::class, 'deleteDinas']],

    'internal_keluar' => ['GET', '/internal-keluar', InternalKeluarHandler::class],
    'entri_internal_keluar' => [['GET','POST'], '/internal-keluar/entri', [InternalKeluarHandler::class, 'entriInternal']],
    'edit_internal_keluar' => [['GET','POST'], '/internal-keluar/edit/{id}', [InternalKeluarHandler::class, 'editInternal']],
    'delete_internal_keluar' => ['GET', '/internal-keluar/delete/{id}', [InternalKeluarHandler::class, 'deleteInternal']],

    'eksternal_keluar' => ['GET', '/eksternal-keluar', EksternalKeluarHandler::class],
    'entri_eksternal_keluar' => [['GET','POST'], '/eksternal-keluar/entri', [EksternalKeluarHandler::class, 'entriEksternal']],
    'edit_eksternal_keluar' => [['GET','POST'], '/eksternal-keluar/edit/{id}', [EksternalKeluarHandler::class, 'editEksternal']],
    'delete_eksternal_keluar' => ['GET', '/eksternal-keluar/delete/{id}', [EksternalKeluarHandler::class, 'deleteEksternal']],

    'naskah_masuk' => ['GET', '/naskah-masuk', NaskahMasukHandler::class],
    'entri_naskah_masuk' => [['GET','POST'], '/naskah-masuk/entri', [NaskahMasukHandler::class, 'entri']],
    'edit_naskah_masuk' => [['GET','POST'], '/naskah-masuk/edit/{id}', [NaskahMasukHandler::class, 'edit']],
    'delete_naskah_masuk' => ['GET', '/naskah-masuk/delete/{id}', [NaskahMasukHandler::class, 'delete']],

    'laporan_masuk' => [['GET','POST'], '/laporan-masuk', LaporanMasukHandler::class],
    'cetak_laporan_masuk' => ['GET', '/laporan-masuk/{start}/{stop}', [LaporanMasukHandler::class, 'cetak']],
    'laporan_keluar' => [['GET','POST'], '/laporan-keluar', LaporanKeluarHandler::class],
    'cetak_laporan_keluar' => ['GET', '/laporan-keluar/{jenis}/{start}/{stop}', [LaporanKeluarHandler::class, 'cetak']]
];