<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Redirect::home');
$routes->get('/home', 'TampilanController::index');
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
    $routes->get('jadwal-ujian', 'JadwalUjianController::halamanJadwalUjian', ['as' => 'hal.jadwal_ujian']);
});

$routes->group('tambah', ['namespace'=> 'App\Controllers'], static function ($routes) {
    $routes->post('dosen', 'DosenController::daftar', ['as' => 'tambah.dosen']);
    $routes->post('mahasiswa', 'MahasiswaController::daftar', ['as' => 'tambah.mahasiswa']);
    $routes->post('matkul', 'MatakuliahController::tambahMatkul', ['as' => 'tambah.matkul']);
    $routes->post('kelas', 'KelasController::tambahKelas', ['as' => 'tambah.kelas']);
    $routes->post('prodi', 'ProdiController::tambahProdi', ['as' => 'tambah.prodi']);
    $routes->post('jadwal', 'JadwalUjianController::tambahJadwal', ['as' => 'tambah.jadwal']);
});

$routes->group('hapus', ['namespace'=> 'App\Controllers'], static function ($routes) {
    $routes->post('dosen/(:any)', 'DosenController::hapusDataDosen/$1', ['as' => 'hapus.dosen']);
    $routes->post('mahasiswa/(:any)', 'MahasiswaController::hapusDataMahasiswa/$1', ['as' => 'hapus.mahasiswa']);
    $routes->post('matakuliah/(:any)', 'MatakuliahController::hapusMatkul/$1', ['as' => 'hapus.matkul']);
    $routes->post('kelas/(:any)', 'KelasController::hapusKelas/$1', ['as' => 'hapus.kelas']);
    $routes->post('prodi/(:any)', 'ProdiController::hapusProdi/$1', ['as' => 'hapus.prodi']);
    $routes->post('jadwal/(:any)', 'JadwalUjianController::hapusJadwal/$1', ['as' => 'hapus.jadwal']);
});

$routes->group('ubah', ['namespace'=> 'App\Controllers'], static function ($routes) {
    $routes->post('dosen/(:any)', 'DosenController::ubahDataDosen/$1', ['as' => 'ubah.dosen']);
    $routes->post('mahasiswa/(:any)', 'MahasiswaController::ubahDataMahasiswa/$1', ['as' => 'ubah.mahasiswa']);
    $routes->post('matakuliah/(:any)', 'MatakuliahController::ubahMatkul/$1', ['as' => 'ubah.matkul']);
    $routes->post('kelas/(:any)', 'KelasController::ubahKelas/$1', ['as' => 'ubah.kelas']);
    $routes->post('prodi/(:any)', 'ProdiController::ubahProdi/$1', ['as' => 'ubah.prodi']);
    $routes->post('jadwal/(:any)', 'JadwalUjianController::ubahJadwal/$1', ['as' => 'ubah.jadwal']);
});
$routes->group('ajax', ['namespace'=> 'App\Controllers'], static function ($routes) {
    $routes->post('ambil-matkul-prodi', 'AjaxController::ambilMatkulProdi', ['as' => 'ajax.prodi.matkul']);
    $routes->post('ambil-kelas-prodi', 'AjaxController::ambilKelasProdi', ['as' => 'ajax.prodi.kelas']);
});


