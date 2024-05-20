<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ." - ". config('App')->appName ?></title>
  <link rel="icon" href="images/favicon1.png">

  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/custom/masuk.css">
  <link rel="stylesheet" href="/vendors/mdi/css/materialdesignicons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-light">
<div class="position-absolute">
	<div class="purple"></div>
	<div class="medium-blue"></div>
	<div class="light-blue"></div>
	<div class="red"></div>
	<div class="orange"></div>
	<div class="yellow"></div>
	<div class="cyan"></div>
	<div class="light-green"></div>
	<div class="lime"></div>
	<div class="magenta"></div>
	<div class="lightish-red"></div>
	<div class="pink"></div>
</div>

<div class="container py-5"> 

	<a class="btn btn-primary" href="<?= base_url('/home') ?>"><span class="mdi mdi-arrow-left"></span> Kembali</a>
  <div class="row d-flex justify-content-center align-items-center" style="height: 500px;">
  	<div class="col-7">

  	<div class="card card-body rounded-3 shadow" style="border-radius: 20px !important;">
	    <div class="col-12">

	      <div class="row gx-3 mb-4">

	        <div class="col-4">
	          <a data-bs-toggle="collapse" href="#formadmin" role="button" aria-expanded="false" aria-controls="formadmin" class="text-decoration-none text-primary btn-toggle">
	            <div class="card shadow rounded-3 masukHover" style="border-radius: 20px !important;">
	              <div class="card-body">
	                <div class="text-center">
	                  <img height="70" width="70" src="/images/admin_icons.png" alt="administrator" class="gambarHover">
	                  <h6>Administrator</h6>
	                </div>
	              </div>
	            </div>
	          </a>
	        </div>

	        <div class="col-4">
	          <a data-bs-toggle="collapse" href="#formdosen" role="button" aria-expanded="false" aria-controls="formdosen" class="text-decoration-none text-primary btn-toggle">
	            <div class="card shadow rounded-3 masukHover" style="border-radius: 20px !important;">
	              <div class="card-body">
	                <div class="text-center">
	                  <img height="70" width="70" src="/images/dosen_icons.png" alt="dosen" class="gambarHover">
	                  <h6>Dosen</h6>
	                </div>
	              </div>
	            </div>
	          </a>
	        </div>

	        <div class="col-4">
	          <a data-bs-toggle="collapse" href="#formmahasiswa" role="button" aria-expanded="false" aria-controls="formadmin" class="text-decoration-none text-primary btn-toggle">
	            <div class="card shadow rounded-3 masukHover" style="border-radius: 20px !important;">
	              <div class="card-body">
	                <div class="text-center">
	                  <img height="70" width="70" src="/images/mahasiswa_icons.png" alt="mahasiswa" class="gambarHover">
	                  <h6>Mahasiswa</h6>
	                </div>
	              </div>
	            </div>
	          </a>
	        </div>

	      </div>

	      <div class="collapse" id="formadmin">
	      	<h5 class="text-center">Masuk Sebagai Administrator</h5>
	      	<form method="POST" action="<?= route_to('masuk.administrator') ?>">
	      		<?= csrf_field(); ?>
	      		<div class="mb-3">
	      			<label class="form-label" for="email">Alamat Email</label>
	      			<input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email">
	      		</div>
	      		<div class="mb-3">
	      			<label class="form-label" for="kata_sandi">Kata Sandi Akun</label>
	      			<input type="password" name="kata_sandi" id="kata_sandi" class="form-control" placeholder="Masukkan kata sandi">
	      		</div>
	      		<div class="mb-3">
	      			<button class="btn btn-primary">Masuk</button>
	      		</div>
	      	</form>
	      </div>
	      <div class="collapse" id="formdosen">
	        <h5 class="text-center">Masuk Sebagai Dosen</h5>
	      	<form method="POST" action="<?= route_to('masuk.dosen') ?>">
	      		<?= csrf_field(); ?>
	      		<div class="mb-3">
	      			<label class="form-label" for="nama_pengguna">Nama Pengguna</label>
	      			<input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control" placeholder="Masukkan Nama Pengguna">
	      		</div>
	      		<div class="mb-3">
	      			<label class="form-label" for="kata_sandi">Kata Sandi Akun</label>
	      			<input type="password" name="kata_sandi" id="kata_sandi" class="form-control" placeholder="Masukkan kata sandi">
	      		</div>
	      		<div class="mb-3">
	      			<button class="btn btn-primary">Masuk</button>
	      		</div>
	      	</form>
	      </div>
	      <div class="collapse" id="formmahasiswa">
	        <h5 class="text-center">Masuk Sebagai Mahasiswa</h5>
	      	<form method="POST" action="<?= route_to('masuk.mahasiswa') ?>">
	      		<?= csrf_field(); ?>
	      		<div class="mb-3">
	      			<label class="form-label" for="nama_pengguna">Nama Pengguna</label>
	      			<input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control" placeholder="Masukkan Nama Pengguna">
	      		</div>
	      		<div class="mb-3">
	      			<label class="form-label" for="kata_sandi">Kata Sandi Akun</label>
	      			<input type="password" name="kata_sandi" id="kata_sandi" class="form-control" placeholder="Masukkan kata sandi">
	      		</div>
	      		<div class="mb-3">
	      			<button class="btn btn-primary">Masuk</button>
	      		</div>
	      	</form>
	      </div>

	    </div>
    </div>
  </div>
  </div>

</div>

<script src="/js/bootstrap.min.js"></script>
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
  <script src ="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> </script>

  <!-- Alert gagal (sweet alert 2) -->
  <?php 
    if (session()->has('gagal')):
    $errors = implode('<br>', array_map('esc', session('gagal')));
    ?>
    <script>
        Swal.fire({
            title: "Terjadi Kesalahan",
            html: "<?= $errors; ?>",
            icon: "error"
        });
    </script>
    <?php endif; ?>

<script>
	// JavaScript to handle collapse behavior
document.addEventListener('DOMContentLoaded', function() {
  const collapseElements = document.querySelectorAll('.collapse');
  collapseElements.forEach(collapse => {
    collapse.addEventListener('show.bs.collapse', function(event) {
      const collapseTarget = event.target;
      const allCollapses = document.querySelectorAll('.collapse.show');
      allCollapses.forEach(shownCollapse => {
        if (shownCollapse !== collapseTarget) {
          shownCollapse.classList.remove('show');
        }
      });
    });
  });
});

</script>

</body>
</html>
