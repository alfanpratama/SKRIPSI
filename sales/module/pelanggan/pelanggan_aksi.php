<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_pelanggan'];
$nama = $_POST['nama'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];
$cp = $_POST['cp'];
$email = $_POST['email'];
$user = $_POST['user'];
$id_user = $_POST['id_user'];
// HAPUS
if($module=='pelanggan' AND $aksi=='hapus' ){ 
$mySql = "DELETE FROM pelanggan WHERE id_pelanggan='".$_GET['id_pelanggan']."'";
$myQry = mysql_query($mySql);
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Hapus')</script>";


}

//Tambah
else if($module=='pelanggan' AND $aksi=='tambah' ){ 
	
$sql = "INSERT INTO pelanggan  (id_pelanggan, nama_pel, telp, alamat, cp, email, id_user, user) VALUES ('$id', '$nama', '$telp', '$alamat','$cp', '$email', '$id_user', '$user' )";
$simpan = mysql_query($sql);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Simpan')</script>";//header('location:../../index.php?module='.$module);

}
else if($module=='pelanggan' AND $aksi=='edit' ){ 
mysql_query("UPDATE pelanggan SET 
nama_pel='$nama',
telp='$telp',
alamat='$alamat',
cp='$cp',
email='$email',
user ='$user'
WHERE id_pelanggan = '$id'");
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Edit')</script>";
}
?>