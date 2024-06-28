<?php foreach($sesi as $row): ?>
    <div class="modal fade" id="p<?= $row['id_sesi'] ?>HapusSesi" tabindex="-1" aria-labelledby="p<?= $row['id_sesi'] ?>HapusSesilabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="p<?= $row['id_sesi'] ?>HapusSesilabel">Konfirmasi Penghapusan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= route_to('hapus.sesi', $row['id_sesi']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p class="text-danger fw-semibold">Menghapus data sesi, akan menghapus semua data terkait. Pastikan data terkait tidak lagi terhubung!</p>
                    <p>Apakah anda ingin benar-benar menghapus sesi <b><?= esc($row['nama_sesi']) ?> (<?= $row['nama_matkul'] ?>) untuk Kelas <?= $row['nama_kelas'] ?></b>?</p>
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