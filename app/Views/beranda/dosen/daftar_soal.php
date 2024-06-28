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
        
        <a href="<?= route_to('hal.soal') ?>" class="btn btn-primary mb-3"><i class="fa-solid fa-chevron-left"></i> Kembali</a>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5><?= $sesi_diampu['nama_sesi'] ?></h5>
                        <span class="badge rounded-pill bg-primary badge-sm"><?= $jumlah_soal ?> Soal</span>
                        <span class="badge rounded-pill bg-warning badge-sm"><?= $jumlah_poin ?> Poin</span>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#modalTambahSoal"><i class="fa-solid fa-clipboard-question"></i> Tambah Soal</button>
                    </div>
                    <?= $this->include('fungsi/modalTambahSoal') ?>
                </div>
            </div>
            <div class="card-body">
                <?php $no = 1; ?>
                <?php foreach($soal_ujian as $row): ?><hr>
                <div class="row gx-2">
                    <div class="col-10">
                        <p><?= $no++ . ". " . $row['soal'] ?></p>
                        <ol type="a">
                            <?php foreach($pilihan_soal as $row1): ?>
                                <?php if($row1['id_soal'] === $row['id_soal']): ?>
                                    <li><?= esc($row1['ktrngan_pilihan']) ?> <?php if($row1['benar_salah'] === "Benar"): ?><b class="text-primary"> ( <i class="fa-solid fa-circle-check"></i> Benar )</b><?php endif; ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                    <div class="col-2">
                        <div class="row gx-1">
                            <div class="col-6">
                                <button class="float-end btn btn-secondary btn-sm mb-2 mb-md-0" type="button" data-bs-toggle="modal" data-bs-target="#modal<?= $row['id_soal'] ?>UbahSoal"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#p<?= $row['id_soal'] ?>HapusSoal"><i class="fa-solid fa-trash"></i> Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?= $this->include('fungsi/modalUbahSoal') ?>
        <?= $this->include('fungsi/modalHapusSoal') ?>

        </div>
    </section>
</div>

<?= $this->include('partials/footer_dosen') ?>
