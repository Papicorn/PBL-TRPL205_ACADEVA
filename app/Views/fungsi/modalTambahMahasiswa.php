<div class="modal fade" id="modalTambahMahasiswa" tabindex="-1" aria-labelledby="modalTambahMahasiswaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalTambahMahasiswaLabel">Tambah Data Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= route_to('tambah.mahasiswa'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal-body">
            <div class="row gy-3">
                <div class="col-12">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" name="nim" id="nim" placeholder="Masukkan NIM">
                </div>
                <div class="col-12">
                    <label for="nama_depan" class="form-label">Nama Depan</label>
                    <input type="text" class="form-control" name="nama_depan" id="nama_depan" placeholder="Masukkan nama depan">
                </div>
                <div class="col-12">
                    <label for="nama_belakang" class="form-label">Nama Belakang</label>
                    <input type="text" class="form-control" name="nama_belakang" id="nama_belakang" placeholder="Masukkan nama belakang">
                    <i class="form-text mb-0">*Kosongkan jika tidak diperlukan</i>
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email">
                </div>
                <div class="col-12">
                    <label for="kata_sandi" class="form-label">Kata Sandi</label>
                    <input type="text" class="form-control" name="kata_sandi" id="kata_sandi" placeholder="Masukkan kata sandi">
                </div>
                <div class="col-12 col-md-6">
                    <label for="no_telpon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="Masukkan No Telepon">
                </div>
                <div class="col-12 col-md-6">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan Tanggal Lahir">
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
                    <label for="kode_prodi" class="form-label">Prodi</label>
                    <select name="kode_prodi" id="kode_prodi" class="form-select">
                        <option value="" selected disabled>-- Pilih --</option>
                        <?php foreach($prodi as $rowprodi): ?>
                            <option value="<?= $rowprodi['kode_prodi'] ?>"><?= $rowprodi['nama_prodi'] ?> (<?= $rowprodi['kode_prodi'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label for="id_kelas" class="form-label">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-select" disabled>
                        <option value="" selected disabled>-- Pilih --</option>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="number" class="form-control" name="semester" id="semester" placeholder="Masukkan Semester">
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat"></textarea>
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