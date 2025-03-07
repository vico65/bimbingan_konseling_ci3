<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Web';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//beranda
$route['beranda'] = 'Web/beranda';
//logout
$route['logout'] = 'Web/logout';

//adminbk
// $route['daftar_guru'] = 'Adminbk/adminbkRoute';
// $route['daftar_pelanggaran'] = 'Adminbk/adminbkRoute';
// $route['daftar_siswa'] = 'Adminbk/adminbkRoute';
// $route['histori_laporan'] = 'Adminbk/adminbkRoute';
// $route['daftar_bimbingan'] = 'Adminbk/adminbkRoute';
// $route['sms_gateway'] = 'Adminbk/adminbkRoute';
// $route['jadwal_bimbingan/(:any)'] = 'Adminbk/adminbkRoute';

// Rute untuk daftar guru menggunakan GuruController
$route['daftar_guru'] = 'adminbk/AdminbkController/adminbkRoute';

$route['daftar_kelas'] = 'adminbk/AdminbkController/adminbkRoute';

// Rute untuk daftar pelanggaran menggunakan PelanggaranController
$route['daftar_pelanggaran'] = 'adminbk/AdminbkController/adminbkRoute';

// Rute untuk daftar siswa menggunakan SiswaController
$route['daftar_siswa'] = 'adminbk/AdminbkController/adminbkRoute';

// Rute untuk histori laporan, bisa ditempatkan di BimbinganController atau controller lain
$route['histori_laporan'] = 'adminbk/LaporanController/histori_laporan';

// Rute untuk daftar bimbingan menggunakan BimbinganController
$route['daftar_bimbingan'] = 'adminbk/BimbinganController/index';

// Rute untuk SMS gateway menggunakan SMSController
$route['tahun_ajaran'] = 'adminbk/TahunAjaranController/index';


$route['surat_panggilan'] = 'adminbk/AdminbkController/adminbkRoute';

// Rute untuk jadwal bimbingan, di mana parameter `(:any)` bisa digunakan untuk mencocokkan variabel tertentu
$route['jadwal_bimbingan/(:any)'] = 'adminbk/AdminbkController/adminbkRoute';



//murid
$route['bimbingan'] = 'Murid/MuridRoute';
$route['jadwal_bimbingan'] = 'Murid/MuridRoute';

// guru
$route['daftar_laporan'] = 'Guru/GuruRoute';

// wali
$route['surat'] = 'Orangtua/OrangtuaRoute';



//kepsek
$route['surat'] = 'kepsek/kepsekRoute';

