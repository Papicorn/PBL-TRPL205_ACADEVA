<?= $this->include('partials/header_dosen.php') ?>

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
                    <h5>Jadwal Asesmen Diampu</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1" data-table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Matakuliah</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach($jadwal_diampu as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['nama_matkul']) ?> (<?= esc($row['kode_matkul']) ?>)</td>
                                    <td><?= esc($row['nama_kelas']) ?></td>
                                    <td><?= $row['tanggal'] ?></td>
                                    <td><?= $row['waktu_mulai'] ?></td>
                                    <td><?= $row['waktu_selesai'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="me-1 btn btn-primary btn-sm rounded col-12" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row['id_jadwal'] ?>KelolaSesi" style="width:110px;"><i class="fa-solid fa-pen-to-square"></i> Kelola Sesi</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?= $this->include('fungsi/modalKelolaSesi') ?>
            <?= $this->include('fungsi/modalUbahSesi') ?>
            <?= $this->include('fungsi/modalHapusSesi') ?>

        </div>
    </section>
</div>

<?= $this->include('partials/footer_dosen.php') ?>