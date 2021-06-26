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
$supplier = $_POST['supplier'];

// HAPUS
if($module=='barang' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM barang WHERE id_barang='".$_GET['id_barang']."'";
$myQry = mysql_query($mySql);
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Hapus')</script>";
}

//Tambah
else if($module=='barang' AND $aksi=='tambah' ){ 
	
$sql = "INSERT INTO barang  (id_barang, nama_brg, id_kategori, satuan, kode_produk, spesifikasi,nama_sup) VALUES ('$id', '$nama', '$id_kategori', '$satuan','$kode_produk', '$spesifikasi','$supplier' )";
$simpan = mysql_query($sql);
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Simpan')</script>";
}
else if($module=='barang' AND $aksi=='edit' ){ 
mysql_query("UPDATE barang SET 
nama_brg='$nama',
id_kategori='$id_kategori',
satuan='$satuan',
kode_produk='$kode_produk',
spesifikasi='$spesifikasi',
nama_sup='$supplier'
WHERE id_barang = '$id'");
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Edit')</script>";
}
?>