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
$act='module/buat_pengajuan/aksi_pengajuan.php';
include '../koneksi.php';
include '../inc/cek_session.php';

if($_SESSION['level']!="kepala_divisi" )
//membuat inisial nama
			$jml= mysql_num_rows(mysql_query('SELECT * FROM divisi'));
			$kode_unik = $jml+1;
			$inisial =strtoupper(substr($_SESSION['nama_divisi'],0,2));
//membuat nomor otomatis
			include "fungsi-romawi.php";
			$tanggal= date ('d');
			$bulan	= date('n');
			$romawi	= getRomawi($bulan);
			$tahun 	= date ('Y');
			$nomor 	= ".SPn/".$inisial."/".$tanggal."/".$romawi."/".$tahun;

		// membaca kode / nilai tertinggi dari penomoran yang ada didatabase berdasarkan tanggal
			$query = "SELECT (left( no_surat, 3 )) AS maxKode FROM pengajuan_brg ORDER BY left( no_surat_pengajuan, 3 ) desc";
			$hasil = mysql_query($query);
			$data  = mysql_fetch_array($hasil);
			$no= $data['maxKode'];
			$noUrut= $no + 1;

	//membuat Nomor Surat Otomatis dengan awalan depan 0 misalnya , 01,02 
	//jika ingin 003 ,tinggal ganti %03
			$kode =  sprintf("%03s", $noUrut);
			$nomorbaru = $kode.$nomor;
			// var_dump($nomorbaru);
			// var_dump($no);exit;
			  $tgl = date('Y-m-d');
			?>

