<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Redirect::home');
$routes->get('/home', 'TampilanController::index', ['as' => 'home']);
$routes->get('/ketentuan-dan-layanan', 'TampilanController::terms');
$routes->get('/keluar','AdminController::keluar', ['as' => 'fungsi.keluar']);
$routes->get('/beranda', 'AdminController::beranda');

$routes->group('masuk', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/','TampilanController::masuk', ['as' => 'tampilan.masuk']);
    $routes->post('admin','AdminController::masuk', ['as' => 'masuk.administrator']);
    $routes->post('mahasiswa','MahasiswaController::masuk', ['as' => 'masuk.mahasiswa']);
    $routes->post('dosen','DosenController::masuk', ['as' => 'masuk.dosen']);
}); 

$routes->group('admin', ['namespace'=> 'App\Controllers'], static function ($routes) {
    $routes->get('beranda', 'AdminController::beranda', ['as' => 'beranda.admin']);
    $routes->get('data-akun', 'AdminController::halamanDataAkun', ['as' => 'hal.data_akun']);
    $routes->get('matakuliah', 'MatakuliahController::halamanMatakuliah', ['as' => 'hal.matakuliah']);
    $routes->get('kelas', 'KelasController::halamanKelas', ['as' => 'hal.kelas']);
    $routes->get('prodi', 'ProdiController::halamanProdi', ['as' => 'hal.prodi']);
    $routes->get('jadwal-asesmen', 'JadwalUjianController::halamanJadwalAsesmen', ['as' => 'hal.jadwal_asesmen']);
});

$routes->group('dosen', ['namespace'=> 'App\Controllers'], static function ($routes)  {
    $routes->get('beranda', 'DosenController::beranda', ['as' => 'beranda.dosen']);
    $routes->get('sesi-ujian', 'SesiController::halamanSesi', ['as' => 'hal.sesi_ujian']);
    $routes->get('bank-soal', 'SoalUjianController::halamanSoal', ['as' => 'hal.soal']);
    $routes->get('daftar-soal/(:any)', 'SoalUjianController::halamanDaftarSoal/$1', ['as' => 'hal.daftar.soal']);
    $routes->get('rekapitulasi', 'RekapitulasiController::halamanRekapitulasi', ['as' => 'hal.rekapitulasi']);
    $routes->post('cetak-mahasiswa', 'RekapitulasiController::cetakMahasiswa', ['as' => 'cetak.mahasiswa']);
});

$routes->group('mahasiswa', ['namespace'=> 'App\Controllers'], static function ($routes)  {
    $routes->get('beranda', 'MahasiswaController::beranda', ['as' => 'beranda.mahasiswa']);
    $routes->get('jadwal-asesmen', 'JadwalUjianController::halamanJadwalAsesmen', ['as' => 'hal.jadwal_asesmen']);
    $routes->get('hasil-asesmen', 'RekapitulasiController::halamanHasilAsesmen', ['as' => 'hal.hasil_asesmen']);
    $routes->get('asesmen/(:num)', 'SoalUjianController::halamanAsesmenAwal/$1', ['as' => 'hal.asesmen_awal']);
    $routes->get('asesmen/mengerjakan/(:any)', 'SoalUjianController::halamanAsesmen/$1', ['as' => 'hal.asesmen']);
    $routes->post('asesmen/kirim/(:any)', 'RekapitulasiController::kirimAsesmen/$1', ['as' => 'kirim.asesmen']);
    $routes->get('asesmen/hasil/(:any)', 'RekapitulasiController::setelahAsesmen/$1', ['as' => 'setelah.asesmen']);
});

$routes->group('tambah', ['namespace'=> 'App\Controllers'], static function ($routes) {
    $routes->post('dosen', 'DosenController::daftar', ['as' => 'tambah.dosen']);
    $routes->post('mahasiswa', 'MahasiswaController::daftar', ['as' => 'tambah.mahasiswa']);
    $routes->post('matkul', 'MatakuliahController::tambahMatkul', ['as' => 'tambah.matkul']);
    $routes->post('kelas', 'KelasController::tambahKelas', ['as' => 'tambah.kelas']);
    $routes->post('prodi', 'ProdiController::tambahProdi', ['as' => 'tambah.prodi']);
    $routes->post('jadwal', 'JadwalUjianController::tambahJadwal', ['as' => 'tambah.jadwal']);
    $routes->post('sesi/(:any)', 'SesiController::tambahSesi/$1', ['as' => 'tambah.sesi']);
    $routes->post('soal/(:any)', 'SoalUjianController::tambahSoal/$1', ['as' => 'tambah.soal']);
});

$routes->group('hapus', ['namespace'=> 'App\Controllers'], static function ($routes) {
    $routes->post('dosen/(:any)', 'DosenController::hapusDataDosen/$1', ['as' => 'hapus.dosen']);
    $routes->post('mahasiswa/(:any)', 'MahasiswaController::hapusDataMahasiswa/$1', ['as' => 'hapus.mahasiswa']);
    $routes->post('matakuliah/(:any)', 'MatakuliahController::hapusMatkul/$1', ['as' => 'hapus.matkul']);
    $routes->post('kelas/(:any)', 'KelasController::hapusKelas/$1', ['as' => 'hapus.kelas']);
    $routes->post('prodi/(:any)', 'ProdiController::hapusProdi/$1', ['as' => 'hapus.prodi']);
    $routes->post('jadwal/(:any)', 'JadwalUjianController::hapusJadwal/$1', ['as' => 'hapus.jadwal']);
    $routes->post('sesi/(:any)', 'SesiController::hapusSesi/$1', ['as' => 'hapus.sesi']);
    $routes->post('soal/(:any)', 'SoalUjianController::hapusSoal/$1', ['as' => 'hapus.soal']);
});

$routes->group('ubah', ['namespace'=> 'App\Controllers'], static function ($routes) {
    $routes->post('dosen/(:any)', 'DosenController::ubahDataDosen/$1', ['as' => 'ubah.dosen']);
    $routes->post('mahasiswa/(:any)', 'MahasiswaController::ubahDataMahasiswa/$1', ['as' => 'ubah.mahasiswa']);
    $routes->post('matakuliah/(:any)', 'MatakuliahController::ubahMatkul/$1', ['as' => 'ubah.matkul']);
    $routes->post('kelas/(:any)', 'KelasController::ubahKelas/$1', ['as' => 'ubah.kelas']);
    $routes->post('prodi/(:any)', 'ProdiController::ubahProdi/$1', ['as' => 'ubah.prodi']);
    $routes->post('jadwal/(:any)', 'JadwalUjianController::ubahJadwal/$1', ['as' => 'ubah.jadwal']);
    $routes->post('sesi/(:any)', 'SesiController::ubahSesi/$1', ['as' => 'ubah.sesi']);
    $routes->post('soal/(:any)', 'SoalUjianController::ubahSoal/$1', ['as' => 'ubah.soal']);
});
$routes->group('ajax', ['namespace'=> 'App\Controllers'], static function ($routes) {
    $routes->post('ambil-matkul-prodi', 'AjaxController::ambilMatkulProdi', ['as' => 'ajax.prodi.matkul']);
    $routes->post('ambil-kelas-prodi', 'AjaxController::ambilKelasProdi', ['as' => 'ajax.prodi.kelas']);
    $routes->post('simpan-jawaban-mahasiswa', 'AjaxController::simpanJawabanMahasiswa', ['as' => 'simpan.jawaban.mahasiswa']);
    $routes->post('simpan-ragu-mahasiswa', 'AjaxController::simpanStatusRagu', ['as' => 'simpan.status.ragu']);
});