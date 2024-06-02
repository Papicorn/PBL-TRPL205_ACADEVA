<?= $this->include('partials/header_admin') ?>

<div class="page-content">
    <div class="row">
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
                <div class="card-header d-flex justify-content-between">
                    <h5>Jadwal ujian</h5>
                    <div>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal"><i class="fa-solid fa-user-plus me-2"></i> Tambah Data</button>
                    </div>
                    <?= $this->include('fungsi/modalTambahJadwal') ?>
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
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($jadwal as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nama_matkul'] ?> (<?= $row['kode_matkul'] ?>)</td>
                                <td><?= $row['nama_kelas'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= $row['waktu_mulai'] ?></td>
                                <td><?= $row['waktu_selesai'] ?></td>
                                <td><span class="badge bg-<?= $row['badge'] ?>"><?= $row['status'] ?></span></td>
                                <td>
                                    <div class="d-flex">
                                        <button class="me-1 btn btn-secondary btn-sm rounded col-12" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row['id_jadwal'] ?>UbahJadwal" style="width:80px;"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                                        <button class="btn btn-danger btn-sm rounded col-12" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row['id_jadwal'] ?>Hapus" style="width:80px;"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </div>                                    
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?= $this->include('fungsi/modalUbahJadwal'); ?>
                            <?= $this->include('fungsi/modalHapusJadwal'); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('/js/ajax/jadwal_ujian/prodi_matakuliah.js') ?>"></script>
<script src="<?= base_url('/js/ajax/jadwal_ujian/prodi_kelas.js') ?>"></script>
<?= $this->include('partials/footer_admin') ?>
