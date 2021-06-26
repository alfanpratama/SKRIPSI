<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_barang'];
$nama = $_POST['nama'];
$id_kategori = $_POST['id_kategori'];
$satuan = $_POST['satuan'];
$kode_produk = $_POST['kode_produk'];
$spesifikasi = $_POST['spesifikasi'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];

// HAPUS
if($module=='harga' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM barang WHERE id_barang='".$_GET['id_barang']."'";
$myQry = mysql_query($mySql);
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Hapus')</script>";
}

else if($module=='harga' AND $aksi=='edit' ){ 
	
mysql_query("UPDATE barang SET 
nama_brg='$nama',
id_kategori='$id_kategori',
satuan='$satuan',
kode_produk='$kode_produk',
spesifikasi='$spesifikasi',
harga_beli='$harga_beli',
harga_jual='$harga_jual'
WHERE id_barang = '$id'");
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Harga Berhasil Di Simpan')</script>";
}
?>