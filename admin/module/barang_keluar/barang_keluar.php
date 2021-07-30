<link type="text/css" href="css/smoothness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
		<script type="text/javascript">
		$(function() {
		$( "#tgl_masuk" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "2019:2021",
				dateFormat: "yy-mm-dd"
			});
		});
		</script>
		<script type='text/javascript' src='autocomplete/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="autocomplete/jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#barang").autocomplete("../autocomlete/get_list.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});
});
</script>
<?php
include '../koneksi.php';
include 'pengaturan/fungsi_alert.php';
$aksi='module/barang_keluar/keluar_aksi.php';

  
?>
<div class="box box-solid box-info">
	<div class="box-header">
		<h3 class="btn btn enable box-title">Input Barang Keluar</h3>
	</div>
		<div class="box-body table-responsive">
<?php
if(isset($_GET['pesan'])){
		echo "
		
		<div class=\"ui-widget\">
			<div class=\"ui-state-highlight ui-corner-all\" style=\"margin-top: 20px; padding: 0 .7em;\">
				<span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: .3em;\"></span>
				<strong>".$_GET['pesan']."</strong>
			</div>
		</div>";
	}
?>
		<br>
        <form class="form-horizontal" method="POST" action="?module=brg_keluar" name="text_form">
        	<table class="table-bordered">
        	<tr>
				<th width="600">
    				<label class="col-sm-2 control-label">ID barang </label>
    				<div class="col-sm-6">
      					<input type="text" class="form-control" name="barang" id="barang" placeholder="masukan nama/kode barang">&nbsp;
    				</div>
				</th>
				<th width="300">	
					<label class="col-sm-3 control-label">Jumlah </label>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="qty" id="qty" onkeypress="return isNumberKey(event)">&nbsp;
					</div>
				</th>
				<th>
					<button type="submit" value="Tambah" name="btnTambah" class="btn btn-primary btn-block" id="btnTambah">Tambah</button>
				</th>
			</tr>
		</table>
