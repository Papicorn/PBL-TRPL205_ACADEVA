
        <?= $this->include('partials/header_admin'); ?>

    
<div class="page-content"> 
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon primary mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Mahasiswa Terdaftar</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_mhs ?></h6>
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
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Dosen Terdaftar</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_dosen ?></h6>
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
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Soal Ujian Tersimpan</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_soal ?></h6>
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
                                        <i class="iconly-boldCalendar"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Jadwal Tersimpan</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_jadwal ?></h6>
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
                            <h4>List Jadwal</h4>
                        </div>
                        <div class="card-body">
                        <table class="table table-striped" id="table1" data-table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Matkul</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Waktu mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                <?php foreach($semua_jadwal as $rowjadwal): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($rowjadwal['nama_matkul']) ?></td>
                                        <td><?= esc($rowjadwal['nama_kelas']) ?></td>
                                        <td><?= esc($rowjadwal['tanggal']) ?></td>
                                        <td><?= esc($rowjadwal['waktu_mulai']) ?></td>
                                        <td><?= esc($rowjadwal['waktu_selesai']) ?></td>
                                        <td><span class="badge bg-<?= $rowjadwal['badge'] ?>"><?= $rowjadwal['status'] ?></span></td>
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
                            <h4>Kalender Ujian</h4>
                        </div>
                        <div class="card-body">
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</div>

<?= $this->include('fungsi/fullcalendar_admin'); ?>

<?= $this->include('partials/footer_admin'); ?>