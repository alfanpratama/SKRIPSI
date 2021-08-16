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
case "data_barang_masuk":
?>

<div class="text-center">
<h3>Data Barang Masuk</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data barang masuk !
</p>
</div> 
<form class="form-horizontal" action="module/laporan/masuk.php" method="post">             
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
		Data Barang Masuk</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No Barang Masuk</th>
		<th class="col-sm-2">No Surat Pengadaan</th>
		<th class="col-sm-1">Supplier</th>
		<th class="col-sm-1">Tanggal</th>
		<th class="col-sm-2">Jumlah Barang</th>
	</tr>
</thead>
<tbody>
<?php 
// Tampilkan data dari Database 
        $sql=("SELECT brg_masuk.id_brg_masuk,brg_masuk.no_surat_pengadaan,supplier.nama_sup,brg_masuk.tgl_masuk,brg_masuk.jml_brg FROM brg_masuk INNER JOIN supplier ON brg_masuk.id_supplier=supplier.id_supplier");
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
           <td><?php echo $tampilkan['nama_sup']; ?></td>  
           <td><?php echo $tampilkan['tgl_masuk']; ?></td>
           <td><?php echo $tampilkan['jml_brg']; ?></td>
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
<h3>Data Barang Keluar</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data barang keluar !
</p>
</div> 
<form class="form-horizontal" action="module/laporan/keluar.php" method="post">             
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
		Data Barang Keluar</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-blue">
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No Barang keluar</th>
		<th class="col-sm-2">No Surat Pengajuan</th>
		<th class="col-sm-1">Divisi</th>
		<th class="col-sm-1">Penerima</th>
		<th class="col-sm-1">Tanggal</th>
		<th class="col-sm-2">Jumlah Barang</th>
	</tr>
</thead>
<tbody>
<?php 
// Tampilkan data dari Database 
        $sql=("SELECT brg_keluar.id_brg_keluar,brg_keluar.no_surat_pengajuan,divisi.nama_divisi,user.nama,brg_keluar.tgl_keluar,brg_keluar.jml_brg FROM brg_keluar INNER JOIN divisi ON brg_keluar.id_divisi=divisi.id_divisi INNER JOIN user ON brg_keluar.id_user=user.id_user");
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
           <td><?php echo $tampilkan['nama_divisi']; ?></td>
           <td><?php echo $tampilkan['nama']; ?></td>
           <td><?php echo $tampilkan['tgl_keluar']; ?></td>
           <td><?php echo $tampilkan['jml_brg']; ?></td>
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
<h3>Data Stok Barang</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan klik tombol cetak untuk cetak laporan data stok barang !
</p>
</div> 
<form class="form-horizontal" action="module/laporan/stok.php" method="post">             
  <div class="form-group">
    <div class="col-sm-5">
</div>
<div class="col-sm-1">
<button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-info"><i class="glyphicon glyphicon-print"></i>&nbsp; Cetak</button>
</div></div>  
</form>
<div class="box box-solid box-info">
		<div class="box-header">
		<h3 class="btn btn enable box-title">
		<i class="fa fa-file-text"></i>
		Data Stok Barang</h3> 
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
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
	</div><!-- /.box-body -->
</div><!-- /.box -->
	<!----- ------------------------- END TAMBAH DATA MASTER kategori ------------------------- ----->

<?php
break;}
?>