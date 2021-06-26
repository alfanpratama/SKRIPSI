<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];
$no_surat=$_GET['no_surat'];
$id = $_POST['id_barang'];
$qty = $_POST['qty'];
$subtotal = $_POST['subtotal'];
$ppn = $_POST['ppn'];

// HAPUS
if($module=='cek_slo' AND $aksi=='simpan' ){ 
$sql = "INSERT INTO  WHERE id_barang = '".$_GET['id_barang']."'";
$hapus = mysql_query($sql);
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\'0.1;URL=../../index.php?module=$module\'>");
}
// EDIT
else if($module=='cek_penawaran' AND $aksi=='yes' ){ 
$sql = "UPDATE detail_pesanan SET ACC='Y' WHERE id_barang = '".$_GET['id_barang']."'";
$hapus = mysql_query($sql);
echo("<META HTTP-EQUIV=Refresh CONTENT=\'0.1;URL=../../index.php?module=$module\'>");
//header('location:../../index.php?module='.$module);

}
else if($module=='cek_penawaran' AND $aksi=='edit' ){ 
mysql_query("UPDATE detail_pesanan SET 
qty='$qty',
subtotal='$subtotal',
ppn='$ppn'
WHERE id_barang = '$id'");
//echo("<META HTTP-EQUIV=Refresh CONTENT=\'0.1;URL=../../index.php?module=$module&$no_surat\'>");
echo "<script> alert('Data Berhasil Di Edit')</script>";
header('location:../../index.php?module='.$module);

}
?>