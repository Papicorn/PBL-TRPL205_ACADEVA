<?php foreach($matkul as $row): ?>
<div class="modal fade" id="p<?= $row['kode_matkul'] ?>Ubah" tabindex="-1" aria-labelledby="p<?= $row['kode_matkul'] ?>Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="p<?= $row['kode_matkul'] ?>Label">Ubah Data Matakuliah</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= route_to('ubah.matkul', $row['kode_matkul']); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal-body">
            <div class="row gy-3">
                <div class="col-12">
                    <label for="kode_matkul" class="form-label">Kode Matkul</label>
                    <input type="text" class="form-control" disabled name="kode_matkul" id="kode_matkul" placeholder="Masukkan Kode Matkul" value="<?= $row['kode_matkul'] ?>">
                </div>
                <div class="col-12">
                    <label for="nama_matkul" class="form-label">Nama Matkul</label>
                    <input type="text" class="form-control" name="nama_matkul" id="nama_matkul" placeholder="Masukkan Nama Matkul" value="<?= $row['nama_matkul'] ?>">
                </div>
                <div class="col-12 col-md-6">
                    <label for="nidn" class="form-label">Pengampu</label>
                    <select name="nidn" id="nidn" class="form-select">
                        <option value="" disabled>-- Pilih --</option>
                        <?php foreach($dosen as $row1): ?>
                            <option value="<?= $row1['nidn'] ?>" <?php if($row['nidn'] == $row1['nidn']): ?> selected <?php endif; ?>><?= $row1['nama_lengkap'] ?> (NIDN: <?= $row['nidn'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label for="kode_prodi" class="form-label">Prodi</label>
                    <select name="kode_prodi" id="kode_prodi" class="form-select">
                        <option value="" selected disabled>-- Pilih --</option>
                        <?php foreach($prodi as $row1): ?>
                            <option value="<?= $row1['kode_prodi'] ?>" <?php if($row['kode_prodi'] == $row1['kode_prodi']): ?> selected <?php endif; ?>><?= $row1['nama_prodi'] ?> (<?= $row['kode_prodi'] ?>)</option>
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
<?php endforeach; ?>