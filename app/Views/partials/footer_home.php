<section class="contact-details" id="contact-details-section">
        <div class="row text-center text-md-left">
          <div class="col-12 col-md-6 col-lg-3 grid-margin">
            <a href="#"><img src="images/logo_icon.png" style="width:170px;" alt="" class="pb-2"></a>
            <div class="pt-2">
              <p class="text-muted m-0">Sebuah platform penyelenggara asesmen secara online dengan respon yang cepat dan tepat.</p>
            </div>         
          </div>
          <div class="col-12 col-md-6 col-lg-3 grid-margin">
            <h5 class="pb-2">Menu Utama</h5>
            <a href="<?= base_url('/masuk') ?>"><p class="m-0 pb-2">Masuk</p></a>   
            <a href="<?= route_to('beranda.mahasiswa') ?>" ><p class="m-0 pt-1 pb-2">Mulai Asesmen</p></a>
          </div>
          <div class="col-12 col-md-6 col-lg-3 grid-margin">
            <h5 class="pb-2">Halaman Kami</h5>
            <a href="<?= base_url('/ketentuan-dan-layanan') ?>"><p class="m-0 pb-2">Ketentuan dan Layanan</p></a>
          </div>
          <div class="col-12 col-md-6 col-lg-3 grid-margin">
              <h5 class="pb-2">Alamat</h5>
              <p class="text-muted">Jl. Ahmad Yani, Tlk. Tering, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29461</p>
              <div class="d-flex justify-content-center justify-content-md-start">
                <a href="#"><span class="mdi mdi-facebook"></span></a>
                <a href="#"><span class="mdi mdi-twitter"></span></a>
                <a href="#"><span class="mdi mdi-instagram"></span></a>
                <a href="#"><span class="mdi mdi-linkedin"></span></a>
              </div>
          </div>
        </div>  
      </section>
<footer class="border-top">
        <p class="text-center text-muted pt-4">Copyright © 2024<a href="#" class="px-1">Acadeva.</a></p>
      </footer>

      <!-- Modal for Contact - us Button 
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Masuk sekarang!</h4>
            </div>
            <form method="POST" action="">
              @csrf
              <div class="modal-body">  
                  <div class="form-group">
                    <input type="text" class="form-control" id="Name" placeholder="ID Learning">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" id="pass" placeholder="Kata Sandi">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Masuk</button>
              </div>
            </form>
          </div>
        </div>
      </div> -->

    </div> 
  </div>
    <?php if (session()->getFlashdata('success')): ?>
    <script>
        Swal.fire({
          title: "<?= session()->getFlashdata('title'); ?>",
          text: "<?= session()->getFlashdata('success'); ?>",
          icon: 'success',
          showCancelButton: true,
          cancelButtonText: 'Oke!',
          confirmButtonText: 'Beranda'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "<?= session()->getFlashdata('link'); ?>";
          }
        });
    </script>
    <?php endif; ?>
  <script src="vendors/jquery/jquery.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.min.js"></script>
  <script src="vendors/owl-carousel/js/owl.carousel.min.js"></script>
  <script src="vendors/aos/js/aos.js"></script>
  <script src="js/landingpage.js"></script>
</body>
</html>