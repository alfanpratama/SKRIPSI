<?php
include 'koneksi.php';

$key = $_GET['term'];
$sql = "select * from pelanggan where nama like '$key%'";
$json = array();
$query = mysql_query($sql);
while($data = mysql_fetch_array($query)){
	//sesuaikan dengan struktur tabelmu
	$json[] = array(
		'id_pelanggan' => $data['id_pelanggan'],
		'nama' => $data['nama'],
		'cp' => $data['cp']
	);
}
header("Content-Type: application/json");
echo json_encode($json);
?>