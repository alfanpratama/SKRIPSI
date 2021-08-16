          <?php
include 'head.php';


?>

          <section class="content-header">
            <h1>
             Laporan
              <small>Laporan Stok Barang</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Laporan</a></li>
              <li class="active">Stok Barang</li>
            </ol>
          </section>
           
          <section class="content">
            <div class="text-center">
			<h3><img src="inc/kop.png"  height="100%" width="100%"/></h3>
			</div><br/>
             
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title center">Daftar Stok Barang</h3>
				</span>
              </div>
              <div class="box-body">
                <table  class="table table-bordered table-striped">
<thead>
  <tr class="text-blue">
    <th class="col-sm-1">Id Stok</th>
    <th class="col-sm-3">Id Barang</th>
    <th class="col-sm-5">Nama Barang </th>
    <th class="col-sm-2">Jumlah Stok</th>
  </tr>
</thead>
<tbody>
<?php 
// Tampilkan data dari Database 
        $sql=("SELECT stok.id_stok,stok.id_barang,barang.nama_brg,stok.stok FROM stok INNER JOIN barang ON stok.id_barang=barang.id_barang");
$tampil = mysql_query($sql);
while ($tampilkan = mysql_fetch_array($tampil)) { 

$Kode = $tampilkan['id_stok'];
          ?>

          <tr>
           <td><?php echo $tampilkan['id_stok']; ?></td>
           <td><?php echo $tampilkan['id_barang']; ?></td>
           <td><?php echo $tampilkan['nama_brg']; ?></td>
           <td><?php echo $tampilkan['stok']; ?></td>
  <?php
  }
  ?>
  </tr>
			</tbody>
		</table>
		<table border='0'><tr  ><tdalign="right" border='0' colspan="6">Bandung, <?php echo date('d F Y', strtotime($tglhariini)); ?></td></tr>
			<tr></tr>
			<br>
			<br><br>
			<br><br>
			<br><br>
			
			<tr><td></td></tr></table>
              </div><!-- /.box-body -->
            </div>
          </section><!-- /.content -->

<?php
include "tail.php";
?>