<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
*/

$routes->get('/', 'Home::index');
$routes->get('/Admin', 'Admin::index');
$routes->get('Admin/Setting', 'Admin::Setting');
$routes->post('Admin/UpdateSetting', 'Admin::UpdateSetting');
$routes->get('/Wilayah', 'Wilayah::index');
$routes->get('/Wilayah/Input', 'Wilayah::Input');
$routes->post('Wilayah/InsertData', 'Wilayah::InsertData');
$routes->get('Wilayah/Edit/(:num)', 'Wilayah::Edit/$1');
$routes->post('Wilayah/UpdateData/(:num)', 'Wilayah::UpdateData/$1');
$routes->get('Wilayah/Delete/(:num)', 'Wilayah::Delete/$1');
$routes->get('User', 'User::index');

$routes->get('Bengkel', 'Bengkel::index');
$routes->get('/Bengkel/Input', 'Bengkel::Input');
$routes->get('bengkel/kabupaten', 'Bengkel::kabupaten');
$routes->get('bengkel/kecamatan', 'Bengkel::kecamatan');
$routes->post('Bengkel/InsertData', 'Bengkel::InsertData');

$routes->get('Bengkel/Edit/(:num)', 'Bengkel::Edit/$1');
$routes->post('Bengkel/UpdateData/(:num)', 'Bengkel::UpdateData/$1');

$routes->get('Kategori', 'Kategori::index');
$routes->post('Kategori/UpdateData/(:num)', 'Kategori::UpdateData/$1');

$routes->get('Bengkel/Delete/(:num)', 'Bengkel::Delete/$1');
$routes->get('Bengkel/Detail/(:num)', 'Bengkel::Detail/$1');
$routes->get('User/Input', 'User::Input');
$routes->post('User/InsertData', 'User::InsertData');
$routes->get('User/Edit/(:num)', 'User::Edit/$1');
$routes->post('User/UpdateData/(:num)', 'User::UpdateData/$1');
$routes->get('User/Delete/(:num)', 'User::Delete/$1');

$routes->get('auth/login', 'Auth::login');          // ✅ route ke halaman login
$routes->get('auth/daftar', 'Auth::daftar');
$routes->post('auth/simpan_daftar', 'Auth::simpan_daftar');
$routes->post('auth/cek_login_user', 'Auth::cek_login_user'); // ✅ proses login
$routes->get('admin', 'Admin::index');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('Auth/Login', 'Auth::login');
$routes->get('Admin', 'Admin::index');

$routes->get('auth/LogOut', 'Auth::LogOut');

$routes->get('home', 'Home::index');