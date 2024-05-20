<!DOCTYPE html>
<html lang="en">
<head>
  <title><?= $title . " - " . config('App')->appName ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="vendors/owl-carousel/css/owl.carousel.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/css/owl.theme.default.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/aos/css/aos.css">
  <link rel="stylesheet" href="css/style.min.css">
  <link rel="icon" href="/images/favicon1.png">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
</head>
<body id="body" data-spy="scroll" data-target=".navbar" data-offset="100">
<header id="header-section">
    <nav class="navbar navbar-expand-lg pl-3 pl-sm-0" id="navbar">
    <div class="container">
      <div class="navbar-brand-wrapper d-flex w-100">
        <a href="#"><img src="images/logo_icon.png" style="width: 170px;" alt=""></a>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="mdi mdi-menu navbar-toggler-icon"></span>
        </button> 
      </div>
      <div class="collapse navbar-collapse navbar-menu-wrapper" id="navbarSupportedContent">
        <ul class="navbar-nav align-items-lg-center align-items-start ml-auto">
          <li class="d-flex align-items-center justify-content-between pl-4 pl-lg-0">
            <div class="navbar-collapse-logo">
              <a href="#"><img src="/images/logo_icon.png" alt="" style="width: 170px;"></a>
            </div>
            <button class="navbar-toggler close-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="mdi mdi-close navbar-toggler-icon pl-5"></span>
            </button>
          </li>
          <li class="nav-item">
            <?php if ($title == "Home"): ?>
                <a class="nav-link" href="#header-section">Utama <span class="sr-only">(current)</span></a>
            <?php else: ?>
                <a class="nav-link" href="<?= base_url('/home') ?>">Utama <span class="sr-only">(current)</span></a>
            <?php endif; ?>

              
          </li>
          <li class="nav-item">
            <?php if ($title == "Home"): ?>
              <a class="nav-link" href="#fitur">Fitur</a>
            <?php else: ?>
              <a class="nav-link" href="<?= base_url('/home') ?>#fitur">Fitur</a>
            <?php endif; ?>

          </li>
          <li class="nav-item">
            <?php if ($title == "Home"): ?>
              <a class="nav-link" href="#digital-marketing-section">Blog</a> 
            <?php else: ?> 
              <a class="nav-link" href="<?= base_url('/home') ?>#digital-marketing-section">Blog</a>
            <?php endif; ?>
          </li>
          <li class="nav-item">
            <?php if ($title == "Home"): ?>
              <a class="nav-link" href="#feedback-section">Testimonials</a>
            <?php else: ?> 
              <a class="nav-link" href="<?= base_url('/home') ?>#feedback-section">Testimonials</a>
            <?php endif; ?>
          </li>
          <?php if(session()->has('nama_pengguna')): ?>
            <li class="nav-item btn-contact-us pl-md-5 pl-4">
              <div class="dropdown">
              <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                <span class="mdi mdi-face-profile pr-1"></span><?= session()->get('nama_pengguna'); ?>
              </a>

              <div class="dropdown-menu dropdown-menu-right">
              <?php if(session()->get('role') == 'mahasiswa' || session()->get('role') == 'dosen'): ?>
                  <p class="dropdown-item m-0 font-weight-bold">Hai <?= $data['nama_lengkap'] ?>!</p>
                  <div class="dropdown-divider"></div>
                  <a href="<?= base_url('/beranda') ?>"><p class="dropdown-item m-0">Beranda</p></a>
                <?php elseif(session()->get('role') == 'admin'): ?>
                  <p class="dropdown-item m-0 font-weight-bold">Hai <?= $data['email'] ?>!</p>
                  <div class="dropdown-divider"></div>
                  <a href="<?= base_url('/admin/beranda') ?>"><p class="dropdown-item m-0">Beranda</p></a>
                <?php endif; ?>
                <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-danger" href="<?= route_to('fungsi.keluar') ?>">Keluar <span class="mdi mdi-arrow-right"></span></a>
              </div>
            </div>
            </li>
          <?php endif; ?>
          <?php if(!session()->get('nama_pengguna')): ?>
          <li class="nav-item btn-contact-us pl-md-5 pl-4">
              <a href="<?= route_to('tampilan.masuk') ?>" class="btn btn-primary">Masuk <span class="mdi mdi-arrow-right"></span></a>
          </li>
          <?php endif ?>
        </ul>
      </div>
    </div> 
    </nav>   
  </header>