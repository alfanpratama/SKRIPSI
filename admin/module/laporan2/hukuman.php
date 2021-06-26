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
              <small>Hukuman/Sanksi Pegawai</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Laporan</a></li>
              <li class="active">Hukuman</li>
            </ol>
          </section>

           
          <section class="content">
            <div class="text-center">
			<h3><img src="inc/zt.png"/></h3>
			<b>Jalan Srikandi, Komp Ruko Wadya Graha II No. 7 - 8 Panam <br/>
			Pekanbaru, RIAU</b>
			</div><br/>
             
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title center">Daftar Hukuman Pegawai</h3>
				<span class="pull-right">
				Tanggal: <?php echo IndonesiaTgl($h)." - ".IndonesiaTgl($d); ?>
				</span>
				
				
				
				</span>
              </div>
              <div class="box-body">
                <table  class="table table-bordered table-striped">
<thead>
	<tr>
		<th>No</th>
		<th>No. Hukuman</th>
		<th>NIP</th>
		<th class="col-sm-3">Nama Pegawai</th> 
		<th>Tanggal</th> 
		<th>Hukuman</th> 		 	
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM hukuman a, pegawai b where a.nip=b.nip and tgl_hukuman between '".$d."' and '".$h."' ";
$tampil = mysql_query($sql);
$no=1;
while ($k = mysql_fetch_array($tampil)) { 
$Kode = $k['id_hukuman'];?>

	<tr>
	<td><?php echo $no++; ?></td>	
	<td><?php echo $k['id_hukuman']; ?></a></td>
	<td><?php echo $k['nip']; ?></td>
	<td><?php echo $k['nm_pegawai']; ?></td>
	<td><?php echo Indonesia2Tgl($k['tgl_hukuman']); ?></td>
	<td><?php echo $k['nm_hukuman']; ?></td>	
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