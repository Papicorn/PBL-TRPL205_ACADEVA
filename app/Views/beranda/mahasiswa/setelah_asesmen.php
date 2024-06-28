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
                        <div class="row">
                            <div class="col-6">
                                
                                <div class="card">
                                    <div class="card-body">
                                        <div class="total-keseluruhan mt-4 d-flex justify-content-center align-items-center">
                                            <h2 class="mb-0 text-center"><?= $nilai_seluruh ?> <br> Poin</h2>
                                        </div>
                                        <div class="poin-sesi border border-2 p-3 mt-4 border-primary">
                                            <div class="row gy-3 d-flex justify-content-center">
                                                <?php $total_pg = 0; ?>
                                                <?php foreach($sesi_sekarang as $sesi): ?>
                                                <div class="col-6">
                                                    <div class="text-center" style="font-size:14px;">
                                                        <p class="mb-0"><i class="fa-solid fa-circle"></i> <?= $sesi['nama_sesi'] ?></p>
                                                        <?php foreach($rekapitulasi as $rekap): ?>
                                                            <?php if($rekap['id_sesi'] == $sesi['id_sesi']): ?>
                                                            <?php if($rekap['total_nilai'] < $sesi['passing_grade']) { $color = 'text-danger'; } else { $color = ''; } ?>
                                                            <p class="mb-0 <?= $color; ?> fw-bold"><?= $rekap['total_nilai'] ?> <br> Poin</p>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                                <?php $total_pg = $total_pg + $sesi['passing_grade']; ?>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <p class="form-text mb-0">*Sesi yang telah anda kerjakan.</p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-6">
                                <?php 
                                    if($nilai_seluruh < $total_pg) {
                                        $border = 'border-danger';
                                    } else {
                                        $border = 'border-success';
                                    }
                                ?>

                                <div class="card border border-3 <?= $border ?>">
                                    <div class="card-body">
                                        <h6 class="text-center">Asesmen - <?= $nama_matkul ?></h6>
                                        <?php 
                                            if($nilai_seluruh < $total_pg) {
                                                $badge_target = 'danger';
                                                $keterangan_target = 'Tidak lulus';
                                                $paragraf = 'Poin anda <b>'. $nilai_seluruh .'</b>, kurang dari passing grade keseluruhan yang ada, yaitu <b>'. $total_pg. '</b>. Jika anda merasa ada kesalahan pada poin yang diterima, anda dapat menghubungi dosen pengampu.';
                                            } else {
                                                $badge_target = 'success';
                                                $keterangan_target = 'Lulus';
                                                $paragraf = 'Poin anda <b>'. $nilai_seluruh .'</b>, masuk ke passing grade keseluruhan yang ada, yaitu <b>'. $total_pg. '</b>. Jika anda merasa ada kesalahan pada poin yang diterima, anda dapat menghubungi dosen pengampu.';
                                            };
                                        ?>
                                        <p class="mb-4 text-center">Target : <span class="badge bg-<?= $badge_target ?>"><?= $keterangan_target ?></span></p>
                                        <p class="mb-3 text-center"><?= $paragraf ?></p>
                                        <h3 class="mb-0 text-center"><?= $grade ?></h3>
                                        <p class="mb-0 text-center fw-bold">Nilai anda</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <a href="<?= route_to('hal.hasil_asesmen') ?>" class="btn btn-sm btn-primary"><i class="fa-solid fa-sm fa-angle-left"></i> Lihat Seluruh Hasil</a>
                    </div>
                </div>

            </div>
        </section>
    </div>

<?= $this->include('partials/footer_mahasiswa') ?>