<?= $this->include('partials/header_mahasiswa') ?>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row" id="section_asesmen">
                <div class="col-12">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-0">Asesmen</h5>
                                <h6 class="mb-0"><?= $jadwal['nama_matkul'] ?></h6>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center justify-content-end">
                                    <p class="bg-primary rounded-start p-2 mb-0" style="color:#fff;">Sisa Waktu</p>
                                    <p id="sisaWaktu" class="bg-secondary rounded-end p-2 mb-0" style="color:#fff;">00:00:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="<?= route_to('kirim.asesmen', $jadwal['id_jadwal']) ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row" id="section_asesmen2">
                    <div class="col-7">
                        <?php $no = 1; ?>
                        <?php foreach($sesi_sekarang as $sesi): ?>
                            <?php foreach($soal_sekarang as $soal): ?>
                                <?php if($soal['id_sesi'] == $sesi['id_sesi']): ?>
                                <div class="card question" style="display: none;">
                                    <div class="card-header border-bottom d-flex align-items-center">
                                        <h5 class="mb-0 fw-bold">Soal No</h5> 
                                        <span class="badge bg-primary rounded-circle badge-lg ms-2 fs-6 m-0"><?= $no ?></span>
                                    </div>
                                    <div class="card-body pt-3">
                                        <div class="mb-4 fw-bold"><?= $soal['soal'] ?></div>
                                        <ol class="row gy-3 mb-5 ps-0" type="a">
                                            <?php foreach($pilihan_sekarang as $pil): ?>
                                            <?php if($pil['id_soal'] == $soal['id_soal'] && $pil['ktrngan_pilihan'] !== '-'): ?>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input ragu" type="radio" name="pilihan[<?= $soal['id_soal'] ?>]" id="<?= $pil['id_pilihan'] ?>" value="<?= $pil['id_pilihan'] ?>" data-soal-index="<?= $no-1 ?>" 
                                                    <?php 
                                                        $jawaban = session()->get('jawaban');
                                                        if ($jawaban !== null && isset($jawaban[$soal['id_soal']]) && $jawaban[$soal['id_soal']] == $pil['id_pilihan']) {
                                                            echo 'checked'; 
                                                        } 
                                                    ?>>
                                                    <li class="ms-3">
                                                        <label class="form-check-label" for="<?= $pil['id_pilihan'] ?>">
                                                            <?= $pil['ktrngan_pilihan'] ?>
                                                        </label>
                                                    </li>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ol>
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 btn-primary btn-sm rounded btn <?php if($no == 1) { echo 'disabled'; } ?>" style="color:#fff;" onclick="prevQuestion()"><i class="fa-solid fa-sm fa-angle-left"></i> Sebelumnya</p>
                                            <button type="submit" class="btn-danger btn-sm rounded btn" style="color:#fff;" id="kirim_asesmen" <?php if($no != $total_soal) { echo 'hidden'; } ?>>Selesaikan Asesmen</button>
                                            <p class="mb-0 btn-primary btn-sm rounded btn <?php if($no == $total_soal) { echo 'disabled'; } ?>" style="color:#fff;" id="nextButton" onclick="nextQuestion()">Selanjutnya <i class="fa-solid fa-sm fa-angle-right"></i></p>
                                        </div>
                                    </div>
                                </div>
                                <?php $no++ ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-header">
                                <h5>Navigasi Soal</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-4 mb-4">
                                    <?php $i = 0; ?>
                                    <?php foreach($sesi_sekarang as $sesi): ?>
                                        <?php foreach ($soal_sekarang as $soal): ?>
                                            <?php if($soal['id_sesi'] == $sesi['id_sesi']): ?>
                                                <?php 
                                                    $bg_class = 'bg-secondary';
                                                    if (isset(session()->get('jawaban')[$soal['id_soal']])) {
                                                        $bg_class = 'bg-success';
                                                    }
                                                ?>
                                                <div class="col-2">
                                                    <a href="#" data-index="<?= $i; ?>" class="nav-link" data-soal-id="<?= $soal['id_soal']; ?>">
                                                        <span class="badge <?= $bg_class ?> justify-content-center d-flex align-items-center" style="color:#fff; font-size: 15px; width: 45px; height: 45px;">
                                                            <?= $i + 1 ?>
                                                        </span>
                                                    </a>
                                                </div>
                                                <?php $i++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <p class="mb-0"><i class="fa-solid text-success fa-square"></i> Telah dijawab</p>
                                    <p class="mb-0 ms-3"><i class="fa-solid text-secondary fa-square"></i> Belum dijawab</p>
                                    <p class="mb-0 ms-3"><i class="fa-regular text-primary fa-square"></i> Nomor saat ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" id="habis_waktu" style="display:none;">
                    <div class="col-12">
                        <div class="card border border-2 border-danger">
                            <div class="card-header">
                                <h5>Waktu telah habis!</h5>
                            </div>
                            <div class="card-body">
                                <p>Anda belum melakukan penyelesaian asesmen ketika waktu akan habis, maka anda tidak akan dapat mengerjakan asesmen kembali. Harap melakukan pengiriman asesmen dengan menekan tombol <b>Selesaikan Asesmen</b> dibawah.</p>
                                <p>Hasil asesmen akan tampil ketika anda anda menekan tombol <b>Selesaikan Asesmen</b>!</p>
                                <div class="text-center" id="tombol-mulai" style="display: none;">
                                    <button type="submit" class="btn btn-primary mt-3">Selesaikan asesmen</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
