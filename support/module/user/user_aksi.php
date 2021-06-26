<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_user'];
$user = $_POST['user'];
$pass = $_POST['pass'];
$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$level = $_POST['level'];

// HAPUS
if($module=='user' AND $aksi=='no' ){ 
$sql = "UPDATE user SET blokir='N' WHERE id_user = '".$_GET['id_user']."'";
$hapus = mysql_query($sql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='user' AND $aksi=='yes' ){ 
$sql = "UPDATE user SET blokir='Y' WHERE id_user = '".$_GET['id_user']."'";
$hapus = mysql_query($sql);

header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='user' AND $aksi=='tambah' ){ 
	//header('location:../../index.php?module='.$module);
$sql = "INSERT INTO user  (id_user, user, pass, nama, no_hp, level ) VALUES ('$id', '$user', '$pass', '$nama', '$no_hp', '$level')";
$simpan = mysql_query($sql);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Simpan')</script>";

}
else if($module=='user' AND $aksi=='edit' ){ 
mysql_query("UPDATE user SET 
user='$user',
pass='$pass',
nama='$nama',
no_hp='$no_hp',
level='$level'
WHERE id_user = '$id'");
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Edit')</script>";
//header('location:../../index.php?module='.$module);

}
else if($module=='user' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM user WHERE id_user='".$_GET['id_user']."'";
$myQry = mysql_query($mySql);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Hapus')</script>";
}
?>