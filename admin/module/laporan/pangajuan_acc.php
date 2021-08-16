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
              <small> Pengajuan Barang Berdasarkan Pengajuan Yang Di ACC</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Laporan</a></li>
              <li class="active">Pengajuan Barang ACC</li>
            </ol>
          </section>

           
          <section class="content">
            <div class="text-center">
			<h3><img src="inc/kop.png"  height="100%" width="100%"/></h3>
			</div><br/>
             
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title center">Daftar Pengajuan Barang ACC</h3>
				<span class="pull-right">
				Tanggal: <?php echo IndonesiaTgl($d)." - ".IndonesiaTgl($h); ?>
				</span>
              </div>
              <div class="box-body">
                <table  class="table table-bordered table-striped">
<thead>
	<tr>
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No. Pengajuan</th>
		<th class="col-sm-2">Tanggal</th>
		<th class="col-sm-2">Nama Divisi</th>
		<th class="col-sm-2">Nama Pemohon</th>
		<th class="col-sm-2">Jumlah Barang</th>
		<th class="col-sm-2">Status</th>
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
 $sql=("SELECT pengajuan_brg.no_surat_pengajuan,divisi.nama_divisi,user.nama,pengajuan_brg.tgl FROM pengajuan_brg INNER JOIN divisi ON pengajuan_brg.id_divisi=divisi.id_divisi INNER JOIN user ON pengajuan_brg.id_user=user.id_user  and acc='Y'  and tgl between '".$d."' and '".$h."' ");
$tampil = mysql_query($sql);
$no=1;
while ($k = mysql_fetch_array($tampil)) { 
$subtotal = $k['subtotal'];
$ppn = $k['ppn'];
$total = $subtotal + $ppn ;

?>

	<tr>
	<td><?php echo $no++; ?></a></td>	
	<td><?php echo $k['no_surat_pengajuan']; ?></a></td>
	<td><?php echo Indonesia2Tgl($k['tgl']); ?></td>
	<td><?php echo $k['nama_divisi']; ?></td>
	<td><?php echo $k['nama']; ?></td>
	<td><?php echo $k['jml_brg']; ?></td>
	<td><?php if  ( $acc== 'X' ) {
            echo "<a class='btn btn-xs btn-warning' disabled >Ditinjau</a>";
            }
            else if ($acc== 'Y') {
            echo "<a class='btn btn-xs btn-success' disabled>Disetujui</a>";
            }
            else if ($acc== 'N') {
            echo "<a class='btn btn-xs btn-danger' disabled >Ditolak</a>"; 
            }   ?></td>
           <td align="center"></td>	
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