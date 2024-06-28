<?= $this->include('partials/header_mahasiswa') ?>

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
                            <div class="card-header bg-primary">
                                <h5 class="mb-0 text-light">Petunjuk Penggunaan E-Asesmen</h5>
                            </div>
                            <div class="card-body pt-4">
                                <ol type="1" class="mb-0">
                                    <li class="mb-3">
                                        <font class="fw-bold"><i class="bi bi-grid-fill"></i> Beranda</font><br>
                                        Pada bagian beranda, mahasiswa dapat melihat informasi terkait asesmen yang telah diikuti, rata-rata nilai, Informasi terkait jadwal asesmen, dan kalender asesmen.
                                    </li>
                                    <li class="mb-3">
                                        <font class="fw-bold"><i class="fa-solid fa-clipboard-list"></i> Jadwal Asesmen</font><br>
                                        Pada bagian jadwal asesmen terdapat informasi terkait jadwal yang akan dikerjakan sesuai dengan tanggal yang ada pada jadwal.
                                    </li>
                                    <li>
                                        <font class="fw-bold"><i class="fa-solid fa-box-archive"></i> Hasil Asesmen</font><br>
                                        Pada halaman hasil asesmen, mahasiswa dapat melihat informasi terkait hasil ujian yang telah diikuti. Mahasiswa dapat melihat informasi terkait nilai yang di terima, target kelulusan dan tombol untuk melihat detail hasil asesmen yang diikuti.
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon red mb-2">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Asesmen Diikuti</h6>
                                                <h6 class="font-extrabold mb-0"><?= $data_beranda['ujian_diikuti'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon green mb-2">
                                                    <i class="iconly-boldDiscount"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Rata-Rata Nilai</h6>
                                                <h6 class="font-extrabold mb-0"><?= $data_beranda['ratanilai'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon primary mb-2">
                                                    <i class="iconly-boldFilter-2"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Program Studi</h6>
                                                <h6 class="font-extrabold mb-0"><?= $data_beranda['kode_prodi'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldWork"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Kelas</h6>
                                                <h6 class="font-extrabold mb-0"><?= $data_beranda['nama_kelas'] ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Jadwal Mendatang</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" data-table id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Matkul</th>
                                            <th>Kelas</th>
                                            <th>Tanggal</th>
                                            <th>Waktu mulai</th>
                                            <th>Waktu Selesai</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach($jadwal as $row): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['nama_matkul'] ?></td>
                                                <td><?= $row['nama_kelas'] ?></td>
                                                <td><?= $row['tanggal'] ?></td>
                                                <td><?= $row['waktu_mulai'] ?></td>
                                                <td><?= $row['waktu_selesai'] ?></td>
                                                <td><span class="badge bg-<?= $row['badge'] ?>"><?= $row['status'] ?></span></td>
                                                <td><a href="<?= route_to('hal.asesmen_awal', $row['id_jadwal']) ?>" class="btn rounded btn-<?php if($row['status'] === 'Selesai'){ echo 'secondary'; } ?> btn-sm <?php if($row['status'] === 'Selesai' || $row['status'] === 'Belum Dimulai'){ echo 'disabled'; } ?>" <?php if($row['status'] === 'Selesai'){ echo 'p'; } else { echo 'style="background-color:green;color:#fff;"' ;} ?>><?php if($row['status'] === 'Selesai'){ echo 'Asesmen Selesai'; } elseif($row['status'] === 'Belum Dimulai') { echo '<i class="fa-solid fa-play"></i> Belum Dimulai'; } else { echo '<i class="fa-solid fa-play"></i> Mulai Asesmen'; } ?></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Kalender Asesmen</h5>
                            </div>
                            <div class="card-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

<?= $this->include('fungsi/fullcalendar_mahasiswa') ?>
<?= $this->include('partials/footer_mahasiswa') ?>