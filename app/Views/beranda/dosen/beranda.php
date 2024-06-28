<?= $this->include('partials/header_dosen') ?>

<div class="page-content">
    <section class="row">
        <div class="col-12">

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>List Jadwal</h5>
                    </div>
                    <div class="card-body">
                        <table id="table" data-table class="table table-striped">
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

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Grafik Penyelesaian Ujian</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="bar"></canvas>
                        <i class="form-text">*Data yang ditampilkan merupakan progres penyelesaian ujian mahasiswa dari setiap sesi berdasarkan mata kuliah yang diampu oleh masing-masing dosen.</i>
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

<?= $this->include('fungsi/chart_beranda_dosen.php') ?>
<?= $this->include('fungsi/fullcalendar_dosen') ?>
<?= $this->include('partials/footer_dosen') ?>