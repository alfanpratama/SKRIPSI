<?php
session_start();
include "../koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='brg_masuk' AND $act=='hapus'){
  mysql_query("DELETE FROM tmp WHERE id='$_GET[id]'");
  header('location:../../main.php?module='.$module);
}
 
?>
