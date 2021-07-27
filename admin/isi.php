<?php
include "include/koneksi.php";

if ($_GET['module'] == "home") {
	include "module/home.php";
}
else if ($_GET['module'] == "laporan") {
	include "module/laporan/laporan.php";	
}
else if ($_GET['module'] == "laporan2") {
	include "module/laporan/laporan2.php";	
}
else if ($_GET['module'] == "divisi") {
	include "module/data_divisi/divisi.php";	
}
else if ($_GET['module'] == "supplier") {
	include "module/data_supplier/supplier.php";	
}
else if ($_GET['module'] == "barang") {
	include "module/barang/barang.php";	
}
else if ($_GET['module'] == "kategori") {
	include "module/kategori/kategori.php";	
}
else if ($_GET['module'] == "user") {
	include "module/user/user.php";	
}
else if ($_GET['module'] == "brg_masuk") {
	include "module/barang_masuk/barang_masuk.php";	
}
else if ($_GET['module'] == "brg_keluar") {
	include "module/barang_keluar/barang_keluar.php";	
}
else if ($_GET['module'] == "edit_user") {
	include "module/user/edit_user.php";	
}
else if ($_GET['module'] == "cek_penawaran") {
	include "module/cek_penawaran/cek_penawaran.php";	
}	
else if ($_GET['module'] == "slo") {
	include "module/slo/cek_slo.php";	
}
else if ($_GET['module'] == "edit_divisi") {
	include "module/data_divisi/edit_divisi.php";	
}
else if ($_GET['module'] == "hapus_divisi") {
	include "module/data_divisi/hapus_divisi.php";	
}
else if ($_GET['module'] == "tambah_divisi") {
	include "module/data_divisi/tambah_divisi.php";	
}
else if ($_GET['module'] == "stok") {
	include "module/stok/stok.php";	
}
else if ($_GET['module'] == "mengelola_pengajuan") {
	include "module/mengelola_pengajuan/mengelola_pengajuan.php";	
}
else if ($_GET['module'] == "status_pengajuan") {
	include "module/status_pengajuan/status_pengajuan.php";	
}
else if ($_GET['module'] == "buat_pengajuan") {
	include "module/buat_pengajuan/buat_pengajuan.php";	
}
?>