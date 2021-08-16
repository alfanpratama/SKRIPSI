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
<form class="form-horizontal" action="module/laporan/pengajuan2.php" method="post">             
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
         <tr class="text-green">
          <th class="col-sm-2">Nomer Surat</th>
          <th class="col-sm-1">Nama Divisi</th>
          <th class="col-sm-2">Nama Pemohon</th>
          <th class="col-sm-1">Tanggal</th>
          <th class="col-sm-1">Status</th>
          <th class="col-sm-1">Aksi</th>
        </tr> 
      </thead>

      <tbody>
        <?php 
        $sql=("SELECT pengajuan_brg.no_surat_pengajuan,divisi.nama_divisi,user.nama,pengajuan_brg.tgl,pengajuan_brg.acc FROM pengajuan_brg INNER JOIN divisi ON pengajuan_brg.id_divisi=divisi.id_divisi INNER JOIN user ON pengajuan_brg.id_user=user.id_user");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['no_surat_pengajuan'];
          $acc = $tampilkan['acc'];
          ?>

          <tr>
           <td><?php echo $tampilkan['no_surat_pengajuan']; ?></td>
           <td><?php echo $tampilkan['nama_divisi']; ?></td>	
           <td><?php echo $tampilkan['nama']; ?></td>
           <td><?php echo $tampilkan['tgl']; ?></td>
           <td><?php if  ( $acc== 'X' ) {
            echo "<a class='btn btn-xs btn-warning' disabled >Ditinjau</a>";
            }
            else if ($acc== 'Y') {
            echo "<a class='btn btn-xs btn-success' disabled>Disetujui</a>";
            }
            else if ($acc== 'N') {
            echo "<a class='btn btn-xs btn-danger' disabled >Ditolak</a>"; 
            }   ?></td>
           <td align="center">

              <form class="form-horizontal" action="module/mengelola_pengajuan/pengajuan.php" method="get">
              <input type="hidden" name="no_surat_pengajuan" value="<?php echo $tampilkan['no_surat_pengajuan']; ?>">             
              <button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-search"></i></button> 
              </form>
           </td>
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->
<h3 class="box-title margin text-center"></h3>
	<br/>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-solid box-success">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Data Pengajuan Barang Per Divisi</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_pengajuan_barang" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa melihat data pengajuan per divisi
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
					Pengajuan Barang Yang DI ACC</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_pengajuan_barang_acc" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa melihat data pengajuan yang di acc
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
					Pengajuan Barang Yang Tidak DI ACC</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_pengajuan_barang_batal" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa melihat data pengajuan yang tidak di acc
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
<form class="form-horizontal" action="module/laporan/pengadaan2.php" method="post">             
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
         <tr class="text-green">
          <th class="col-sm-2">Nomer Surat</th>
          <th class="col-sm-1">Nama Divisi</th>
          <th class="col-sm-2">Nama Pemohon</th>
          <th class="col-sm-1">Tanggal</th>
          <th class="col-sm-1">Status</th>
          <th class="col-sm-1">Aksi</th>
        </tr> 
      </thead>

      <tbody>
        <?php 
        $sql=("SELECT pengajuan_pengadaan_brg.no_surat_pengadaan,divisi.nama_divisi,user.nama,pengajuan_pengadaan_brg.tgl,pengajuan_pengadaan_brg.acc FROM pengajuan_pengadaan_brg INNER JOIN divisi ON pengajuan_pengadaan_brg.id_divisi=divisi.id_divisi INNER JOIN user ON pengajuan_pengadaan_brg.id_user=user.id_user");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['no_surat_pengadaan'];
          $acc = $tampilkan['acc'];
          ?>

          <tr>
           <td><?php echo $tampilkan['no_surat_pengadaan']; ?></td>
           <td><?php echo $tampilkan['nama_divisi']; ?></td>  
           <td><?php echo $tampilkan['nama']; ?></td>
           <td><?php echo $tampilkan['tgl']; ?></td>
           <td><?php if  ( $acc== 'X' ) {
            echo "<a class='btn btn-xs btn-warning' disabled >Ditinjau</a>";
            }
            else if ($acc== 'Y') {
            echo "<a class='btn btn-xs btn-success' disabled>Disetujui</a>";
            }
            else if ($acc== 'N') {
            echo "<a class='btn btn-xs btn-danger' disabled >Ditolak</a>"; 
            }   ?></td>
           <td align="center">

              <form class="form-horizontal" action="module/mengelola_pengadaan/pengajuan_pengadaan.php" method="get">
              <input type="hidden" name="no_surat_pengadaan" value="<?php echo $tampilkan['no_surat_pengadaan']; ?>">             
              <button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-search"></i></button> 
              </form>
           </td>
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<h3 class="box-title margin text-center"></h3>
	<br/>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-solid box-info">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-file-text"></i>
					Pengajuan Pengadaan Barang Yang DI ACC</h3>		 	
				</div>		
				<div class="box-body">
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_pengajuan_pengadaan_barang_acc" role="form" method="post">
						<div class="form-g">
							Disini anda bisa melihat data pengajuan pengadaan barang yang di acc
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
					Pengajuan Pengadaan Barang Yang Tidak DI ACC</h3>		 	
				</div>		
				<div class="box-body">
					
					<form class="form-horizontal" action="<?php echo $aksi?>?module=laporan&aksi=data_pengajuan_pengadaan_barang_batal" role="form" method="post">             
						<div class="form-g">
							Disini anda bisa melihat data pengajuan pengadaan barang yang tidak di acc
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

<?php
break;
case "data_barang masuk":
?>

<div class="text-center">
<h3>Data Barang Masuk</h3><hr/></div>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="btn btn-primary close" data-dismiss="alert" aria-hidden="true">&nbsp;<i class="fa fa-close "></i>&nbsp;</button>
<p><i class="icon fa fa-info"></i>
Silahkan masukan tanggal dan klik tombol cetak untuk cetak laporan data barang masuk!
</p>
</div> 
<form class="form-horizontal" action="module/laporan/barang_masuk.php" method="post">             
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
		<th class="col-sm-1">Tanggal</th>
		<th class="col-sm-2">Supplier</th>
		<th class="col-sm-2">Jumlah Barang</th>
	</tr>
</thead>
<tbody>
<?php 
// Tampilkan data dari Database 
        $sql=("SELECT brg_masuk.id_brg_masuk,brg_masuk.no_surat_pengadaan,brg_masuk.tgl_masuk,supplier.nama_sup,brg_masuk.jml_brg FROM brg_masuk INNER JOIN supplier ON brg_masuk.id_supplier=supplier.id_supplier");
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
           <td><?php echo $tampilkan['tgl_masuk']; ?></td>
           <td><?php echo $tampilkan['nama_sup']; ?></td>
           <td><?php echo $tampilkan['jml_brg']; ?></td>
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