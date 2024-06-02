<?php foreach($jadwal as $row): ?>
<div class="modal fade" id="p<?= $row['id_jadwal'] ?>UbahJadwal" tabindex="-1" aria-labelledby="p<?= $row['id_jadwal'] ?>UbahJadwalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="p<?= $row['id_jadwal'] ?>UbahJadwalLabel">Ubah Data Jadwal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= route_to('ubah.jadwal', $row['id_jadwal']); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal-body">
            <div class="row gy-3">
                <div class="col-12">
                    <label for="kode_prodi" class="form-label">Prodi</label>
                    <select name="kode_prodi" id="kode_prodi1" class="form-select" data-id_jadwal="<?= $row['id_jadwal'] ?>">
                        <option value="" selected disabled>-- Pilih -- </option>
                        <?php foreach($prodi as $row1): ?>
                            <option value="<?= $row1['kode_prodi'] ?>" <?php if($row['kode_prodi'] == $row1['kode_prodi']): ?> selected <?php endif; ?>><?= $row1['nama_prodi'] ?> (<?= $row1['kode_prodi'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label for="id_kelas" class="form-label">Kelas</label>
                    <select name="id_kelas" id="id_kelas<?= $row['id_jadwal'] ?>" class="form-select" disabled>
                        <option value="" disabled>-- Pilih --</option>
                        <option value="<?= $row['id_kelas'] ?>" selected><?= $row['nama_kelas'] ?></option>
                    </select>
                    <input type="hidden" name="id_kelas" id="hidden_id_kelas<?= $row['id_jadwal'] ?>" value="<?= $row['id_kelas'] ?>">
                </div>
                <div class="col-12">
                    <label for="kode_matkul" class="form-label">Matakuliah</label>
                    <div id="ajax_kodeMatkul">
                        <select name="kode_matkul" id="kode_matkul<?= $row['id_jadwal'] ?>" class="form-select" disabled>
                            <option value="" disabled>-- Pilih -- </option>
                            <option value="<?php $row['kode_matkul'] ?>" selected><?= $row['nama_matkul'] ?> (<?= $row['kode_matkul'] ?>)</option>
                        </select>
                        <input type="hidden" name="kode_matkul" id="hidden_kode_matkul<?= $row['id_jadwal'] ?>" value="<?= $row['kode_matkul'] ?>">
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $row['tanggal'] ?>">
                        </div>
                        <div class="col-4">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" id="timePicker" class="form-control" value="<?= $row['waktu_mulai'] ?>">
                        </div>
                        <div class="col-4">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" id="timePicker" class="form-control" value="<?= $row['waktu_selesai'] ?>">
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
<?php endforeach; ?>