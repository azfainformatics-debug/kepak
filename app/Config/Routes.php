<?php

namespace Config;

use CodeIgniter\Config\Routing;

$routes = Services::routes();

$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->group('api/v1', ['namespace' => 'App\\Controllers\\Api\\V1'], static function (Routing $routes): void {
    $routes->post('auth/login', 'AuthController::login');
    $routes->post('auth/logout', 'AuthController::logout', ['filter' => 'jwtAuth']);
    $routes->get('auth/me', 'AuthController::me', ['filter' => 'jwtAuth']);
    $routes->put('auth/me', 'AuthController::updateProfile', ['filter' => 'jwtAuth']);

    $routes->resource('master/tahun', ['controller' => 'MasterController']);
    $routes->resource('master/opd', ['controller' => 'MasterController']);
    $routes->resource('master/unit', ['controller' => 'MasterController']);
    $routes->resource('master/sasaran', ['controller' => 'MasterController']);
    $routes->resource('master/kamus-indikator', ['controller' => 'MasterController']);
    $routes->resource('master/indikator-daerah', ['controller' => 'MasterController']);
    $routes->resource('master/program', ['controller' => 'MasterController']);
    $routes->resource('master/kegiatan', ['controller' => 'MasterController']);
    $routes->resource('master/subkegiatan', ['controller' => 'MasterController']);
    $routes->resource('master/indikator-opd', ['controller' => 'MasterController']);

    $routes->resource('pk', ['controller' => 'PkController']);
    $routes->post('pk/(:num)/generate-details', 'PkController::generateDetails/$1');
    $routes->get('pk/(:num)/details', 'PkController::details/$1');
    $routes->put('pk/(:num)/details', 'PkController::updateDetails/$1');
    $routes->post('pk/(:num)/submit', 'PkController::submit/$1');
    $routes->post('pk/(:num)/return', 'PkController::return/$1');
    $routes->post('pk/(:num)/verify-kab', 'PkController::verifyKab/$1');
    $routes->post('pk/(:num)/approve-kepala-opd', 'PkController::approveKepalaOpd/$1');

    $routes->resource('realisasi', ['controller' => 'RealisasiController']);
    $routes->get('realisasi/(:num)/details', 'RealisasiController::details/$1');
    $routes->post('realisasi/(:num)/details', 'RealisasiController::createDetail/$1');
    $routes->put('realisasi/(:num)/details', 'RealisasiController::updateDetails/$1');
    $routes->post('realisasi/details/(:num)/bukti', 'RealisasiController::uploadBukti/$1');
    $routes->get('realisasi/details/(:num)/bukti', 'RealisasiController::listBukti/$1');
    $routes->delete('realisasi/details/(:num)/bukti/(:num)', 'RealisasiController::deleteBukti/$1/$2');
    $routes->post('realisasi/(:num)/submit', 'RealisasiController::submit/$1');
    $routes->post('realisasi/(:num)/return', 'RealisasiController::return/$1');
    $routes->post('realisasi/(:num)/verify-opd', 'RealisasiController::verifyOpd/$1');
    $routes->post('realisasi/(:num)/verify-kab', 'RealisasiController::verifyKab/$1');
    $routes->post('realisasi/(:num)/lock', 'RealisasiController::lock/$1');

    $routes->get('dashboard/monev/summary', 'DashboardController::summary');
    $routes->get('dashboard/monev/opd', 'DashboardController::opd');
    $routes->get('dashboard/monev/sasaran', 'DashboardController::sasaran');

    $routes->resource('evaluasi', ['controller' => 'EvaluasiController']);
    $routes->resource('rencana-aksi', ['controller' => 'RencanaAksiController']);

    $routes->post('lkjip/opd/generate', 'LkjipOpdController::generate');
    $routes->get('lkjip/opd/(:num)', 'LkjipOpdController::show/$1');
    $routes->put('lkjip/opd/(:num)', 'LkjipOpdController::update/$1');
    $routes->get('lkjip/opd/(:num)/bab', 'LkjipOpdController::bab/$1');
    $routes->put('lkjip/opd/(:num)/bab', 'LkjipOpdController::updateBab/$1');
    $routes->post('lkjip/opd/(:num)/submit', 'LkjipOpdController::submit/$1');
    $routes->post('lkjip/opd/(:num)/return', 'LkjipOpdController::return/$1');
    $routes->post('lkjip/opd/(:num)/approve-kepala-opd', 'LkjipOpdController::approveKepalaOpd/$1');
    $routes->post('lkjip/opd/(:num)/export/pdf', 'LkjipOpdController::exportPdf/$1');

    $routes->resource('apip/reviu', ['controller' => 'ReviuApipController']);
    $routes->resource('apip/reviu/(:num)/temuan', ['controller' => 'TemuanApipController']);
    $routes->resource('apip/temuan/(:num)/tindaklanjut', ['controller' => 'TindakLanjutApipController']);

    $routes->post('lkjip/kab/generate', 'LkjipKabController::generate');
    $routes->get('lkjip/kab/(:num)', 'LkjipKabController::show/$1');
    $routes->put('lkjip/kab/(:num)', 'LkjipKabController::update/$1');
    $routes->get('lkjip/kab/(:num)/bab', 'LkjipKabController::bab/$1');
    $routes->put('lkjip/kab/(:num)/bab', 'LkjipKabController::updateBab/$1');
    $routes->post('lkjip/kab/(:num)/submit', 'LkjipKabController::submit/$1');
    $routes->post('lkjip/kab/(:num)/approve-sekda', 'LkjipKabController::approveSekda/$1');
    $routes->post('lkjip/kab/(:num)/approve-bupati', 'LkjipKabController::approveBupati/$1');
    $routes->post('lkjip/kab/(:num)/return', 'LkjipKabController::return/$1');
    $routes->post('lkjip/kab/(:num)/export/pdf', 'LkjipKabController::exportPdf/$1');

    $routes->resource('publikasi', ['controller' => 'PublikasiController']);
    $routes->resource('arsip', ['controller' => 'ArsipController']);
    $routes->get('files', 'FilesController::index');
    $routes->get('files/(:num)/download', 'FilesController::download/$1');
});

$routes->group('', ['namespace' => 'App\\Controllers\\Web'], static function (Routing $routes): void {
    $routes->get('wireframes', 'WireframeController::index');
});
