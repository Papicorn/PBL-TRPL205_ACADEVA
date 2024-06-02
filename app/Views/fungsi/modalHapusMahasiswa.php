<?php foreach($mhs as $row1): ?>
    <div class="modal fade" id="p<?= $row1['nim'] ?>Hapus" tabindex="-1" aria-labelledby="<?= $row1['nim'] ?>label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="<?= $row1['nim'] ?>label">Konfirmasi Penghapusan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= route_to('hapus.mahasiswa', $row1['nim']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p class="text-danger fw-semibold">Menghapus data mahasiswa, akan menghapus semua data terkait. Pastikan data terkait tidak lagi terhubung!</p>
                    <p>Apakah anda ingin benar-benar menghapus data <b><?= esc($row1['nama_pengguna']) ?></b>?</p>
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