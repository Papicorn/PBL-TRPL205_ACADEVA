<?php foreach($jadwal_diampu as $row): ?>
    <div class="modal fade modal-lg" id="p<?= $row['id_jadwal'] ?>KelolaSesi" tabindex="-1" aria-labelledby="p<?= $row['id_jadwal'] ?>KelolaSesi" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="p<?= $row['id_jadwal'] ?>KelolaSesi">Kelola Sesi <?= $row['nama_matkul'] ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h5>Informasi Jadwal</h5>
                    <p>
                        <b>Nama Matkul:</b> <?= $row['nama_matkul'] ?><br>
                        <b>Kelas:</b> <?= $row['nama_kelas'] ?><br>
                        <b>Tanggal / Mulai-Selesai:</b> <?= $row['tanggal'] . " / " . $row['waktu_mulai'] . "-" . $row['waktu_selesai'] ?>
                    </p><hr>
                    <h5>Sesi Terdaftar</h5>
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sesi</th>
                                <th>Keterangan Sesi</th>
                                <th>Passing Grade</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($sesi as $row1): ?>
                                <?php if($row1['id_jadwal'] == $row['id_jadwal']): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row1['nama_sesi'] ?></td>
                                        <td><?= $row1['keterangan_sesi'] ?></td>
                                        <td><?= $row1['passing_grade'] ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="me-1 btn btn-secondary btn-sm rounded col-12" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row1['id_sesi'] ?>ubahSesi" style="width:80px;"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                                                <button class="btn btn-danger btn-sm rounded col-12" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row1['id_sesi'] ?>HapusSesi" style="width:80px;"><i class="fa-solid fa-trash"></i> Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table><hr>
                    <h5>Tambah Sesi</h5>
                    <form action="<?= route_to('tambah.sesi', $row['id_jadwal']) ?>" method="post">
                    <?= csrf_field(); ?>
                        <div class="row gy-3">
                            <div class="col-12">
                                <label for="nama_sesi" class="form-label">Nama Sesi</label>
                                <input type="text" id="nama_sesi" name="nama_sesi" class="form-control" placeholder="Masukkan nama sesi">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="keterangan_sesi" class="form-label">Catatan/Keterangan Sesi</label>
                                <input type="text" id="keterangan_sesi" name="keterangan_sesi" class="form-control" placeholder="Sesi ini...">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="passing_grade" class="form-label">Passing Grade</label>
                                <input type="number" id="passing_grade" name="passing_grade" class="form-control" placeholder="250">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>