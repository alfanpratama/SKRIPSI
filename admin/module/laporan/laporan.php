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
	<h3 class="box-title margin text-center">Data Laporan Penawaran</h3>
	<br/>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-solid box-success">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Monitoring Penawaran Per Sales</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_penawaran_sales" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa memonitoring transaksi penawaran per sales
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
				<div class="col-md-6">
			<div class="box box-solid box-info">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Monitoring Penawaran Barang Yang DI ACC</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_penawaran_perbarang_acc" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa memonitoring transaksi penawaran per barang yang di acc pelanggan
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
		<div class="col-md-6">
			<div class="box box-solid box-danger">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Monitoring Penawaran Barang Yang Tidak DI ACC</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_penawaran_perbarang_batal" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa memonitoring transaksi penawaran per barang yang tidak di acc pelanggan
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
case "data_penawaran_sales":
?>

<div class="text-center">
<h3>Data Transaksi Penawaran</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data transaksi penawaran!
</p>
</div> 
<form class="form-horizontal" action="module/laporan/persales.php" method="post">             
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
		Data Transaksi Penawaran</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No. Penawaran</th>
		<th>Tanggal Prospek</th>
		<th class="col-sm-2">Nama Instansi</th>
		<th class="col-sm-2">Nama PIC</th>
		<th class="col-sm-2">Nama Sales</th>
		 

	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM pelanggan a,  pesanan b, user c where a.id_pelanggan=b.id_pelanggan and b.id_user=c.id_user";
$tampil = mysql_query($sql);
$no=1;
while ($k = mysql_fetch_array($tampil)) { 
$Kode = $k['nama'];?>

	<tr>
	<td><?php echo $no++; ?></a></td>	
	<td><?php echo $k['no_surat']; ?></a></td>
	<td><?php echo Indonesia2Tgl($k['tgl_prospek']); ?></td>
	<td><?php echo $k['nama_pel']; ?></td>
	<td><?php echo $k['cp']; ?></td>
	 <td><?php echo $k['nama']; ?></td>
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
case "data_penawaran_perbarang_acc":
?>

<div class="text-center">
<h3>Data Transaksi Penawaran Barang Yang Di ACC</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data transaksi penawaran!
</p>
</div> 
<form class="form-horizontal" action="module/laporan/perbarang_acc.php" method="post">             
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
		Data Transaksi Penawaran Yang DI ACC</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No. Penawaran</th>
		<th class="col-sm-2">Tanggal Prospek</th>
		<th class="col-sm-2">Nama Barang</th>
		<th class="col-sm-1">Qty</th>
		<th class="col-sm-2">Total Harga</th>
		<th class="col-sm-2">Status Barang</th>
		 

	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM pesanan a,  detail_pesanan b where a.no_surat=b.no_surat and acc='Y' ";
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
	<td align="center"><?php echo $k['qty']; ?></td>
	 <td><?php echo format_angka($total) ; ?></td>
	 <td><?php echo $k['status_barang']; ?></td>
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
case "data_penawaran_perbarang_batal":
?>

<div class="text-center">
<h3>Data Transaksi Penawaran Penawaran Yang Di Batalkan</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-danger alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-danger"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data transaksi penawaran!
</p>
</div> 
<form class="form-horizontal" action="module/laporan/perbarang_batal.php" method="post">             
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
<button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-danger"><i class="glyphicon glyphicon-print"></i>&nbsp; Cetak</button>
</div></div>  
</form>
<div class="box box-solid box-danger">
		<div class="box-header">
		<h3 class="btn btn enable box-title">
		<i class="fa fa-file-text"></i>
		Data Transaksi Penawaran Barang Yang Di Batalkan</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-red " >
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No. Penawaran</th>
		<th class="col-sm-2">Tanggal Prospek</th>
		<th class="col-sm-2">Nama Barang</th>
		<th class="col-sm-1">Qty</th>
		<th class="col-sm-2">Total Harga</th>
		<th class="col-sm-2">Status Barang</th>
		 

	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM pesanan a,  detail_pesanan b where a.no_surat=b.no_surat and acc='N' ";
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
	<td align="center"><?php echo $k['qty']; ?></td>
	 <td><?php echo format_angka($total) ; ?></td>
	 <td><?php echo $k['status_barang']; ?></td>
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
case "daftar_pendapatan":
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
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_pendapatan_sales" role="form" method="post">             
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
				<div class="col-md-6">
			<div class="box box-solid box-info">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Monitoring Pendapatan Total</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_pendapatan_total" role="form" method="post">             
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
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		<div class="col-md-6">
			<div class="box box-solid box-danger">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Monitoring Pendapatan Bonus Sales</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_penawaran_perbarang_batal" role="form" method="post">             
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
break;}
?>