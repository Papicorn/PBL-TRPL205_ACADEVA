<div class="modal fade" id="modalTambahDosen" tabindex="-1" aria-labelledby="modalTambahDosenLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalTambahDosenLabel">Tambah Data Dosen</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= route_to('tambah.dosen'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal-body">
            <div class="row gy-3">
                <div class="col-12">
                    <label for="nidn" class="form-label">NIDN</label>
                    <input type="text" class="form-control" name="nidn" id="nidn" placeholder="Masukkan NIDN">
                </div>
                <div class="col-12">
                    <label for="nama_depan" class="form-label">Nama Depan</label>
                    <input type="text" class="form-control" name="nama_depan" id="nama_depan" placeholder="Masukkan Nama Depan">
                </div>
                <div class="col-12">
                    <label for="nama_belakang" class="form-label">Nama Belakang</label>
                    <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" placeholder="Masukkan Nama Belakang">
                    <i class="form-text mb-0">*Kosongkan jika tidak diperlukan</i>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email">
                </div>
                <div class="col-12">
                    <label for="kata_sandi" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" name="kata_sandi" id="kata_sandi" placeholder="Masukkan Kata Sandi">
                </div>
                <div class="col-12 col-md-6">
                    <label for="kelamin" class="form-label">Kelamin</label>
                    <select name="kelamin" id="kelamin" class="form-select">
                        <option value="" disabled selected>-- Pilih --</option>
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label for="no_telpon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="Masukkan No Telepon">
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>

    </div>
  </div>
</div>