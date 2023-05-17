<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login/index';
$route['404_override'] = 'Welcome/halaman_notFound';
$route['translate_uri_dashes'] = FALSE;

//Auth
$route['login'] = 'Login/index';
$route['proses_login'] = 'Login/proses_login';
$route['logout'] = 'Login/proses_logout';

//Front
$route['aset/detail/(:any)'] = 'Welcome/detailAset/(:any)';

//Dashboard
$route['home'] = 'Home/index';

//Statistik
$route['statistik'] = 'Statistik/index';

//Master
$route['barang'] = 'Barang/index';
$route['barang/tambah'] = 'Barang/tambahBarang';
$route['barang/simpan'] = 'Barang/simpanBarang';
$route['barang/edit/(:any)'] = 'Barang/editBarang/(:any)';
$route['barang/ubah'] = 'Barang/ubahBarang';
$route['barang/hapus/(:any)'] = 'Barang/hapusBarang/(:any)';
//Jenis Barang
$route['kategori'] = 'KategoriBarang/index';
$route['kategori/simpan'] = 'KategoriBarang/store';
$route['kategori/ubah'] = 'KategoriBarang/ubah';
$route['kategori/hapus/(:any)'] = 'KategoriBarang/hapus/(:any)';
//LokasiAset
$route['lokasi'] = 'LokasiAset/index';
$route['lokasi/simpan'] = 'LokasiAset/simpanLokasi';
$route['lokasi/ubah'] = 'LokasiAset/ubahLokasi';
$route['lokasi/hapus/(:any)'] = 'LokasiAset/hapusLokasi/(:any)';
//User
$route['users'] = 'User/users';
$route['users/tambah'] = 'User/tambahUser';
$route['users/hapus/(:any)'] = 'User/hapusUser/(:any)';
$route['pengaturan'] = 'User/pengaturan';
$route['users/ubah'] = 'User/updateUser';
$route['users/change_identity'] = 'User/change_identity';
$route['users/ubah_password'] = 'User/updatePassword';

//Aset
$route['aset_wujud'] = 'Aset/index';
$route['aset_wujud/tambah'] = 'Aset/tambahAset';
$route['aset_wujud/cari'] = 'Aset/cariAset';
$route['aset_wujud/simpan'] = 'Aset/simpanAset';
$route['aset_wujud/edit/(:any)'] = 'Aset/editAset/(:any)';
$route['aset_wujud/ubah'] = 'Aset/ubahAset';
$route['aset_wujud/detail/(:any)'] = 'Aset/detailAset/(:any)';
$route['aset_wujud/hapus/(:any)'] = 'Aset/hapusAset/(:any)';
$route['aset_wujud/filter'] = 'Aset/filterAset';
$route['destroy-aset/(:any)'] = 'Aset/destroy_aset/(:any)';

$route['print-selected-qrcode'] = 'Laporan/print_selected_qr';

$route['print-all-aset'] = 'Aset/print_all_aset';
$route['export-all-aset'] = 'Laporan/export_all_aset';
$route['print-aset/(:any)/(:any)'] = 'Aset/print_filter_aset/(:any)/(:any)';
$route['export-aset/(:any)/(:any)'] = 'Laporan/export_filter_aset/(:any)/(:any)';

//Dihapuskan
$route['aset_dihapuskan'] = 'Aset/dihapuskanAset';
$route['aset_dihapuskan/detail/(:any)'] = 'Aset/detailDihapuskanAset/(:any)';
$route['aset_dihapuskan/filter'] = 'Aset/filterAsetDihapuskan';

$route['print-all-dihapuskan'] = 'Aset/printDihapuskan';
$route['print-dihapuskan/(:any)/(:any)'] = 'Aset/printFilterDihapuskan/(:any)/(:any)';

//Keputusan Pengadaan
$route['kriteria'] = 'Pengadaan/index';
$route['spesifikasi/ubah'] = 'Pengadaan/ubahSpesifikasi';
$route['kualitas/ubah'] = 'Pengadaan/ubahKualitas';
$route['data_aset'] = 'Pengadaan/aset';
$route['data_aset/simpan'] = 'Pengadaan/simpanAset';
$route['data_aset/ubah'] = 'Pengadaan/ubahAset';
$route['data_aset/hapus/(:any)'] = 'Pengadaan/hapusAset/(:any)';
$route['penilaian/simpan'] = 'Pengadaan/simpanPenilaian';
$route['penilaian/ubah'] = 'Pengadaan/ubahPenilaian';
$route['penilaian/hapus/(:any)'] = 'Pengadaan/hapusPenilaian/(:any)';
//spk
$route['spk'] = 'Pengadaan/spk';
$route['test'] = 'Pengadaan/testpk';

//Pengadaan
$route['pengajuan'] = 'Pengadaan/pengajuan';
$route['pengadaan'] = 'Pengadaan/pengadaan';
$route['pengadaan/simpan'] = 'Pengadaan/simpanPengadaan';
$route['pengadaan/detail/(:any)'] = 'Pengadaan/detailPengadaan/(:any)';
$route['pengadaan/setujui/(:any)'] = 'Pengadaan/setujuiPengadaan/(:any)';
$route['pengadaan/tolak/(:any)'] = 'Pengadaan/tolakPengadaan/(:any)';
$route['pengadaan/hapus/(:any)'] = 'Pengadaan/hapusPengadaan/(:any)';
$route['pengadaan/filter'] = 'Pengadaan/filterPengadaan';

