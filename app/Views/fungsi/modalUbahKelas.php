<?php foreach($kelas as $row): ?>
    <div class="modal fade" id="p<?= $row['id_kelas'] ?>UbahKelas" tabindex="-1" aria-labelledby="p<?= $row['id_kelas'] ?>UbahKelasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="p<?= $row['id_kelas'] ?>UbahKelasLabel">Ubah Data Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= route_to('ubah.kelas', $row['id_kelas']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="nama_kelas" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Masukkan Nama Kelas" value="<?= $row['nama_kelas'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="kode_prodi" class="form-label">Prodi</label>
                            <select name="kode_prodi" id="kode_prodi" class="form-select">
                                <option value="" selected disabled>-- Pilih --</option>
                                <?php foreach($prodi as $row1): ?>
                                    <option value="<?= $row1['kode_prodi'] ?>" <?php if($row['kode_prodi'] == $row1['kode_prodi']): echo "selected"; endif; ?>><?= $row1['nama_prodi'] ?> (<?= $row['kode_prodi'] ?>)</option>
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