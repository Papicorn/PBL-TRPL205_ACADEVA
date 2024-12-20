<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=0.3">
    <?= csrf_meta() ?>
    <title><?= $title . " - " . config('App')->appName ?></title>
    
    <link rel="shortcut icon" href="<?= base_url('/images/favicon1.png') ?>" type="image/x-icon">
    
  <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/app.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/app-dark.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/iconly.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/compiled/css/table-datatable.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/assets/extensions/simple-datatables/style.css') ?>">
  <link rel="stylesheet" href="<?= base_url('/css/preloader.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="<?= base_url('/assets/extensions/chart.js/chart.umd.js') ?>"></script>
  <script src="<?= base_url('/fullcalendar/dist/index.global.min.js') ?>"></script>
  <script src="<?= base_url('/assets/extensions/jquery/jquery.min.js') ?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</head>

<body>
    <!-- PRELOADER PAGE -->
    <div id="loading">
        <span class="loader"></span>
        <div class="textLoader">
            <center>
            <b>Tunggu Sebentar ... </b>
            </center>
        </div>
    </div>
    <!-- END PRELOADER PAGE -->

    <script src="<?= base_url('assets/static/js/initTheme.js') ?>"></script>
    <div id="app">
<div id="sidebar">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="<?= base_url('/home'); ?>"><img src="<?= base_url('/images/logo_icon.png') ?>" alt="" sizes="" srcset=""></a>
            </div>
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--system-uicons" width="20" height="20"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                            opacity=".3"></path>
                        <g transform="translate(-210 -1)">
                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                            <circle cx="220.5" cy="11.5" r="4"></circle>
                            <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                        </g>
                    </g>
                </svg>
                <div class="form-check form-switch fs-6">
                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                    <label class="form-check-label"></label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                    </path>
                </svg>
            </div>
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>
            
            <li
                class="sidebar-item <?php if($title == "Beranda"): echo 'active'; endif; ?>">
                <a href="<?= route_to('beranda.mahasiswa') ?>" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li
                class="sidebar-item <?php if($title == "Jadwal Asesmen"): echo 'active'; endif; ?>">
                <a href="<?= route_to('hal.jadwal_asesmen') ?>" class='sidebar-link'>
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Jadwal Asesmen</span>
                </a>
            </li>
            <li
                class="sidebar-item <?php if($title == "Hasil Asesmen"): echo 'active'; endif; ?>">
                <a href="<?= route_to('hal.hasil_asesmen') ?>" class='sidebar-link'>
                    <i class="fa-solid fa-box-archive"></i>
                    <span>Hasil Asesmen</span>
                </a>
            </li>
            <li
                class="sidebar-item">
                <a href="<?= route_to('fungsi.keluar') ?>" class='sidebar-link text-danger' style="background-color: rgba(252, 210, 210, 0.3);">
                <i class="fa-solid text-danger fa-right-from-bracket"></i>
                    <span>Keluar</span>
                </a>
                

            </li>

            
        </ul>
    </div>
</div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="d-flex justify-content-between">
                <div class="page-heading">
                    <h3 class="mb-0"><?= $title ?></h3>
                    <?php if($title === 'Beranda'): ?>
                        <h5>Selamat datang <?= $mhs['nama_lengkap'] ?>!</h5>
                    <?php endif; ?>
                </div> 
                <div>
                    <font class="fw-bold me-2"><?= $mhs['nama_lengkap'] ?></font>
                    
                    <div class="avatar avatar-lg">
                        <img src="<?= base_url('/assets/compiled/jpg/5.jpg') ?>">
                    </div>
                </div>
            </div>