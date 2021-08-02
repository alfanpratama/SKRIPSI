<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

$id = $_POST['id_barang'];


// HAPUS
if($module=='barang' AND $aksi=='hapus' ){ 
  $mySql = "DELETE FROM tmp WHERE id_barang='".$_GET['id_barang']."'";
  $myQry = mysql_query($mySql);
  //header('location:../../index.php?module='.$module);
  echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
  echo "<script> alert('Data Berhasil Di Hapus')</script>";
}

//Tambah
else if($module=='barang' AND $aksi=='tambah' ){ 
$nama_brg = $_POST['nama_brg'];
$id_kategori = $_POST['id_kategori'];
$harga = $_POST['harga'];
$satuan = $_POST['satuan'];
$spesifikasi = $_POST['spesifikasi'];


$sql = "INSERT INTO barang  (id_barang, nama_brg, id_kategori, harga, satuan, spesifikasi) VALUES ('$id', '$nama_brg', '$id_kategori', '$harga','$satuan', '$spesifikasi')";
$simpan = mysql_query($sql);
mysql_query("INSERT INTO stok(
			      id_barang,
				  stok
				  ) 
	        VALUES(
				'$id',
				'0')");
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Simpan')</script>";
}


else if($module=='barang' AND $aksi=='edit' ){ 
$nama_brg = $_POST['nama_brg'];
$id_kategori = $_POST['id_kategori'];
$harga = $_POST['harga'];
$satuan = $_POST['satuan'];
$spesifikasi = $_POST['spesifikasi'];


mysql_query("UPDATE barang SET 
nama_brg='$nama_brg',
id_kategori='$id_kategori',
harga='$harga',
satuan='$satuan',
spesifikasi='$spesifikasi'

WHERE id_barang = '$id'");
//header('location:../../index.php?module='.$module);
echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
echo "<script> alert('Data Berhasil Di Edit')</script>";
}
?>