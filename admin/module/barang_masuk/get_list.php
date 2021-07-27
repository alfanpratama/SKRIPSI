<?php
require_once "../koneksi.php";
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select id_barang,nama_brg from barang where nama_brg LIKE '%$q%' or kode_brg LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['id_barang'] . " - " . $rs['nama_brg'];
	echo "$cname\n";
}
?>