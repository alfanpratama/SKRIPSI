<?php
session_start();
include "../koneksi.php";

// $module=$_GET[module];
// $act=$_GET[act];

<<<<<<< HEAD
// if ($module=='brg_keluar' AND $act=='hapus'){
=======
// if ($module=='brg_masuk' AND $act=='hapus'){
>>>>>>> fbb15f715ac4da04e49cb5632eaa0a837c758322
//   mysql_query("DELETE FROM tmp WHERE id='$_GET[id]'");
//   header('location:../../isi.php?module='.$module);
// }
 

$module=$_GET['module'];
$aksi=$_GET['aksi'];





// HAPUS
if($module=='brg_masuk' AND $aksi=='hapus' ){ 
  $mySql = "DELETE FROM tmp WHERE id_barang='".$_GET['id_barang']."'";
  $myQry = mysql_query($mySql);
  //header('location:../../index.php?module='.$module);
  echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
  echo "<script> alert('Data Berhasil Di Hapus')</script>";
}
?>
