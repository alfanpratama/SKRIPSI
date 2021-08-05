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
<?php
break;
case "data_pengajuan":
?>

<div class="text-center">
<h3>Data Pengajuan Barang</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data pengajuan!
</p>
</div> 
<form class="form-horizontal" action="module/laporan/pengajuan.php" method="post">             
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
		Data Pengajuan Barang</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No Surat Pengajuan</th>
		<th class="col-sm-2">Nama Divisi</th>
		<th class="col-sm-1">Nama Pemohon</th>
		<th class="col-sm-1">Tanggal</th>
		<th class="col-sm-2">Status</th>
	</tr>
</thead>
<tbody>
<?php 
// Tampilkan data dari Database 
        $sql=("SELECT pengajuan_brg.no_surat_pengajuan,divisi.nama_divisi,user.nama,pengajuan_brg.tgl FROM pengajuan_brg INNER JOIN divisi ON pengajuan_brg.id_divisi=divisi.id_divisi INNER JOIN user ON pengajuan_brg.id_user=user.id_user");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['no_surat_pengajuan'];
          ?>

          <tr>
           <td><?php echo $no++;?></td>
           <td><?php echo $tampilkan['no_surat_pengajuan']; ?></td>
           <td><?php echo $tampilkan['nama_divisi']; ?></td>  
           <td><?php echo $tampilkan['nama']; ?></td>
           <td><?php echo $tampilkan['tgl']; ?></td>
           <td align="center">
            
             <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=mengelola_pengajuan&aksi=tolak&no_surat_pengajuan=<?php echo $tampilkan['no_surat'];?>"  alt="Ditolak" onclick="return confirm('ANDA YAKIN AKAN MENOLAK PENGAJUAN <?php echo $Kode; ?>  ?')"> <i class="glyphicon glyphicon-remove-circle"></i></a>
           </td>
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
case "data_pengajuan_pengadaan":
?>

<div class="text-center">
<h3>Data Pengajuan Pengadaan Barang</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data pengajuan pengadaan !
</p>
</div> 
<form class="form-horizontal" action="module/laporan/pengadaan.php" method="post">             
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
		Data Pengajuan Pengadaan Barang</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No Surat Pengajuan Pengadaan</th>
		<th class="col-sm-2">Nama Divisi</th>
		<th class="col-sm-1">Nama Pemohon</th>
		<th class="col-sm-1">Tanggal</th>
		<th class="col-sm-2">Status</th>
	</tr>
</thead>
<tbody>
<?php 
// Tampilkan data dari Database 
        $sql=("SELECT pengajuan_pengadaan_brg.no_surat_pengadaan,divisi.nama_divisi,user.nama,pengajuan_pengadaan_brg.tgl FROM pengajuan_pengadaan_brg INNER JOIN divisi ON pengajuan_pengadaan_brg.id_divisi=divisi.id_divisi INNER JOIN user ON pengajuan_pengadaan_brg.id_user=user.id_user");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['no_surat_pengadaan'];
          ?>

          <tr>
           <td><?php echo $no++;?></td>
           <td><?php echo $tampilkan['no_surat_pengadaan']; ?></td>
           <td><?php echo $tampilkan['nama_divisi']; ?></td>  
           <td><?php echo $tampilkan['nama']; ?></td>
           <td><?php echo $tampilkan['tgl']; ?></td>
           <td align="center">
            <a class="btn btn-xs btn-primary" href="?module=mengelola_pengajuan&aksi=acc&no_surat_pengadaan=<?php echo $tampilkan['no_surat'];?>" alt="Disetuji"><i class="glyphicon glyphicon-ok-circle"></i></a>
           </td>
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
case "data_barang masuk":
?>

<div class="text-center">
<h3>Data Pengajuan Barang</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data pengajuan!
</p>
</div> 
<form class="form-horizontal" action="module/laporan/pengajuan.php" method="post">             
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
		Data Pengajuan Barang</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No Surat Pengajuan</th>
		<th class="col-sm-2">Nama Divisi</th>
		<th class="col-sm-1">Nama Pemohon</th>
		<th class="col-sm-1">Tanggal</th>
		<th class="col-sm-2">Status</th>
	</tr>
</thead>
<tbody>
<?php 
// Tampilkan data dari Database 
        $sql=("SELECT pengajuan_brg.no_surat_pengajuan,divisi.nama_divisi,user.nama,pengajuan_brg.tgl FROM pengajuan_brg INNER JOIN divisi ON pengajuan_brg.id_divisi=divisi.id_divisi INNER JOIN user ON pengajuan_brg.id_user=user.id_user");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['no_surat_pengajuan'];
          ?>

          <tr>
           <td><?php echo $no++;?></td>
           <td><?php echo $tampilkan['no_surat_pengajuan']; ?></td>
           <td><?php echo $tampilkan['nama_divisi']; ?></td>  
           <td><?php echo $tampilkan['nama']; ?></td>
           <td><?php echo $tampilkan['tgl']; ?></td>
           <td align="center">
            
             <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=mengelola_pengajuan&aksi=tolak&no_surat_pengajuan=<?php echo $tampilkan['no_surat'];?>"  alt="Ditolak" onclick="return confirm('ANDA YAKIN AKAN MENOLAK PENGAJUAN <?php echo $Kode; ?>  ?')"> <i class="glyphicon glyphicon-remove-circle"></i></a>
           </td>
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
case "data_barang_keluar":
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
break;
case "data_stok_barang":
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