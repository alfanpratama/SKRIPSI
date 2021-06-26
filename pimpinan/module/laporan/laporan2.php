<?php
function umur($tgl_lahir){
    $tgl=explode("/",$tgl_lahir);
    $cek_jmlhr1=cal_days_in_month(CAL_GREGORIAN,$tgl['1'],$tgl['2']);
    $cek_jmlhr2=cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
    $sshari=$cek_jmlhr1-$tgl['0'];
    $ssbln=12-$tgl['1']-1;
    $hari=0;
    $bulan=0;
    $tahun=0;
//hari+bulan
    if($sshari+date('d')>=$cek_jmlhr2){
        $bulan=1;
        $hari=$sshari+date('d')-$cek_jmlhr2;
    }else{
        $hari=$sshari+date('d');
    }
    if($ssbln+date('m')+$bulan>=12){
        $bulan=($ssbln+date('m')+$bulan)-12;
        $tahun=date('Y')-$tgl['2'];
    }else{
        $bulan=($ssbln+date('m')+$bulan);
        $tahun=(date('Y')-$tgl['2'])-1;
    }

      $selisih=$tahun." Thn ".$bulan." Bln ";
    return $selisih;
}
switch($_GET['aksi']){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER kategori ------------------------- ----->			
	<h3 class="box-title margin text-center">Data Laporan Pendapatan</h3>
	<br/>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-solid box-success">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Monitoring Pendapatan Per Sales</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan2&aksi=data_pendapatan_sales" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa memonitoring pendapatan per sales
						</div>
						<div class="form-group">
							<label class="col-sm-4"></label>
							<div class="col-sm-7">
								<hr/>
								<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> Proses</button>
								 
							</div>
						</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
			<!--	<div class="col-md-6">
			<div class="box box-solid box-info">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Monitoring Pendapatan Total</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan2&aksi=data_pendapatan_total" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa memonitoring pendapatan keseluruhan transaksi
						</div>
						<div class="form-group">
							<label class="col-sm-4"></label>
							<div class="col-sm-7">
								<hr/>
								<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> Proses</button>
								 
							</div>
						</div>
					</form>
				</div> /.box-body 
			</div>  
		</div>-->
		<div class="col-md-6">
			<div class="box box-solid box-info">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Monitoring Pendapatan Bonus Sales</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan2&aksi=data_bonus" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa memonitoring pendapatan bonus untuk sales
						</div>
						<div class="form-group">
							<label class="col-sm-4"></label>
							<div class="col-sm-7">
								<hr/>
								<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-send"></i> Proses</button>
								 
							</div>
						</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>

	</div>
	<!----- ------------------------- END TAMBAH DATA MASTER kategori ------------------------- ----->
<?php
break;
case "data_pendapatan_sales":
?>

<div class="text-center">
<h3>Data Pendapatan Sales</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data pendapatan!
</p>
</div> 
<form class="form-horizontal" action="module/laporan/pendapatan_persales.php" method="post">             
  <div class="form-group">
    <label class="col-sm-4 control-label">Tanggal</label>	
    <div class="col-sm-3">
    <div class="input-group">
  <div class="input-group-addon">
	<i class="fa fa-calendar"></i>
  </div>
  <input type="text" name="tanggal" required="required" class="form-control pull-right" id="reservation"/>
</div><!-- /.input group -->
</div>
<div class="col-sm-1">
<button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-info"><i class="glyphicon glyphicon-print"></i>&nbsp; Cetak</button>
</div></div>  
</form>
<div class="box box-solid box-info">
		<div class="box-header">
		<h3 class="btn btn enable box-title">
		<i class="fa fa-file-text"></i>
		Data Pendapatan Sales</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">Nama Sales</th>
		<th> Tanggal </th>
		<th class="col-sm-2">Total</th>
		 

	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM user a,  detail_pesanan b, pesanan c where a.id_user=b.id_user and b.no_surat=c.no_surat  and acc='Y' ";
$tampil = mysql_query($sql);
$no=1;
while ($k = mysql_fetch_array($tampil)) { 
$subtotal = $k['subtotal'];

$total = $subtotal  ;
?>

	<tr>
	<td><?php echo $no++; ?></a></td>
	<td><?php echo $k['nama']; ?></a></td>	
	<td><?php echo $k['tgl_prospek']; ?></a></td>	
	<td><?php echo number_format($total); ?></td>

	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->



<?php
break;
case "data_bonus":
?>

<div class="text-center">
	<h3>Data Pendapatan Bonus Sales</h3><hr/></div>
	<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
		<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
		<p><i class="icon fa fa-info"></i>
			Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data pendapatan!
		</p>
	</div> 
	<form class="form-horizontal" action="module/laporan/pendapatan_bonus.php" method="post">             
		<div class="form-group">
			<label class="col-sm-4 control-label">Tanggal</label>	
			<div class="col-sm-3">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar"></i>
					</div>
					<input type="text" name="tanggal" required="required" class="form-control pull-right" id="reservation"/>
				</div><!-- /.input group -->
			</div>
			<div class="col-sm-1">
				<button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-info"><i class="glyphicon glyphicon-print"></i>&nbsp; Cetak</button>
			</div></div>  
		</form>
		<div class="box box-solid box-info">
			<div class="box-header">
				<h3 class="btn btn enable box-title">
					<i class="fa fa-file-text"></i>
				Data Pendapatan Bonus</h3> 
			</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr class="text-blue">
							<th class="col-xs-1">No</th>
							<th class="col-sm-2">Nama Sales</th>
							<th class="col-sm-2">No. Transaksi</th>
							<th> Tanggal </th>
							<th class="col-sm-2">Jumlah Transaksi</th>
							<th class="col-sm-2">Bonus</th>


						</tr>
					</thead>

					<tbody>
						<?php 
// Tampilkan data dari Database
						$sql = "SELECT * FROM user a,  detail_pesanan b, pesanan c where a.id_user=b.id_user and b.no_surat=c.no_surat  and acc='Y' ";
						$tampil = mysql_query($sql);
						$no=1;
						while ($k = mysql_fetch_array($tampil)) { 
							$subtotal = $k['subtotal'];
							$persen =1.5/100;
							$total = $subtotal*$persen  ;
							?>

							<tr>
								<td><?php echo $no++; ?></a></td>
								<td><?php echo $k['nama']; ?></a></td>	
								<td><?php echo $k['no_surat']; ?></a></td>
								<td><?php echo $k['tgl_prospek']; ?></a></td>
								<td><?php echo number_format($k['subtotal']); ?></a></td>	
								<td><?php echo number_format($total); ?></td>

								<?php
							}
							?>
						</tr>
					</tbody>
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->

<?php
break;}
?>