$route['print-all-pengadaan'] = 'Pengadaan/print_data';
$route['export-all-pengadaan'] = 'Laporan/export_pengadaan';
$route['print-pengadaan/(:any)/(:any)'] = 'Pengadaan/print_filter_data/(:any)/(:any)';
$route['export-pengadaan/(:any)/(:any)'] = 'Laporan/export_filter_pengadaan/(:any)/(:any)';

//Monitoring
$route['monitoring'] = 'Monitoring/index';
$route['monitoring/tambah'] = 'Monitoring/tambahMonitoring';
$route['monitoring/simpan'] = 'Monitoring/simpanMonitoring';
$route['monitoring/detail/(:any)'] = 'Monitoring/detailMonitoring/(:any)';
$route['monitoring/edit/(:any)'] = 'Monitoring/editMonitoring/(:any)';
$route['monitoring/ubah'] = 'Monitoring/ubahMonitoring';
$route['monitoring/hapus/(:any)'] = 'Monitoring/hapusMonitoring/(:any)';
$route['print-all-monitoring'] = 'Monitoring/print_all_data';
$route['export-all-monitoring'] = 'Laporan/export_all_monitoring';

$route['print-monitoring/(:any)/(:any)'] = 'Monitoring/print_filter_data/(:any)/(:any)';
$route['export-monitoring/(:any)/(:any)'] = 'Laporan/export_filter_monitoring/(:any)/(:any)';

//Penyusutan
$route['penyusutan'] = 'Penyusutan/index';
$route['penyusutan/detail/(:any)'] = 'Penyusutan/detailPenyusutan/(:any)';
$route['penyusutan/hapuskan/(:any)'] = 'Penyusutan/penghapusanAset/(:any)';
$route['print-all-penyusutan'] = 'Penyusutan/print_data';
$route['export-all-penyusutan'] = 'Laporan/export_penyusutan';

$route['print-penyusutan/(:any)/(:any)'] = 'Penyusutan/print_filter_data/(:any)/(:any)';
$route['export-penyusutan/(:any)/(:any)'] = 'Laporan/export_filter_penyusutan/(:any)/(:any)';

//Penghapusan
$route['penghapusan'] = 'Penghapusan/index';
$route['penghapusan/simpan'] = 'Penghapusan/simpanPenghapusan';

//Laporan
//Laporan Data Aset
$route['laporan/aset'] = 'Laporan/aset';
$route['laporan/search_aset'] = 'Laporan/searchAset';
$route['laporan/print_aset/(:any)/(:any)'] = 'Laporan/printAset/(:any)/(:any)';
$route['laporan/export_aset/(:any)/(:any)'] = 'Laporan/export_aset/(:any)/(:any)';
//Laporan Penghapusan
$route['laporan/penghapusan'] = 'Laporan/penghapusan';
$route['laporan/search_penghapusan'] = 'Laporan/searchPenghapusan';
$route['laporan/print_penghapusan/(:any)/(:any)'] = 'Laporan/printPenghapusan/(:any)/(:any)';
$route['laporan/export_penghapusan/(:any)/(:any)'] = 'Laporan/export_penghapusan/(:any)/(:any)';
//Laporan QR Code
$route['print-all-qr'] = 'Aset/print_all_Qrcode';
$route['print-qr/(:any)/(:any)'] = 'Aset/printFilterQR/(:any)/(:any)';
//Laporan Pengadaan
$route['laporan/pengadaan'] = 'Laporan/pengadaan';
$route['laporan/search_pengadaan'] = 'Laporan/searchPengadaan';
$route['laporan/print_pengadaan/(:any)/(:any)'] = 'Laporan/printPengadaan/(:any)/(:any)';
$route['laporan/export_pengadaan/(:any)/(:any)'] = 'Laporan/export_pengadaan/(:any)/(:any)';

//Peminjaman
$route['loan'] = 'Loan/index';
$route['loan/add'] = 'Loan/create';
$route['loan-store'] = 'Loan/store';
$route['loan-update'] = 'Loan/update_data';
$route['loan/edit/(:any)'] = 'Loan/edit/(:any)';
$route['loan/show/(:any)'] = 'Loan/show/(:any)';
$route['loan/destroy/(:any)'] = 'Loan/destroy/(:any)';
$route['print-loan/(:any)'] = 'Loan/print_data/(:any)';
$route['export-loan/(:any)'] = 'Laporan/export_loan/(:any)';

$route['bl-store'] = 'Loan/store_bl';
$route['bl-update'] = 'Loan/update_bl';
$route['bl-destroy/(:any)/(:any)'] = 'Loan/destroy_bl/(:any)/(:any)';

$route['aset/get_list_item'] = 'Aset/get_list_item';

$route['cart'] = 'Cart/index';
$route['cart-store'] = 'Cart/store';
$route['cart-update'] = 'Cart/update_data';
$route['cart-delete'] = 'Cart/destroy';
$route['cart-reset'] = 'Cart/reset_data';


//Settingan 
$route['(:any)'] = 'errors/show_404';
$route['(:any)/(:any)'] = 'errors/show_404';
$route['(:any)/(:any)/(:any)'] = 'errors/show_404';
