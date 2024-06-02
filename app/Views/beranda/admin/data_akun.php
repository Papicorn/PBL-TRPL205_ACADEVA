<?= $this->include('partials/header_admin'); ?>

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
                <div class="card-header d-flex justify-content-between">
                    <h5>Dosen</h5>
                    <div>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahDosen"><i class="fa-solid fa-user-plus me-2"></i> Tambah Data</button>
                    </div>
                    <?= $this->include('fungsi/modalTambahDosen'); ?>
                </div>
                <div class="card-body">
                    <table class="table table-striped display" id="table1" style="width:100%" data-table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIDN</th>
                                <th>Nama Pengguna</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Kelamin</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($dosen as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($row['nidn']) ?></td>
                                <td><?= esc($row['nama_pengguna']) ?></td>
                                <td><?= esc($row['nama_lengkap']) ?></td>
                                <td><?= esc($row['email']) ?></td>
                                <td><?= esc($row['kelamin']) ?></td>
                                <td><?= esc($row['no_telpon']) ?></td>
                                <td><?= esc($row['alamat']) ?></td>
                                <td>
                                    <div class="d-flex">
                                        <button class="me-1 btn btn-secondary btn-sm rounded" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row['nidn'] ?>Ubah" style="width:80px;"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                                        <button class="btn btn-danger btn-sm rounded" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row['nidn'] ?>Hapus" style="width:80px;"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?= $this->include('fungsi/modalUbahDosen'); ?>
                        <?= $this->include('fungsi/modalHapusDosen'); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Mahasiswa</h5>
                    <div>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahMahasiswa"><i class="fa-solid fa-user-plus me-2"></i> Tambah Data</button>
                    </div>
                    <?= $this->include('fungsi/modalTambahMahasiswa'); ?>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table" data-table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Pengguna</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                                <th>Kelamin</th>
                                <th>Semester</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach($mhs as $row1): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($row1['nim']) ?></td>
                                <td><?= esc($row1['nama_pengguna']) ?></td>
                                <td><?= esc($row1['nama_lengkap']) ?></td>
                                <td><?= esc($row1['email']) ?></td>
                                <td><?= esc($row1['no_telpon']) ?></td>
                                <td><?= esc($row1['tanggal_lahir']) ?></td>
                                <td><?= esc($row1['alamat']) ?></td>
                                <td><?= esc($row1['nama_kelas']) ?></td>
                                <td><?= esc($row1['kelamin']) ?></td>
                                <td><?= esc($row1['semester']) ?></td>
                                <td>
                                    <div class="d-flex">
                                        <button class="me-1 btn btn-secondary btn-sm rounded col-12" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row1['nim'] ?>Ubah" style="width:80px;"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                                        <button class="btn btn-danger btn-sm rounded col-12" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row1['nim'] ?>Hapus" style="width:80px;"><i class="fa-solid fa-trash"></i> Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        <?= $this->include('fungsi/modalUbahMahasiswa'); ?>
                        <?= $this->include('fungsi/modalHapusMahasiswa'); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

<script src="<?= base_url('/js/ajax/data_akun/prodi_kelas.js') ?>"></script>
<?= $this->include('partials/footer_admin'); ?>