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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Grafik Data Rekapitulasi</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="bar" style="width:100%;" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h5>Rekapitulasi Mahasiswa</h5>
                                <div class="dropdown">
                                    <a class="btn btn-secondary btn-sm dropdown-toggle" href="#" role="button" id="CetakData" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-print"></i> Cetak data rekapitulasi
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="CetakData">
                                        <li><a href="" type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCetakMahasiswa">Cetak dari mahasiswa</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1" data-table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>NIM</th>
                                            <th>Kelas</th>
                                            <th>Matakuliah</th>
                                            <th>Sesi</th>
                                            <th>Total Nilai</th>
                                            <th>Passing Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach($data_rekap as $row): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['nama_lengkap'] ?></td>
                                                <td><?= $row['nim'] ?></td>
                                                <td><?= $row['nama_kelas'] ?></td>
                                                <td><?= $row['nama_matkul'] .' ('. $row['kode_matkul'] . ')' ?></td>
                                                <td><?= $row['nama_sesi'] ?></td>
                                                <td><?= $row['total_nilai'] ?></td>
                                                <td><?= $row['passing_grade'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <?= $this->include('fungsi/modalCetakMahasiswa') ?>

                    </div>
                </div>

            </div>
        </section>
    </div>

<?= $this->include('fungsi/chartRekapDosen') ?>
<?= $this->include('partials/footer_dosen') ?>