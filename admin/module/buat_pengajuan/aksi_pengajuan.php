<?php
include "../koneksi.php";

$module=$_GET['module'];
$aksi=$_GET['aksi'];

// HAPUS
if($module=='aksi_pengajuan' AND $aksi=='hapus' ){ 
	$mySql = "DELETE FROM tmp WHERE id_barang='".$_GET['id_barang']."'";
	$myQry = mysql_query($mySql);
	//header('location:../../index.php?module='.$module);
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
	echo "<script> alert('Data Berhasil Di Hapus')</script>";
}
// EDIT
else if($module=='pesanan' AND $aksi=='edit' ){ 
$id = $_POST['id_barang'];
$nama = $_POST['nama'];
$spesifikasi = $_POST['spesifikasi'];
$qty = $_POST['qty'];

	$query = mysql_query("UPDATE pesanan_tmp SET
		nama_brg = '$nama',
		spesifikasi = '$spesifikasi',
		qty = '$qty'
		WHERE id_barang = '$id'");
	//header('location:../../index.php?module='.$module);
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
	echo "<script> alert('Data Berhasil Di Edit')</script>";
}



//SIMPAN
else if($module=='pesanan' AND $aksi=='simpan' ){ 

$no_surat = $_POST['no_surat'];

$nama_pelanggan = $_POST['nama_pelanggan'];
$id_pelanggan = $_GET['id_pelanggan'];
$tgl_prospek = $_POST['tanggal'];
$user = $_POST['id_user'];
//$id = $_POST['id_barang'];

	$sqlcek=mysql_query("SELECT * FROM pesanan_tmp");
	$rscek=mysql_num_rows($sqlcek);

	if($rscek > 0){
		mysql_query("INSERT INTO pesanan(
			no_surat,
			id_pelanggan,
			tgl_prospek,
			id_user) 
			VALUES(
			'$no_surat',
			'$id_pelanggan',
			'$tgl_prospek',
			'$user' )");

		$sql=mysql_query("SELECT * FROM pesanan_tmp");
		while($rs=mysql_fetch_array($sql)){
			$idb=$rs['id_barang'];
			$dd = mysql_query("INSERT INTO detail_pesanan(
				no_surat,
				id_barang,
				nama_barang,
				spesifikasi,
				qty,
				harga_jual,
				diskon,
				subtotal,
				ppn,
				status_barang,
				id_user) 
				VALUES(
				'".$rs['no_surat']."',
				'".$rs['id_barang']."',
				'".$rs['nama_brg']."',
				'".$rs['spesifikasi']."',
				'".$rs['qty']."',
				'".$rs['harga_jual']."',
				'".$rs['diskon']."',
				'".$rs['subtotal']."',
				'".$rs['ppn']."',
				'".$rs['status_barang']."',
				'".$rs['id_user']."')"
			);

		}

		//$sqldelete =mysql_query("DELETE FROM pesanan_tmp  ");
		mysql_query("truncate table pesanan_tmp");
		//header('location:../../index.php?module='.$module);
		echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
		echo "<script> alert('Data Berhasil Di Simpan')</script>";
	}
	else
	{
		header('location:main.php?module=pesanan&pesan=Data Kosong !');
	}






}
//Tambah
else if($module=='pesanan' AND $aksi=='tambah' ){ 
$id = $_POST['id_barang'];
$nama = $_POST['nama'];
$spesifikasi = $_POST['spesifikasi'];
$qty = $_POST['qty'];
//$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$ppn = $_POST['ppn'];
$status_barang = $_POST['status_barang'];
$no_surat = $_POST['no_surat'];

$diskon = $_POST['diskon'];
$subtotal = $_POST['subtotal'];

//$no_surat = $_POST['no_surat'];
//$nama_pelanggan = $_POST['nama_pelanggan'];
//$id_pelanggan = $_GET['id_pelanggan'];
//$tgl_prospek = $_POST['tanggal'];
$user = $_POST['id_user'];
//$id = $_POST['id_barang'];

	//header('location:../../index.php?module='.$module);
	$sql = "INSERT INTO pesanan_tmp  (no_surat, id_barang, nama_brg, spesifikasi, qty,  harga_jual, diskon,subtotal, ppn, status_barang, id_user) VALUES ('$no_surat', '$id', '$nama', '$spesifikasi', '$qty', '$harga_jual', '$diskon', '$subtotal', '$ppn', '$status_barang', '$user')";
	$simpan = mysql_query($sql);
	echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=../../index.php?module=$module\">");
	echo "<script> alert('Data Berhasil Di Tambahkan')</script>";
}

?>