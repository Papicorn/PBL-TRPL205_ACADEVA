<?php foreach($sesi as $row): ?>
    <div class="modal fade" id="p<?= $row['id_sesi'] ?>ubahSesi" tabindex="-1" aria-labelledby="p<?= $row['id_sesi'] ?>ubahSesiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="p<?= $row['id_sesi'] ?>ubahSesiLabel">Ubah Data Sesi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= route_to('ubah.sesi', $row['id_sesi']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="nama_matkul" class="form-label">Matakuliah</label>
                            <input type="text" name="nama_matkul" id="nama_matkul" class="form-control" disabled value="<?= $row['nama_matkul'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="nama_kelas" class="form-label">Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" disabled value="<?= $row['nama_kelas'] ?>">
                        </div>
                        <div class="col-12">
                            <label for="nama_sesi" class="form-label">Nama Sesi</label>
                            <input type="text" id="nama_sesi" name="nama_sesi" class="form-control" placeholder="Masukkan nama sesi" value="<?= $row['nama_sesi'] ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="keterangan_sesi" class="form-label">Catatan/Keterangan Sesi</label>
                            <input type="text" id="keterangan_sesi" name="keterangan_sesi" class="form-control" placeholder="Sesi ini..." value="<?= $row['keterangan_sesi'] ?>">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="passing_grade" class="form-label">Passing Grade</label>
                            <input type="number" id="passing_grade" name="passing_grade" class="form-control" placeholder="250" value="<?= $row['passing_grade'] ?>">
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