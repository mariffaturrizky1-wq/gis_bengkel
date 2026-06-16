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