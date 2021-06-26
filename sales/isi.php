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
else if ($_GET['module'] == "pelanggan") {
	include "module/pelanggan/pelanggan.php";	
}
else if ($_GET['module'] == "supplier") {
	include "module/supplier/supplier.php";	
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
else if ($_GET['module'] == "pesanan") {
	include "module/pesanan/pesanan.php";	
}
else if ($_GET['module'] == "harga") {
	include "module/harga/harga.php";	
}

else if ($_GET['module'] == "edit_user") {
	include "module/edit_user.php";	
}
else if ($_GET['module'] == "cek_penawaran") {
	include "module/cek_penawaran/cek_penawaran.php";	
}	
else if ($_GET['module'] == "slo") {
	include "module/slo/cek_slo.php";	
}
?>