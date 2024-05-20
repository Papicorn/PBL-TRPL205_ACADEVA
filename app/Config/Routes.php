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
    $routes->get('beranda', 'AdminController::beranda');
});
