<?php foreach($dosen as $row): ?>
    <div class="modal fade" id="p<?= $row['nidn'] ?>Ubah" tabindex="-1" aria-labelledby="modalUbahDosenLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalUbahDosenLabel">Edit Data Dosen</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="<?= route_to('ubah.dosen', $row['nidn']); ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="row gy-3">
                    <div class="col-12">
                        <label for="nidn" class="form-label">NIDN</label>
                        <input type="text" class="form-control" name="nidn" id="nidn" placeholder="Masukkan NIDN" value="<?= $row['nidn'] ?>" disabled>
                    </div>
                    <div class="col-12">
                        <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" placeholder="Masukkan Pengguna" value="<?= $row['nama_pengguna'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan Lengkap" value="<?= $row['nama_lengkap'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" value="<?= $row['email'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="kata_sandi" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" name="kata_sandi" id="kata_sandi" placeholder="Masukkan Kata Sandi">
                        <i class="form-text mb-0">*Kosongkan jika tidak ingin mengganti kata sandi</i>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="kelamin" class="form-label">Kelamin</label>
                        <select name="kelamin" id="kelamin" class="form-select">
                            <option value="" disabled>-- Pilih --</option>
                            <option value="pria" <?php if($row['kelamin'] == "pria"): ?> selected <?php endif; ?>>Pria</option>
                            <option value="wanita" <?php if($row['kelamin'] == "wanita"): ?> selected <?php endif; ?>>Wanita</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="no_telpon" class="form-label">No Telepon</label>
                        <input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="Masukkan No Telepon" value="<?= $row['no_telpon'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat"><?= $row['alamat'] ?></textarea>
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