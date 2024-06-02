<?php foreach($kelas as $row): ?>
    <div class="modal fade" id="p<?= $row['id_kelas'] ?>HapusKelas" tabindex="-1" aria-labelledby="<?= $row['id_kelas'] ?>labelKelas" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="<?= $row['id_kelas'] ?>labelKelas">Konfirmasi Penghapusan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= route_to('hapus.kelas', $row['id_kelas']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p class="text-danger fw-semibold">Menghapus data kelas, akan menghapus semua data terkait. Pastikan data terkait tidak lagi terhubung!</p>
                    <p>Apakah anda ingin benar-benar menghapus kelas <b><?= esc($row['nama_kelas']) ?></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>

            </div>
        </div>
    </div>
<?php endforeach; ?>