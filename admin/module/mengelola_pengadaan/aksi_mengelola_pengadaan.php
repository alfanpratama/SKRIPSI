<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$no_surat_pengadaan = $_POST['no_surat_pengadaan'];
$nama_divisi = $_POST['nama_divisi'];
$nama = $_POST['nama'];
$tgl = $_POST['tgl'];
$catatan = $_POST['catatan'];
$acc = $_POST['acc'];

// HAPUS
if($module=='mengelola_pengadaan' AND $aksi=='Ditolak' ){ 
$sql = "UPDATE pengajuan_pengadaan_brg SET acc='N' WHERE no_surat_pengadaan = '".$_GET['no_surat_pengadaan']."'";
$hapus = mysql_query($sql);
header('location:../../index.php?module='.$module);
}
// EDIT
else if($module=='mengelola_pengadaan' AND $aksi=='Disetujui' ){ 
$sql = "UPDATE pengajuan_pengadaan_brg SET acc='Y' WHERE no_surat_pengadaan = '".$_GET['no_surat_pengadaan']."'";
$hapus = mysql_query($sql);
header('location:../../index.php?module='.$module);
}
//Tambah
else if($module=='mengelola_pengadaan' AND $aksi=='edit' ){ 
mysql_query("UPDATE pengajuan_pengadaan_brg SET 
catatan='$catatan'
WHERE no_surat_pengadaan = '$no_surat_pengadaan'");
}
else if($module=='mengelola_pengadaan' AND $aksi=='tinjau' ){ 
mysql_query("SELECT * FROM pengajuan_pengadaan_brg WHERE no_surat_pengadaan = '$no_surat_pengadaan'");
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Catatan Berhasil di Tambahkan')</script>";
header('location:../../index.php?module='.$module);
}
?>