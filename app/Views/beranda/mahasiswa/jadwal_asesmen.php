<?= $this->include('partials/header_mahasiswa') ?>

    <div class="page-content">
        <section class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Jadwal Asesmen</h5>
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
                                                <td><?= esc($row['nama_matkul']) ?></td>
                                                <td><?= esc($row['nama_kelas']) ?></td>
                                                <td><?= esc($row['tanggal']) ?></td>
                                                <td><?= esc($row['waktu_mulai']) ?></td>
                                                <td><?= esc($row['waktu_selesai']) ?></td>
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

            </div>
        </section>
    </div>

<?= $this->include('partials/footer_mahasiswa') ?>