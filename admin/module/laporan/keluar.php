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
              <small>Laporan Barang Keluar</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Laporan</a></li>
              <li class="active">Barang Keluar</li>
            </ol>
          </section>
           
          <section class="content">
            <div class="text-center">
			<h3><img src="inc/kop.png"  height="100%" width="100%"/></h3>
			</div><br/>
             
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title center">Daftar Barang Keluar</h3>
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
		<th class="col-sm-2">No. Barang Keluar</th>
		<th class="col-sm-2">No Pengajuan Barang</th>
		<th class="col-sm-2">Tanggal Barang Keluar</th>
		<th class="col-sm-2">Id Barang</th>
		<th class="col-sm-2">Nama Barang</th>
		<th class="col-sm-2">Divisi</th>
		<th class="col-sm-2">Jumlah Barang</th>
			 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
 $sql=("SELECT brg_keluar.id_brg_keluar,brg_keluar.no_surat_pengajuan,brg_keluar.tgl_keluar,detail_brg_keluar.id_barang,barang.nama_brg,divisi.nama_divisi,brg_keluar.tgl_keluar,brg_keluar.jml_brg FROM brg_keluar INNER JOIN detail_brg_keluar ON brg_keluar.id_brg_keluar=detail_brg_keluar.id_brg_keluar INNER JOIN barang ON detail_brg_keluar.id_barang=barang.id_barang INNER JOIN divisi ON brg_keluar.id_divisi=divisi.id_divisi");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['id_brg_keluar'];
          ?>

          <tr>
           <td><?php echo $no++;?></td>
           <td><?php echo $tampilkan['id_brg_keluar']; ?></td>
           <td><?php echo $tampilkan['no_surat_pengajuan']; ?></td>  
           <td><?php echo $tampilkan['tgl_keluar']; ?></td>
           <td><?php echo $tampilkan['id_barang']; ?></td>
           <td><?php echo $tampilkan['nama_brg']; ?></td>
           <td><?php echo $tampilkan['nama_divisi']; ?></td>
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