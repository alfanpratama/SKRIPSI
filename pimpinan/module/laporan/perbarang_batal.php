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
#echo $h."     ".$d;
?>

          <section class="content-header">
            <h1>
             Laporan
              <small>Monitoring Penawaran Berdasarkan Barang Yang Batal</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Laporan</a></li>
              <li class="active">Penawaran Barang Yang Batal</li>
            </ol>
          </section>

           
          <section class="content">
            <div class="text-center">
			<h3><img src="inc/kop.png"  height="100%" width="100%"/></h3>
			</div><br/>
             
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title center">Daftar Penawaran Barang Yang Batal</h3>
				<span class="pull-right">
				Tanggal: <?php echo IndonesiaTgl($d)." - ".IndonesiaTgl($h); ?>
				</span>
				
				
				
				</span>
              </div>
              <div class="box-body">
                <table  class="table table-bordered table-striped">
<thead>
	<tr class="box box-solid box-info">
		<th class="col-xs-1" >No</th>
		<th class="col-sm-2">No. Penawaran</th>
		<th class="col-sm-2">Tanggal Prospek</th>
		<th class="col-sm-2">Nama Barang</th>
		<th class="col-sm-2">Qty</th>
		<th class="col-sm-2">Total Harga</th>
		<th class="col-sm-2">Status Barang</th>
			 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM pesanan a,  detail_pesanan b where a.no_surat=b.no_surat and acc='N'  and tgl_prospek between '".$d."' and '".$h."' ";
$tampil = mysql_query($sql);
$no=1;
while ($k = mysql_fetch_array($tampil)) { 
$subtotal = $k['subtotal'];
$ppn = $k['ppn'];
$total = $subtotal + $ppn ;

?>

	<tr>
	<td><?php echo $no++; ?></a></td>	
	<td><?php echo $k['no_surat']; ?></a></td>
	<td><?php echo Indonesia2Tgl($k['tgl_prospek']); ?></td>
	<td><?php echo $k['nama_barang']; ?></td>
	<td><?php echo $k['qty']; ?></td>
	 <td><?php echo format_angka($total) ; ?></td>
	 <td><?php echo $k['status_barang']; ?></td>	
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
			
			<tr><td><?php echo "Iman Kadarisman" ;?></td></tr></table>
              </div><!-- /.box-body -->
            </div>
          </section><!-- /.content -->

<?php
include "tail.php";
?>