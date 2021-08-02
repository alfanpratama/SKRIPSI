<?php
require_once "koneksi.php";
$q = strtolower($_GET["nama"]);
if (!$q) return;

$sql = "select * from pelanggan where nama LIKE '%$q%' or id_pelanggan LIKE '%$q%'";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
	$cname = $rs['id_pelanggan'] . " - " . $rs['nama'];
	echo "$cname\n";
}
?>