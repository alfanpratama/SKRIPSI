<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_divisi'];
$nama_divisi = $_POST['nama_divisi'];
$kepala_divisi = $_POST['kepala_divisi'];
$telp = $_POST['telp'];
$email = $_POST['email'];
$nama = $_POST['nama'];

// HAPUS
if($module=='divisi' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM divisi WHERE id_divisi='".$_GET['id_divisi']."'";
$myQry = mysql_query($mySql);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Hapus')</script>";
//header('location:../../index.php?module='.$module);
}

//Tambah
else if($module=='divisi' AND $aksi=='tambah' ){ 
  
$sql = "INSERT INTO divisi  (id_divisi, nama_divisi, kepala_divisi, telp, email, nama) VALUES ('$id', '$nama_divisi', '$kepala_divisi', '$telp','$email', '$nama' )";
$simpan = mysql_query($sql);
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Simpan')</script>";
}
else if($module=='divisi' AND $aksi=='edit' ){ 
mysql_query("UPDATE divisi SET 
nama_divisi='$nama_divisi',
kepala_divisi='$kepala_divisi',
telp='$telp',
email='$email',
nama='$nama'
WHERE id_divisi = '$id'");
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Edit')</script>";
}
?>