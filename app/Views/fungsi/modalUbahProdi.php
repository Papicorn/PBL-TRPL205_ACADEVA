<?php foreach($prodi as $row): ?>
    <div class="modal fade" id="p<?= $row['kode_prodi'] ?>UbahProdi" tabindex="-1" aria-labelledby="p<?= $row['kode_prodi'] ?>UbahProdiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="p<?= $row['kode_prodi'] ?>UbahProdiLabel">Ubah Data Prodi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= route_to('ubah.prodi', $row['kode_prodi']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="kode_prodi" class="form-label">Kode Prodi</label>
                            <input type="text" class="form-control" name="kode_prodi" id="kode_prodi" placeholder="Masukkan Kode Prodi" value="<?= $row['kode_prodi'] ?>" disabled>
                        </div>
                        <div class="col-12">
                            <label for="nama_prodi" class="form-label">Program Studi</label>
                            <input type="text" class="form-control" name="nama_prodi" id="nama_prodi" placeholder="Masukkan Nama Program Studi" value="<?= $row['nama_prodi'] ?>">
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