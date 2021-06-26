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
              <small>Monitoring Pendapatan Berdasarkan Nama Sales</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Laporan</a></li>
              <li class="active">Pendapatan Sales</li>
            </ol>
          </section>

           
          <section class="content">
            <div class="text-center">
			<h3><img src="inc/kop.png"  height="100%" width="100%"/></h3>
			</div><br/>
             
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title center">Daftar Pendapatan Sales</h3>
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
		<th class="col-sm-2">Nama Sales</th>
		<th class="col-sm-2">Total</th>	 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT sum(subtotal) as total, nama, tgl_prospek FROM user a,  detail_pesanan b, pesanan c where a.id_user=b.id_user and b.no_surat=c.no_surat and acc='Y' and tgl_prospek between '".$d."' and '".$h."' group by nama";
//$sql = "SELECT * FROM user a,  detail_pesanan b, pesanan c where a.id_user=b.id_user and b.no_surat=c.no_surat and b.id_user=c.id_user and acc='Y'  and tgl_prospek between '".$d."' and '".$h."' ";
$tampil = mysql_query($sql);
$no=1;
while ($k = mysql_fetch_array($tampil)) { 


?>

	<tr>
	<td><?php echo $no++; ?></a></td>
	<td><?php echo $k['nama']; ?></a></td>		
	<td><?php echo number_format($k['total']); ?></td>
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
              </div><!-- /.box-body -->
            </div>
          </section><!-- /.content -->

<?php
include "tail.php";
?>