<div class="box box-solid box-info">
	<div class="box-header">
		<h3 class="btn btn enable box-title"> Form Pengajuan Barang</h3>
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
        <form class="form-horizontal" method="POST" action="?module=aksi_pengajuan" name="text_form">
        	<left>
		  <div class="form-group">
		  	<label class="col-sm-2 control-label">No Surat Pengajuan</label>
		  	<div class="col-sm-3">
		  		<input type=text class="form-control" name="no_surat_pengajuan" id="no_surat_pengajuan" value="<?php echo $nomorbaru; ?>" readonly="yes">
		  	</div>
		  </div>
		  <div class="form-group">
          	<label class="col-sm-2 control-label">Tanggal Penhgajuan Barang</label>   
          	<div class="col-sm-5">
          		<input type=text class="form-control" id="tgl" name="tgl" value="<?php echo $tgl; ?>" readonly="yes">
          	</div>
          </div>

          <div class="form-group">
    		<label class="col-sm-2 control-label">Pemohon</label>
    		<div class="col-sm-5">  
    			<input type=text class="form-control" id="id_user" name="id_user" value="<?php echo $_SESSION['nama']; ?>" readonly="yes">
    		</div>
  		  </div>
  		  <div class="form-group">
    		<label class="col-sm-2 control-label">Divisi</label>
    		<div class="col-sm-5">
          	<input type=text class="form-control" id="id_divisi" name="id_divisi" value="<?php echo $_SESSION['id_divisi']; ?>" readonly="yes">
          	</div>
  		  </div>
  		  <div class="form-group">
    		<label class="col-sm-2 control-label">Perihal</label>
    		<div class="col-sm-9">
          	<TEXTAREA type=text class="form-control" id="perihal" name="perihal" placeholder="Perihal Pengajuan Barang"></TEXTAREA>
          	</div>
  		  </div>
		 </left>
		</form>
		<div class="box box-solid box-success">
			<div class="box-header">
			<h3 class="btn btn enable box-title">Input Data Barang</h3>
			</div>
        	<table class="table-bordered">
        	<tr>
				<th width="600">
    				<label class="col-sm-2 control-label">ID barang </label>
    				<div class="col-sm-6">
      					
      					<select name="barang" class="form-control select2" required="yes">
							<option value=" ">  </option>
							<?php $q = mysql_query ("SELECT * FROM barang");
								while ($k = mysql_fetch_array($q)){ ?>
							<option value="<?php echo $k['id_barang']; ?>" 
							<?php (@$h['id_barang']==$k['id_barang'])?print(" "):print(""); ?>  > <?php  echo $k['nama_brg']; ?>
							</option> <?php } ?>
						</select>
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
        echo "<tr bgcolor='".$warna."'>
			 <td align=center>$no</td>
			 <td align=center>$r[id_barang]</td>";
			 
				$sql=mysql_query("SELECT * FROM barang where id_barang_brg='$r[id_barang]'");
				$rs=mysql_fetch_array($sql);
				echo "<td>$rs[nama_brg]</td>";
       echo "
             
			 <td align=center>$r[jumlah]</td>";
     ?>
     <td align=center>
     <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=barang_keluar&aksi=hapus&id=<?php echo $r['id'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $r['id']; ?>?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
	{ $no='BM00000'; }
	elseif($jnim==2)
	{ $no='BM0000'; }
	elseif($jnim==3)
	{ $no='BM000'; }
	elseif($njim==4)
	{ $no='BM00'; }
	elseif($njim==5)
	{ $no='BM0'; }
	elseif($njim==6)
	{ $no='BM'; }
	$idpr=$no.$next;
echo "	<tr>
    <td colspan='3' align='right'><b>Jumlah Barang : </b></td>
    <td align='center'><b>$rs2[jml]</b><input type=hidden name=jml id=jml value=$rs2[jml]></td>
    <td align='center'>&nbsp;</td>
	</tr>
	</table>";
?>
</div>
</div>
<div class="form-group">
    	<div class="col-sm-2">
       	<button type=submit value='Simpan' class="btn btn-primary" name='btnSimpan'><i class="glyphicon glyphicon-floppy-disk">Simpan</i></button>
			</div>
		  </div>
		<?php
		if($_POST) {
			if(isset($_POST['btnTambah'])){
			if(trim($_POST[barang])==""){
				header('location:main.php?module=brg_keluar&pesan=Isi dulu Barang !');
			}else if(trim($_POST[qty])==""){
				header('location:main.php?module=brg_keluar&pesan=Isi dulu Jumlah Barang !');
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
				echo "<meta http-equiv='refresh' content='0; url=?module=brg_keluar'>";

			}
			}

			if(isset($_POST['btnSimpan'])){
			$sqlcek=mysql_query("SELECT * FROM tmp");
			$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
				mysql_query("INSERT INTO brg_keluar(
								  id_brg_keluar,
								  no_surat,
								  tgl_keluar,
								  id_user,
								  id_divisi,
								  jml_brg) 
							VALUES(
								'$_POST[id_brg_keluar]',
								'$_POST[no_surat]',
								'$_POST[tgl_keluar]',
								'$_POST[id_user]',
								'$_POST[id_divisi]',
								'$_POST[jml]')");
				$sql=mysql_query("SELECT * FROM tmp");
				while($rs=mysql_fetch_array($sql)){
					mysql_query("INSERT INTO detail_brg_keluar(
								  id_detail_keluar,
								  id_brg_keluar,
								  id_barang,
								  jml_brg) 
							VALUES(
								'$_POST[id_brg_keluar]',
								'$idpr[id_brg_keluar_]',
								'$rs[id_barang]',
								'$rs[jumlah]')");
					$sql2=mysql_query("SELECT * FROM stok where id_barang='$rs[id_barang]'");
					$rs2=mysql_fetch_array($sql2);
					$sisastok = $rs2[stok] + $rs[jumlah];
					mysql_query("update stok set
								  stok=$sisastok where
								  id_barang='$rs[id_barang]'");
				}
				
				
				mysql_query("truncate table tmp");
				
				echo "<meta http-equiv='refresh' content='0; url=?module=brg_keluar'>";
				header('location:main.php?module=brg_keluar&pesan=Data barang keluar berhasil disimpan ! ');
				
				}
				else{
					header('location:main.php?module=brg_keluar&pesan=Data Kosong !');
				}
			}
		} 
?>
