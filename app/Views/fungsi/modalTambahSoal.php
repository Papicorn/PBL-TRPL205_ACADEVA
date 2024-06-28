<div class="modal fade" id="modalTambahSoal" tabindex="-1" aria-labelledby="modalTambahSoalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalTambahSoalLabel">Tambah Data Soal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= route_to('tambah.soal', $sesi_diampu['id_sesi']); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal-body">
            <div class="row gy-3">
                <div class="col-12">
                    <label for="soal" class="form-label">Soal</label>
                    <textarea name="soal" id="soal" class="form-control" placeholder="Masukkan pertanyaan soal"></textarea>
                </div>
                <div class="col-12">
                    <label for="poin" class="form-label">Poin</label>
                    <input type="number" class="form-control" name="poin" id="poin" placeholder="5">
                </div>
                <div class="col-12">
                    <label for="pilihan_benar" class="form-label">Pilihan Benar</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="pilihan_benar" id="pilihan_benar" placeholder="Masukkan pilihan Benar" aria-describedby="benar">
                      <span class="input-group-text" id="benar">Benar</span>
                    </div>
                    <p class="form-text mb-0">*Pilihan akan diacak.</p>
                </div>
                <div class="col-12">
                    <label for="pilihan2" class="form-label">Pilihan 2</label>
                    <input type="text" class="form-control" name="pilihan[]" id="pilihan2" placeholder="Masukkan pilihan 2">
                    <p class="form-text mb-0">*berikan - jika tidak ingin dikosongkan.</p>
                </div>
                <div class="col-12">
                    <label for="pilihan3" class="form-label">Pilihan 3</label>
                    <input type="text" class="form-control" name="pilihan[]" id="pilihan3" placeholder="Masukkan pilihan 3">
                    <p class="form-text mb-0">*berikan - jika tidak ingin dikosongkan.</p>
                </div>
                <div class="col-12">
                    <label for="pilihan4" class="form-label">Pilihan 4</label>
                    <input type="text" class="form-control" name="pilihan[]" id="pilihan4" placeholder="Masukkan pilihan 4">
                    <p class="form-text mb-0">*berikan - jika tidak ingin dikosongkan.</p>
                </div>
                <div class="col-12">
                    <label for="pilihan5" class="form-label">Pilihan 5</label>
                    <input type="text" class="form-control" name="pilihan[]" id="pilihan5" placeholder="Masukkan pilihan 5">
                    <p class="form-text mb-0">*berikan - jika tidak ingin dikosongkan.</p>
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