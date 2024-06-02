<?php foreach($mhs as $row1): ?>
    <div class="modal fade" id="p<?= $row1['nim'] ?>Ubah" tabindex="-1" aria-labelledby="p<?= $row1['nim'] ?>UbahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="p<?= $row1['nim'] ?>UbahLabel">Ubah Data Mahasiswa</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="<?= route_to('ubah.mahasiswa', $row1['nim']); ?>" method="POST">
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="row gy-3">
                    <div class="col-12">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim" id="nim" placeholder="Masukkan NIM" value="<?= $row1['nim'] ?>" disabled>
                    </div>
                    <div class="col-12">
                        <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" placeholder="Masukkan nama penggunas" value="<?= $row1['nama_pengguna'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukkan nama lengkap" value="<?= $row1['nama_lengkap'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan email" value="<?= $row1['email'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="kata_sandi" class="form-label">Kata Sandi</label>
                        <input type="text" class="form-control" name="kata_sandi" id="kata_sandi" placeholder="Masukkan kata sandi">
                        <i class="form-text mb-0">*Kosongkan jika tidak ingin mengganti kata sandi</i>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="no_telpon" class="form-label">No Telepon</label>
                        <input type="text" class="form-control" name="no_telpon" id="no_telpon" placeholder="Masukkan No Telepon" value="<?= $row1['no_telpon'] ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Masukkan Tanggal Lahir" value="<?= $row1['tanggal_lahir'] ?>">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="kelamin" class="form-label">Kelamin</label>
                        <select name="kelamin" id="kelamin" class="form-select">
                            <option value="" disabled>-- Pilih --</option>
                            <option value="pria" <?php if($row1['kelamin'] == "pria"): ?> selected <?php endif; ?>>Pria</option>
                            <option value="wanita" <?php if($row1['kelamin'] == "wanita"): ?> selected <?php endif; ?>>Wanita</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="id_kelas" class="form-label">Kelas</label>
                        <select name="id_kelas" id="id_kelas1" class="form-select">
                            <option value="" selected disabled>-- Pilih --</option>
                            <?php foreach($kelas as $rowkelas): ?>
                                <option value="<?= $rowkelas['id_kelas'] ?>" <?php if($row1['id_kelas'] == $rowkelas['id_kelas']): ?> selected <?php endif; ?>><?= $rowkelas['nama_kelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="number" class="form-control" name="semester" id="semester" placeholder="Masukkan Semester" value="<?= $row1['semester'] ?>">
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat"><?= $row1['alamat'] ?></textarea>
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