<br>
<div class="box-body table-responsive">
 	<table id="example1" class="table table-bordered table-striped"> 
    	<thead>
         <tr class="text-green">
          <th class="col-sm-1">No</th>
          <th class="col-sm-2">ID barang</th>
          <th class="col-sm-3">Nama Barang</th>
          <th class="col-sm-2">Jumlah</th> 
          <th class="col-sm-2">Hapus</th> 
        </tr>
      </thead>
      <tbody>
		<?php
    	$tampil=mysql_query("SELECT * FROM tmp");
		$no=1;
		$counter = 1;
    	while ($r=mysql_fetch_array($tampil)){
       echo "<td align=center>$no</td>
			 <td align=center>$r[id_barang]</td>";
			 
				$sql=mysql_query("SELECT * FROM barang where id_barang='$r[id_barang]'");
				$rs=mysql_fetch_array($sql);
				echo "<td>$rs[nama_brg]</td>";
			
       echo "
             
			 <td align=center>$r[jumlah]</td>";
			?> 
			 <td align=center>
	               <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=barang_keluar&aksi=hapus&id_barang=<?php echo $tampilkan['id_barang'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
             </td></tr>
    <?php
      $no++;
	  $counter++;
    }
	$sql2=mysql_query("SELECT sum(jumlah) as jml FROM tmp");
	$rs2=mysql_fetch_array($sql2);

 $ceknomor=mysql_fetch_array(mysql_query("SELECT id_brg_keluar FROM brg_keluar ORDER BY id_brg_keluar DESC LIMIT 1"));
	$cekQ=$ceknomor[id_brg_keluar];
	$awalQ=substr($cekQ,2-7);
	$next=$awalQ+1;
	$jnim=strlen($next);

	if($jnim==1)
	{ $no='BK00000'; }
	elseif($jnim==2)
	{ $no='BK0000'; }
	elseif($jnim==3)
	{ $no='BK000'; }
	elseif($njim==4)
	{ $no='BK00'; }
	elseif($njim==5)
	{ $no='BK0'; }
	elseif($njim==6)
	{ $no='BK'; }
	$idpr=$no.$next;
  $tgl = date('Y-m-d');
echo "	<tr>
    <td colspan='3' align='right'><b>Jumlah Barang : </b></td>
    <td align='center'><b>$rs2[jml]</b><input type=hidden name=jml id=jml value=$rs2[jml]></td>
    <td align='center'>&nbsp;</td>
	</tr>
	<br>
	<br>
	</table>";
?>
<br>
<br>
<left>
		  <div class="form-group">
		  	<label class="col-sm-4 control-label">No Barang Keluar</label>
		  	<div class="col-sm-3">
		  		<input type=text class="form-control" name="id_brg_keluar" id="id_brg_keluar" value="<?php echo $idpr; ?>" readonly="yes">
		  	</div>
		  </div>
		  <div class="form-group">
          	<label class="col-sm-4 control-label">Tanggal Barang Keluar</label>   
          	<div class="col-sm-5">
          	<input type=text class="form-control" id="tgl_keluar" name="tgl_keluar" value="<?php echo $tgl; ?>" readonly="yes">
          	</div>
          </div>
          <div class="form-group">
    		<label class="col-sm-4 control-label">Penerima</label>
    		<div class="col-sm-5">  
      			<select name="id_user" class="form-control">
      				<option value=" "> -- Pilih Penerima Barang -- </option>
      				<?php $q = mysql_query ("SELECT * FROM user");
        			while ($k = mysql_fetch_array($q)){ ?>
        			<option value="<?php echo $k['nama']; ?>" 
          				<?php (@$h['id_user']==$k['id_user'])?print(" "):print(""); ?>  > <?php  echo $k['nama']; ?>
        			</option> <?php } ?>
      			</select>
    		</div>
  		  </div>
  		  <div class="form-group">
    		<label class="col-sm-4 control-label">Divisi</label>
    		<div class="col-sm-5">  
      			<select name="id_user" class="form-control">
      				<option value=" "> -- Pilih Divisi -- </option>
      				<?php $q = mysql_query ("SELECT * FROM divisi");
        			while ($k = mysql_fetch_array($q)){ ?>
        			<option value="<?php echo $k['nama_divisi']; ?>" 
          				<?php (@$h['id_divisi']==$k['id_divisi'])?print(" "):print(""); ?>  > <?php  echo $k['nama_divisi']; ?>
        			</option> <?php } ?>
      			</select>
    		</div>
  		  </div>
  		  <div class="form-group">
    		<label class="col-sm-4"></label>
    		<div class="col-sm-5">
				<hr/>
          		<button type=submit value='Simpan' class="btn btn-primary" name='btnSimpan'><i class="glyphicon glyphicon-floppy-disk">Simpan</i></button>
			</div>
		  </div>
		 </left>
		</form>
		<br>
		<?php
		if($_POST) {
			if(isset($_POST['btnTambah'])){
			if(trim($_POST[barang])==""){
				header('location:main.php?module=barang_keluar&pesan=Isi dulu Barang !');
			}else if(trim($_POST[qty])==""){
				header('location:main.php?module=barang_keluar&pesan=Isi dulu Jumlah Barang !');
			}else{
			$brg=substr($_POST[barang],0,7);
			$sqlcek1=mysql_query("SELECT * FROM barang where id_barang='$brg'");
			$rscek1=mysql_fetch_array($sqlcek1);
				mysql_query("INSERT INTO tmp(
								  id_barang,
								  jumlah) 
							VALUES(
								'$brg',
								'$_POST[qty]')");
				echo "<meta http-equiv='refresh' content='0; url=?module=barang_keluar'>";
			}
			}

			if(isset($_POST['btnSimpan'])){
			$sqlcek=mysql_query("SELECT * FROM tmp");
			$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
				mysql_query("INSERT INTO brg_keluar(
								  id_brg_keluar,
								  tgl_keluar,
								  id_user,
								  id_divisi,
								  jml_brg) 
							VALUES(
								'$_POST[id_brg_keluar]',
								'$_POST[tgl_keluar]',
								'$_POST[id_user]',
								'$_POST[id_divisi]',
								'$_POST[jml]')");
				$sql=mysql_query("SELECT * FROM tmp");
				while($rs=mysql_fetch_array($sql)){
					mysql_query("INSERT INTO detail_brg_keluar(
								  id_brg_keluar,
								  id_barang,
								  jml_brg) 
							VALUES(
								'$_POST[id_brg_keluar]',
								'$rs[id_barang]',
								'$rs[jumlah]')");
					$sql2=mysql_query("SELECT * FROM stok where kode_brg='$rs[id_barang]'");
					$rs2=mysql_fetch_array($sql2);
					$sisastok = $rs2[stok] + $rs[jumlah];
					mysql_query("update stok set
								  stok=$sisastok where
								  kode_brg='$rs[id_barang]'");
				}
				
				
				mysql_query("truncate table tmp");
				
				echo "<meta http-equiv='refresh' content='0; url=?module=barang_keluar'>";
				header('location:main.php?module=barang_keluar&pesan=Data barang masuk berhasil disimpan ! ');
				
				}
				else{
					header('location:main.php?module=barang_keluar&pesan=Data Kosong !');
				}
			}
		} 
?>