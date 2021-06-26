<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_supplier'];
$nama = $_POST['nama'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];
$cp = $_POST['cp'];
$email = $_POST['email'];

// HAPUS
if($module=='supplier' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM supplier WHERE id_supplier='".$_GET['id_supplier']."'";
$myQry = mysql_query($mySql);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Hapus')</script>";
//header('location:../../index.php?module='.$module);
}

//Tambah
else if($module=='supplier' AND $aksi=='tambah' ){ 
	
$sql = "INSERT INTO supplier  (id_supplier, nama_sup, telp, alamat, cp, email) VALUES ('$id', '$nama', '$telp', '$alamat','$cp', '$email' )";
$simpan = mysql_query($sql);
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Simpan')</script>";
}
else if($module=='supplier' AND $aksi=='edit' ){ 
mysql_query("UPDATE supplier SET 
nama_sup='$nama',
telp='$telp',
alamat='$alamat',
cp='$cp',
email='$email'
WHERE id_supplier = '$id'");
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Edit')</script>";
}
?>