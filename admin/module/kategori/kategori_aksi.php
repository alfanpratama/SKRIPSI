<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_kategori'];
$nama_kategori = $_POST['nama_kategori'];

// HAPUS
if($module=='kategori' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM kategori_barang WHERE id_kategori='".$_GET['id_kategori']."'";
$myQry = mysql_query($mySql);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Hapus')</script>";
//header('location:../../index.php?module='.$module);
}

//Tambah
else if($module=='kategori' AND $aksi=='tambah' ){ 
  
$sql = "INSERT INTO kategori_barang  (id_kategori, nama_kategori) VALUES ('$id', '$nama_kategori')";
$simpan = mysql_query($sql);
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Simpan')</script>";
}

else if($module=='kategori' AND $aksi=='edit' ){ 
mysql_query("UPDATE kategori_barang SET 
nama_kategori='$nama_kategori',
WHERE id_kategori = '$id'");
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Edit')</script>";
}
?>