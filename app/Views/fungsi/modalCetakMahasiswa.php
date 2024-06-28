<div class="modal fade" id="modalCetakMahasiswa" tabindex="-1" aria-labelledby="modalCetakMahasiswaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalCetakMahasiswaLabel">Cetak Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= route_to('cetak.mahasiswa'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal-body">
            <div class="row gy-3">
                <div class="col-12">
                    <label for="nim" class="form-label">Mahasiswa</label>
                    <select name="nim" id="nim" class="form-select">
                        <option value="" selected disabled>-- Pilih --</option>
                        <?php foreach($mahasiswa_diampu as $row): ?>
                            <option value="<?= $row['nim'] ?>"><?= $row['nama_lengkap'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label for="kode_matkul" class="form-label">Matakuliah</label>
                    <select name="kode_matkul" id="kode_matkul" class="form-select">
                        <option value="" selected disabled>-- Pilih --</option>
                        <?php foreach($matkul_diampu as $row): ?>
                            <option value="<?= $row['kode_matkul'] ?>"><?= $row['nama_matkul'] ?></option>
                        <?php endforeach; ?>
                    </select>
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