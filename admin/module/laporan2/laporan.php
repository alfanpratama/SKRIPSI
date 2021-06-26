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

<?php
break;
case "data_pegawai":
?>
<h3 class="box-title margin text-center">Data Pegawai</h3>
<hr/>
<div class="box box-solid box-success">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="fa fa-user-md"></i>
		Data Pegawai </h3>
		<span class="pull-right">
		<a class="btn btn-default" target="blank" href="module/laporan/cetak_pegawai.php">
		<i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;Cetak</a>
		</span>
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-sm-1">NIP</th>
		<th class="col-sm-3">Nama pegawai</th>
		<th class="col-sm-1">JK</th> 
		<th>Tempat/Tgl. Lahir</th> 
		<th class="col-sm-1">No. HP</th> 
		<th class="col-sm-1">Email</th>
		<th class="col-sm-1">Tgl. Masuk</th>		
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM pegawai";
$tampil = mysql_query($sql);
$no=1;
while ($data = mysql_fetch_array($tampil)) { ?>

	<tr>
	<td><?php echo $data['nip']; ?></td>
	<td><?php echo $data['nm_pegawai']; ?></td>
	<td><?php echo $data['jk']; ?></td>
	<td><?php echo $data['tpt_lhr'] .", ". IndonesiaTgl($data['tgl_lhr']); ?></td>
	<td><?php echo $data['no_hp']; ?></td>
	<td><?php echo $data['email']; ?></td>	
	<td><?php echo IndonesiaTgl($data['tgl_msk']); ?></td>
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
case "sk_kerja":
?>
<h3 class="box-title margin text-center">Data SK Kerja</h3>
<center> <div class="batas"> </div></center>
<hr/>
	<div class="box box-solid box-success">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-briefcase"></i>
		Daftar SK Kerja Aktif PT. Zaman Teknindo</h3>
		<span class="pull-right">		
		<a class="btn btn-default" target="blank"href="module/laporan/cetak_sk_kerja.php">
		<i class="glyphicon glyphicon-print"></i>&nbsp;&nbsp;Cetak</a>
		</span>
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordeblue table-striped">
<thead>
	<tr class="text-green">
		<th>No. SK</th>
		<th>NIP</th>
		<th>Nama Pegawai</th> 
		<th>Tgl. SK</th> 
		<th>Lokasi</th> 
		<th>Unit Kerja</th> 
		<th>Jabatan</th>
		<th>Masa Kerja</th>
		<th>Gaji (Rp)</th> 
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM sk_krj a, pegawai b, jabatan c, pangkat d, unit_krj e, lokasi_krj f where a.nip=b.nip and a.id_jabatan=c.id_jabatan and a.id_pangkat=d.id_pangkat and a.id_unit_krj=e.id_unit_krj and a.id_lokasi=f.id_lokasi and a.status_sk='aktif'";
$tampil = mysql_query($sql);
$no=1;
while ($k = mysql_fetch_array($tampil)) { 
$Kode = $k['no_sk'];
$msk=IndonesiaTgl($k['tgl_msk']);
?>

	<tr>	
	<td><?php echo $k['no_sk']; ?></a></td>
	<td><?php echo $k['nip']; ?></td>
	<td><?php echo $k['nm_pegawai']; ?></td>
	<td><?php echo IndonesiaTgl($k['tgl_sk']); ?></td>	
	<td><?php echo $k['nm_lokasi']; ?></td>
	<td><?php echo $k['nm_unit_krj']; ?></td>
	<td><?php echo $k['nm_jabatan']; ?></td>
	<td><?php echo umur($msk); ?></td>
	<td><?php echo format_angka($k['gaji']); ?></td>
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
case "daftar_hukuman":
?>

<div class="text-center">
<h3>Data Hukuman Pegawai</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-success alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data hukuman pegawai!
</p>
</div> 
<form class="form-horizontal" action="module/laporan/hukuman.php" method="post">             
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
<button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-success"><i class="glyphicon glyphicon-print"></i>&nbsp; Cetak</button>
</div></div>  
</form>
<div class="box box-solid box-success">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-thumbs-down"></i>
		Data Hukuman Pegawai</h3> 
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-xs-1">No</th>
		<th class="col-sm-2">No. Hukuman</th>
		<th class="col-sm-2">NIP</th>
		<th class="col-sm-3">Nama Pegawai</th> 
		<th>Tanggal</th> 
		<th>Hukuman</th>  
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM hukuman a, pegawai b where a.nip=b.nip ";
$tampil = mysql_query($sql);
$no=1;
while ($k = mysql_fetch_array($tampil)) { 
$Kode = $k['id_hukuman'];?>

	<tr>
	<td><?php echo $no++; ?></a></td>	
	<td><?php echo $k['id_hukuman']; ?></a></td>
	<td><a target="blank"href="?module=pegawai&aksi=detail_pegawai&nip=<?php echo $k['nip'];?>"><?php echo $k['nip']; ?></a></td>
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
</div><!-- /.box -->
<?php
break;
case "daftar_prestasi":
?>
<div class="text-center">
<h3>Data Prestasi Pegawai</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-success alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data prestasi pegawai!
</p>
</div> 
<form class="form-horizontal" action="module/laporan/prestasi.php" method="post">             
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
<button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-success"><i class="glyphicon glyphicon-print"></i>&nbsp; Cetak</button>
</div></div>  
</form>
<div class="box box-solid box-success">
		<div class="box-header">
		<h3 class="btn btn disabled box-title">
		<i class="glyphicon glyphicon-thumbs-up"></i>
		Data Prestasi Pegawai </h3>
		 
		</div>		
	<div class="box-body">
	<table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
		<th class="col-xs-1">No</th>
		<th class="col-sm-1">No. Prestasi</th>
		<th class="col-sm-2">NIP</th>
		<th class="col-sm-3">Nama Pegawai</th> 
		<th>Tanggal</th> 
		<th>Nama Prestasi</th>  
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM prestasi a, pegawai b where a.nip=b.nip ";
$tampil = mysql_query($sql);
$no=1;
while ($k = mysql_fetch_array($tampil)) { 
$Kode = $k['id_prestasi'];?>

	<tr>	
	<td><?php echo $no++; ?></a></td>
	<td><?php echo $k['id_prestasi']; ?></a></td>
	<td><a target="blank"href="?module=pegawai&aksi=detail_pegawai&nip=<?php echo $k['nip'];?>"><?php echo $k['nip']; ?></a></td>
	<td><?php echo $k['nm_pegawai']; ?></td>
	<td><?php echo Indonesia2Tgl($k['tgl_prestasi']); ?></td>
	<td><?php echo $k['nm_prestasi']; ?></td>
	  
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