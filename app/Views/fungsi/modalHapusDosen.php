<?php foreach($dosen as $row): ?>
    <div class="modal fade" id="p<?= $row['nidn'] ?>Hapus" tabindex="-1" aria-labelledby="<?= $row['nidn'] ?>label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="<?= $row['nidn'] ?>label">Konfirmasi Penghapusan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= route_to('hapus.dosen', $row['nidn']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p class="text-danger fw-semibold">Menghapus data dosen, akan menghapus semua data terkait seperti matakuliah, dll. Pastikan semua data terkait tidak lagi terhubung!</p>
                    <p>Apakah anda ingin benar-benar menghapus data <b><?= esc($row['nama_pengguna']) ?></b>?</p>
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