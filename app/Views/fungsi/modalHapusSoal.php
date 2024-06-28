<?php foreach($soal_ujian as $row): ?>
    <div class="modal fade" id="p<?= $row['id_soal'] ?>HapusSoal" tabindex="-1" aria-labelledby="p<?= $row['id_soal'] ?>HapusSoallabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="p<?= $row['id_soal'] ?>HapusSoallabel">Konfirmasi Penghapusan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= route_to('hapus.soal', $row['id_soal']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p class="text-danger fw-semibold">Menghapus data soal, akan menghapus semua data terkait. Pastikan data terkait tidak lagi terhubung!</p>
                    <p>Apakah anda ingin benar-benar menghapus soal <b><?= esc($row['soal']) ?> (<?= $row['nama_sesi'] ?>)</b>?</p>
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