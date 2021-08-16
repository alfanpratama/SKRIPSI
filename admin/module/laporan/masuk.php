<?php
include 'head.php';

$tgl_bet = $_POST['tanggal'];
$a=substr ($tgl_bet, 0,2);
$b=substr ($tgl_bet, 3,2);
$c=substr ($tgl_bet, 6,4);
$d= $c."-".$a."-".$b;
$e=substr ($tgl_bet, 13,2);
$f=substr ($tgl_bet, 16,2);
$g=substr ($tgl_bet, 19,4);
$h= $g."-".$e."-".$f;
echo $h."     ".$d;
?>

          <section class="content-header">
            <h1>
             Laporan
              <small>Laporan Barang Masuk</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Laporan</a></li>
              <li class="active">Barang Masuk</li>
            </ol>
          </section>
           
          <section class="content">
            <div class="text-center">
			<h3><img src="inc/kop.png"  height="100%" width="100%"/></h3>
			</div><br/>
             
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title center">Daftar Barang Masuk</h3>
				<span class="pull-right">
				Tanggal: <?php echo IndonesiaTgl($d)." - ".IndonesiaTgl($h); ?>
				</span>
				
				</span>
              </div>
              <div class="box-body">
                <table  class="table table-bordered table-striped">
<thead>
	<tr>
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No. Barang Masuk</th>
		<th class="col-sm-2">No Pengadaan Barang</th>
		<th class="col-sm-2">Tanggal Barang Masuk</th>
		<th class="col-sm-2">Id Barang</th>
		<th class="col-sm-2">Nama Barang</th>
		<th class="col-sm-2">Supplier</th>
		<th class="col-sm-2">Jumlah Barang</th>
			 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
 $sql=("SELECT brg_masuk.id_brg_masuk,brg_masuk.no_surat_pengadaan,brg_masuk.tgl_masuk,detail_brg_masuk.id_barang,barang.nama_brg,supplier.nama_sup,brg_masuk.tgl_masuk,brg_masuk.jml_brg FROM brg_masuk INNER JOIN detail_brg_masuk ON brg_masuk.id_brg_masuk=detail_brg_masuk.id_brg_masuk INNER JOIN barang ON detail_brg_masuk.id_barang=barang.id_barang INNER JOIN supplier ON brg_masuk.id_supplier=supplier.id_supplier");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['id_brg_masuk'];
          ?>

          <tr>
           <td><?php echo $no++;?></td>
           <td><?php echo $tampilkan['id_brg_masuk']; ?></td>
           <td><?php echo $tampilkan['no_surat_pengadaan']; ?></td>  
           <td><?php echo $tampilkan['tgl_masuk']; ?></td>
           <td><?php echo $tampilkan['id_barang']; ?></td>
           <td><?php echo $tampilkan['nama_brg']; ?></td>
           <td><?php echo $tampilkan['nama_sup']; ?></td>
           <td><?php echo $tampilkan['jml_brg']; ?></td>
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