let currentQuestion = 0;
const questions = document.querySelectorAll('.question');
const navLinks = document.querySelectorAll('.nav-link');
const spans = document.querySelectorAll('.nav-link span');
const nextButton = document.getElementById('nextButton');
const kirimAsesmen = document.getElementById('kirim_asesmen');

function showQuestion(index) {
    questions.forEach((question, i) => {
        question.style.display = i === index ? 'block' : 'none';
    });
    if (index === questions.length - 1) {
        nextButton.style.display = 'none';
        kirimAsesmen.style.display = 'block';
    } else {
        nextButton.style.display = 'block';
        kirimAsesmen.style.display = 'none';
    }
    updateActiveNav(index);
}

function updateActiveNav(index) {
    navLinks.forEach((link, i) => {
        if (i === index) {
            spans[i].classList.add('border', 'border-3', 'border-primary', 'shadow');
        } else {
            spans[i].classList.remove('border', 'border-3', 'border-primary', 'shadow');
        }
    });
}

function prevQuestion() {
    if (currentQuestion > 0) {
        currentQuestion--;
        showQuestion(currentQuestion);
    }
}

function nextQuestion() {
    if (currentQuestion < questions.length - 1) {
        currentQuestion++;
        showQuestion(currentQuestion);
    }
}

navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const index = parseInt(this.getAttribute('data-index'));
        currentQuestion = index;
        showQuestion(currentQuestion);
    });
});

const radioButtons = document.querySelectorAll('.form-check-input');
radioButtons.forEach(radio => {
    radio.addEventListener('change', function() {
        const soalIndex = parseInt(this.getAttribute('data-soal-index'));
        spans[soalIndex].classList.remove('bg-secondary', 'bg-warning');
        spans[soalIndex].classList.add('bg-success');

        const soalIdMatch = this.name.match(/\[(\d+)\]/);
        const soalId = soalIdMatch ? soalIdMatch[1] : null;
        const pilihanId = this.value;
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= route_to('simpan.jawaban.mahasiswa') ?>', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(`Jawaban berhasil disimpan ${soalId} ${pilihanId}`);
                } else {
                    console.error('Gagal menyimpan jawaban');
                }
            }
        };
        xhr.send(`soal_id=${soalId}&pilihan_id=${pilihanId}`);
    });
});

document.addEventListener('DOMContentLoaded', (event) => {
    const jawaban = <?= json_encode(session()->get('jawaban')); ?>;
    sessionJawaban = jawaban; // Simpan jawaban sesi ke variabel global
    
    navLinks.forEach((link, index) => {
        const soalId = link.getAttribute('data-soal-id');
        if (soalId && jawaban[soalId]) {
            spans[index].classList.remove('bg-secondary');
            spans[index].classList.add('bg-success');
        }
    });
    showQuestion(currentQuestion); // Panggil showQuestion untuk memastikan navigasi awal diperbarui
});

function twoDigits(num) {
    return num.toString().padStart(2, '0');
}

const jadwalMulai = new Date("<?= $jadwal['tanggal'] . ' ' . $jadwal['waktu_mulai'] ?>").getTime();
const jadwalSelesai = new Date("<?= $jadwal['tanggal'] . ' ' . $jadwal['waktu_selesai'] ?>").getTime();

const timer = setInterval(function() {
    const now = new Date().getTime();
    const distance = jadwalSelesai - now;

    if (distance < 0) {
        clearInterval(timer);
        document.getElementById("sisaWaktu").innerHTML = "00:00:00";
        document.getElementById("section_asesmen").style.display = 'none';
        document.getElementById("section_asesmen2").style.display = 'none';
        document.getElementById("habis_waktu").style.display = 'block';
        document.getElementById("tombol-mulai").style.display = 'block';
        return;
    }

    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("sisaWaktu").innerHTML = `${twoDigits(hours)}:${twoDigits(minutes)}:${twoDigits(seconds)}`;
}, 1000);

showQuestion(currentQuestion);
</script>

<?= $this->include('partials/footer_mahasiswa') ?>
