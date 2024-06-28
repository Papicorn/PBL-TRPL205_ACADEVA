<div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalTambahJadwalLabel">Tambah Data Jadwal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= route_to('tambah.jadwal'); ?>" method="POST" id="formTambahJadwal">
        <?= csrf_field(); ?>
        <div class="modal-body">
            <div class="row gy-3">
                <div class="col-12">
                    <label for="kode_prodi" class="form-label">Prodi</label>
                    <select name="kode_prodi" id="kode_prodi" class="form-select">
                        <option value="" selected disabled>-- Pilih -- </option>
                        <?php foreach($prodi as $row1): ?>
                            <option value="<?= $row1['kode_prodi'] ?>"><?= $row1['nama_prodi'] ?> (<?= $row1['kode_prodi'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label for="id_kelas" class="form-label">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-select" disabled>
                        <option value="" selected disabled>-- Pilih --</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="kode_matkul" class="form-label">Matakuliah</label>
                    <div id="ajax_kodeMatkul">
                        <select name="kode_matkul" id="kode_matkul" class="form-select" disabled>
                            <option value="" selected disabled>-- Pilih -- </option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                        </div>
                        <div class="col-4">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" id="timePicker" class="form-control">
                        </div>
                        <div class="col-4">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" id="timePicker" class="form-control">
                        </div>
                    </div>
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
