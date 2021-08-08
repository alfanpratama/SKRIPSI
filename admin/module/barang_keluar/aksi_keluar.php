<?php
session_start();
include "../koneksi.php";

// $module=$_GET[module];
// $act=$_GET[act];

// if ($module=='brg_keluar' AND $act=='hapus'){
//   mysql_query("DELETE FROM tmp WHERE id='$_GET[id]'");
//   header('location:../../isi.php?module='.$module);
// }
 

$module=$_GET['module'];
$aksi=$_GET['aksi'];





// HAPUS
if($module=='brg_keluar' AND $aksi=='hapus' ){ 
  $mySql = "DELETE FROM tmp WHERE id_barang='".$_GET['id_barang']."'";
  $myQry = mysql_query($mySql);
  //header('location:../../index.php?module='.$module);
  echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=brg_keluar\">");
  echo "<script> alert('Data Berhasil Di Hapus')</script>";
}
?>
