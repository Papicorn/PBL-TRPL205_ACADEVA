<?= $this->include('partials/header_mahasiswa') ?>

    <div class="page-content">
        <section class="row">
            <div class="col-12">

                <div class="row">
                    <div class="col-12">
                        <div class="card border border-2 border-danger">
                            <div class="card-header">
                                <h5>Mengerjakan Asesmen</h5>
                            </div>
                            <div class="card-body">
                                <h6>Petunjuk dan Aturan Asesmen:</h6>
                                <ul>
                                    <li><strong>Kesiapan Teknis:</strong> Pastikan koneksi internet Anda stabil selama pelaksanaan asesmen. Gunakan perangkat yang kompatibel dan pastikan baterai perangkat terisi penuh atau terhubung ke sumber listrik.</li>
                                    <li><strong>Durasi Asesmen:</strong> Asesmen ini memiliki batas waktu tertentu. Pastikan Anda menyelesaikan semua soal sebelum waktu habis. Waktu akan mulai dihitung sejak Anda memulai asesmen.</li>
                                    <li><strong>Perilaku Selama Asesmen:</strong> Dilarang keras melakukan kecurangan dalam bentuk apapun selama asesmen. Jangan menggunakan bahan referensi atau bantuan dari orang lain kecuali diizinkan.</li>
                                    <li><strong>Navigasi Soal:</strong> Anda dapat berpindah antar soal menggunakan tombol navigasi. Pastikan untuk menyimpan jawaban Anda sebelum berpindah ke soal berikutnya.</li>
                                    <li><strong>Penyimpanan Jawaban:</strong> Jawaban Anda akan disimpan secara sementara setiap kali Anda menekan tombol "Selanjutnya". Pastikan semua jawaban sudah diisi sebelum mengakhiri asesmen.</li>
                                    <li><strong>Kondisi Darurat:</strong> Jika terjadi masalah teknis, segera hubungi pengawas asesmen atau administrator sistem. Jangan panik, masalah teknis akan ditangani dengan sebaik-baiknya untuk memastikan asesmen Anda tidak terganggu.</li>
                                </ul>

                                <h6>Tata Cara Asesmen:</h6>
                                <ul>
                                    <li><strong>Memulai Asesmen:</strong> Klik tombol "Mulai Asesmen" untuk memulai.</li>
                                    <li><strong>Navigasi:</strong> Gunakan tombol "Sebelumnya" dan "Selanjutnya" atau klik nomor soal di sebelah kiri untuk berpindah antar soal.</li>
                                    <li><strong>Mengakhiri Asesmen:</strong> Setelah menjawab semua soal, klik "Selesaikan Asesmen" untuk mengumpulkan jawaban Anda.</li>
                                </ul>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="konfirmasi" id="konfirmasi">
                                        <label class="form-check-label" for="konfirmasi">
                                            Dengan mengikuti petunjuk dan aturan di atas, Anda turut serta menjaga integritas dan kelancaran pelaksanaan asesmen ini. Semoga sukses!
                                        </label>
                                    </div>
                                <div class="text-center" id="tombol-mulai" style="display: none;">
                                    <a href="<?= route_to('hal.asesmen', $id_jadwal) ?>" class="btn btn-primary">Mulai asesmen</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

<?= $this->include('partials/footer_mahasiswa') ?>