<?php foreach($soal_ujian as $row): ?>
    <div class="modal fade" id="modal<?= $row['id_soal'] ?>UbahSoal" tabindex="-1" aria-labelledby="modal<?= $row['id_soal'] ?>UbahSoalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal<?= $row['id_soal'] ?>UbahSoalLabel">Ubah Data Soal <?= $row['id_soal'] ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="<?= route_to('ubah.soal', $row['id_soal']); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="soal" class="form-label">Soal</label>
                            <textarea name="soal" id="soal" class="form-control" placeholder="Masukkan pertanyaan soal"><?= esc($row['soal']) ?></textarea>
                        </div>
                        <div class="col-12">
                            <label for="poin" class="form-label">Poin</label>
                            <input type="number" class="form-control" name="poin" id="poin" placeholder="5" value="<?= esc($row['poin']) ?>">
                        </div>
                        <?php $no = 2; ?>
                        <?php foreach($pilihan_ubah as $row1): ?>
                            <?php if($row1['id_soal'] == $row['id_soal']): ?>
                                <?php if($row1['benar_salah'] === 'Benar'): ?>
                                    <div class="col-12">
                                        <label for="pilihan_benar" class="form-label">Pilihan Benar</label>
                                        <div class="input-group">
                                        <input type="text" class="form-control" name="pilihan_benar" id="pilihan_benar" placeholder="Masukkan pilihan Benar" value="<?= esc($row1['ktrngan_pilihan']) ?>" aria-describedby="benar">
                                        <input type="hidden" name="id_pilihan_benar" value="<?= $row1['id_pilihan'] ?>">
                                        <span class="input-group-text" id="benar">Benar</span>
                                        </div>
                                        <p class="form-text mb-0">*Pilihan akan diacak.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="col-12">
                                        <label for="pilihan<?= $no ?>" class="form-label">Pilihan <?= $no ?></label>
                                        <input type="text" class="form-control" name="pilihan[]" id="pilihan<?= $no ?>" placeholder="Masukkan pilihan <?= $no ?>" value="<?= $row1['ktrngan_pilihan'] ?>">
                                        <input type="hidden" name="id_pilihan_salah[]" value="<?= $row1['id_pilihan'] ?>">
                                    </div>
                                    <?php $no++ ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
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