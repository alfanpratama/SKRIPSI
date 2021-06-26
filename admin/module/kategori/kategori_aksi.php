<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_kategori']; 
$kategori = $_POST['nama_kategori'];
// HAPUS
if($module=='kategori' AND $aksi=='hapus' ){ 
	$mySql = "DELETE FROM kategori_barang WHERE id_kategori='".$_GET['id_kategori']."'";
	$myQry = mysql_query($mySql);
//	header('location:../../index.php?module='.$module);
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
	echo "<script> alert('Data Berhasil Di Hapus')</script>";
}
// EDIT
else if($module=='kategori' AND $aksi=='edit' ){ 
	$query = mysql_query("UPDATE kategori_barang SET
		nama_kategori = '$kategori'
		WHERE id_kategori = '$id'");
//	header('location:../../index.php?module='.$module);
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
	echo "<script> alert('Data Berhasil Di Edit')</script>";
}
//Tambah
else if($module=='kategori' AND $aksi=='tambah' ){ 
	//header('location:../../index.php?module='.$module);
	$sql = "INSERT INTO kategori_barang  (id_kategori, nama_kategori) VALUES ('$id', '$kategori')";
	$simpan = mysql_query($sql);
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
	echo "<script> alert('Data Berhasil Di Simpan')</script>";
}
?>