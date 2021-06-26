<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

// HAPUS
if($module=='cek_penawaran' AND $aksi=='no' ){
$no_surat=$_GET['no_surat'];
$sql = "UPDATE detail_pesanan SET ACC='N' WHERE id_barang = '".$_GET['id_barang']."'";
$hapus = mysql_query($sql);
echo "<script> alert('Data Berhasil Di Edit')</script>";
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=cek_penawaran&aksi=lanjut&no_surat=$no_surat\">");
}
// EDIT
else if($module=='cek_penawaran' AND $aksi=='yes' ){ 
$no_surat=$_GET['no_surat'];
$sql = "UPDATE detail_pesanan SET ACC='Y' WHERE id_barang = '".$_GET['id_barang']."'";
$hapus = mysql_query($sql);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=cek_penawaran&aksi=lanjut&no_surat=$no_surat\">");
echo "<script> alert('Data Berhasil Di Edit')</script>";
//header('location:../../index.php?module='.$module);

}


else if($module=='cek_penawaran' AND $aksi=='edit' ){ 
$no_surat=$_GET['no_surat'];
$id = $_POST['id_barang'];
$qty = $_POST['qty'];
$subtotal = $_POST['subtotal'];
$ppn = $_POST['ppn'];
$sql="UPDATE detail_pesanan SET 
qty='$qty',
subtotal='$subtotal',
ppn='$ppn'
WHERE id_barang = '$id'";
$edit=mysql_query($sql);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=cek_penawaran&aksi=lanjut&no_surat=$no_surat\">");
echo "<script> alert('Data Berhasil Di Edit')</script>";
//header('location:../../index.php?module='.$module);

}
?>