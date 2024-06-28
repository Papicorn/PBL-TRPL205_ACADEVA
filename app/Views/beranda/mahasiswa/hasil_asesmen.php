<?= $this->include('partials/header_mahasiswa') ?>

    <div class="page-content">
        <section class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Hasil Asesmen</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1" data-table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Mata Kuliah</th>
                                            <th>Tanggal Asesmen</th>
                                            <th>Waktu</th>
                                            <th>Total Nilai</th>
                                            <th>Nilai Kelulusan</th>
                                            <th>Target</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach($hasil_asesmen as $row): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= esc($row['nama_matkul']) ?></td>
                                                <td><?= esc($row['tanggal']) ?></td>
                                                <td><?= esc($row['waktu_mulai']) ?></td>
                                                <td><?= esc($row['keseluruhan']) ?></td>
                                                <?php 
                                                    $total_grade = 0;
                                                    foreach($sesi as $ses) {
                                                        if($ses['id_jadwal'] == $row['id_jadwal']) {
                                                            $total_grade = $total_grade + $ses['passing_grade'];
                                                        }
                                                    }
                                                    if($row['keseluruhan'] < $total_grade) {
                                                        $target = 'Tidak lulus';
                                                        $badge = 'bg-danger';
                                                    } else {
                                                        $target = 'Lulus';
                                                        $badge = 'bg-success';
                                                    }
                                                ?>
                                                <td><?= esc($total_grade) ?></td>
                                                <td><span class="badge <?= $badge ?>"><?= esc($target) ?></span></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="<?= route_to('setelah.asesmen', $row['id_jadwal']) ?>" class="me-1 btn btn-primary btn-sm rounded col-12" style="width:110px;"><i class="fa-solid fa-pen-to-square"></i> Lihat hasil</a>
                                                    </div>
                                                </td>
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