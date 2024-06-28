<?= $this->include('partials/header_dosen') ?>
    <div class="page-content">
        <section class="row">
            <div class="col-12">

            <?php if(session()->has('pesan')): 
                $pesan = session('pesan');
                ?>
                <div class="alert alert-light-<?= $pesan['alert'] ?> alert-dismissible fade show">
                    <?= $pesan['pesan'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session()->has('gagal')): ?>
                <div class="alert alert-light-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        <?php foreach(session()->get('gagal') as $gagal): ?>
                            <li><?= $gagal ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <h5>Sesi Terdaftar</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1" data-table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Sesi</th>
                                    <th>Keterangan Sesi</th>
                                    <th>Passing Grade</th>
                                    <th>Soal</th>
                                    <th>Kelas</th>
                                    <th>Matakuliah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($sesi_diampu as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($row['nama_sesi']) ?></td>
                                        <td><?= esc($row['keterangan_sesi']) ?></td>
                                        <td><?= esc($row['passing_grade']) ?></td>
                                        <td><?= esc($row['jumlah_soal']) ?></td>
                                        <td><?= esc($row['nama_kelas']) ?></td>
                                        <td><?= esc($row['nama_matkul']) ?> (<?= $row['kode_matkul'] ?>)</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="<?= route_to('hal.daftar.soal', $row['id_sesi']) ?>" class="me-1 btn btn-primary btn-sm rounded col-12" style="width:110px;"><i class="fa-solid fa-pen-to-square"></i> Kelola Soal</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>
<?= $this->include('partials/footer_dosen') ?>