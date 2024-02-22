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
                <a class="navbar-brand"><img src="<?= asset('/img/logo.svg') ?>"><span class="navbar-brand"> E-Agenda</span></a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav nav-tabs mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link<?= is_route('home') ? ' active' : '' ?>" aria-current="page" href="<?= route('home') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="13" r="2"></circle>
                                    <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line>
                                    <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle<?= is_route(['klasifikasi', 'fungsi', 'akses']) ? ' active' : '' ?>" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="4" y="4" width="6" height="5" rx="2"></rect>
                                    <rect x="4" y="13" width="6" height="7" rx="2"></rect>
                                    <rect x="14" y="4" width="6" height="16" rx="2"></rect>
                                </svg>
                                <span>Master</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-chevron-down w-4 h-4" width="24" height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <a class="dropdown-item<?= is_route('klasifikasi') ? ' active' : '' ?>" href="<?= route('klasifikasi') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                            <line x1="4" y1="10" x2="20" y2="10"></line>
                                            <line x1="10" y1="4" x2="10" y2="20"></line>
                                        </svg>

                                        <span>Klasifikasi Naskah Dinas</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item<?= is_route('fungsi') ? ' active' : '' ?>" href="<?= route('fungsi') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                            <line x1="4" y1="10" x2="20" y2="10"></line>
                                            <line x1="10" y1="4" x2="10" y2="20"></line>
                                        </svg>

                                        <span>Bagian/Fungsi</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item<?= is_route('akses') ? ' active' : '' ?>" href="<?= route('akses') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-table" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                            <line x1="4" y1="10" x2="20" y2="10"></line>
                                            <line x1="10" y1="4" x2="10" y2="20"></line>
                                        </svg>

                                        <span>Keamanan/Akses Surat</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php if (auth()->hasRole('user')) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle<?= is_route(['memo_keluar', 'nota_keluar', 'tugas_keluar', 'dinas_keluar', 'internal_keluar', 'eksternal_keluar']) ? ' active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layers-subtract h-5 w-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="8" y="4" width="12" height="12" rx="2"></rect>
                                    <path d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2"></path>
                                </svg>
                                <span>Naskah Keluar</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-chevron-down w-4 h-4" width="24" height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item<?= is_route('memo_keluar') ? ' active' : '' ?>" href="<?= route('memo_keluar') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="9 11 12 14 20 6"></polyline>
                                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                                        </svg>
                                        <span>Memorandum</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item<?= is_route('nota_keluar') ? ' active' : '' ?>" href="<?= route('nota_keluar') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="9 11 12 14 20 6"></polyline>
                                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                                        </svg>
                                        <span>Nota Dinas/KAK/Form Belanja</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item<?= is_route('tugas_keluar') ? ' active' : '' ?>" href="<?= route('tugas_keluar') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="9 11 12 14 20 6"></polyline>
                                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                                        </svg>
                                        <span>Surat Tugas</span>
                                    </a>
                                    <a class="dropdown-item<?= is_route('dinas_keluar') ? ' active' : '' ?>" href="<?= route('dinas_keluar') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="9 11 12 14 20 6"></polyline>
                                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                                        </svg>
                                        <span>Surat Dinas</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item<?= is_route('internal_keluar') ? ' active' : '' ?>" href="<?= route('internal_keluar') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="9 11 12 14 20 6"></polyline>
                                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                                        </svg>
                                        <span>Undangan Internal</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item<?= is_route('eksternal_keluar') ? ' active' : '' ?>" href="<?= route('eksternal_keluar') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <polyline points="9 11 12 14 20 6"></polyline>
                                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                                        </svg>
                                        <span>Undangan Eksternal</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link<?= is_route('naskah_masuk') ? ' active' : '' ?>" aria-current="page" href="<?= route('naskah_masuk') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="13" r="2"></circle>
                                    <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line>
                                    <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
                                </svg>
                                <span>Naskah Masuk</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle<?= is_route(['laporan_keluar', 'laporan_masuk']) ? ' active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-files" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M15 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z"></path>
                                    <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2"></path>
                                </svg>
                                <span>Laporan Agenda</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-chevron-down w-4 h-4" width="24" height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item<?= is_route('laporan_keluar') ? ' active' : '' ?>" href="<?= route('laporan_keluar') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                        </svg>
                                        <span>Naskah Dinas Keluar</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item<?= is_route('laporan_masuk') ? ' active' : '' ?>" href="<?= route('laporan_masuk') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                        </svg>
                                        <span>Naskah Dinas Masuk</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <?php if (auth()->hasRole('admin')) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle<?= is_route(['user','entri_user','edit_user']) ? ' active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-layout-grid" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                                        <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                                        <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                                        <rect x="14" y="14" width="6" height="6" rx="1"></rect>
                                    </svg>
                                    <span>Pengaturan</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-chevron-down w-4 h-4" width="24" height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item<?= is_route(['user','entri_user','edit_user']) ? ' active' : '' ?>" href="<?= route('user') ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            </svg>
                                            <span>Pengguna</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>

                <div class="navbar-right">
                    <ul class="navbar-nav nav-tabs ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link-avatar<?= is_route(['profil', 'edit_password', 'logout']) ? ' active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-none d-md-block me-1"><?= auth()->getIdentity()->getName() ?></span>&nbsp;
                                <div class="avatar"><i class="fa-solid fa-user ms-2 me-2"></i></div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-chevron-down w-4 h-4" width="24" height="24" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item<?= is_route('profil') ? ' active' : '' ?>" href="<?= route('profil') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                        </svg>
                                        <span>Profil</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item<?= is_route('edit_password') ? ' active' : '' ?>" href="<?= route('edit_password') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        <span>Ubah Password</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item<?= is_route('logout') ? ' active' : '' ?>" href="<?= route('logout') ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon icon-tabler icon-tabler-logout" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                            <path d="M7 12h14l-3 -3m0 6l3 -3"></path>
                                        </svg>
                                        <span>Keluar</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="content container mx-auto">
        <?php if(!isset($data)){
            $data = [];
        }
        if(!isset($model)){
            $model = null;
        }
        ?>
        <?= $this->render('pages/' . $page, compact('data', 'model')) ?>
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