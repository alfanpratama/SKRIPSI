<link type="text/css" href="css/smoothness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
		<script type="text/javascript">
		$(function() {
		$( "#tgl" ).datepicker({
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
include '../inc/cek_session.php';
$aksi='module/buat_pengajuan/buat_pengajuan.php';
if($_SESSION['level']!="kepala_divisi" )
//membuat inisial nama
			$jml= mysql_num_rows(mysql_query('SELECT * FROM divisi'));
			$kode_unik = $jml+1;
			$inisial =strtoupper(substr($_SESSION['nama_divisi'],0,2));

			include "fungsi-romawi.php";
			$tanggal= date ('d');
			$bulan	= date('n');
			$romawi	= getRomawi($bulan);
			$tahun 	= date ('Y');
			$nomor 	= ".SPn/".$inisial."/".$tanggal."/".$romawi."/".$tahun;

		// membaca kode / nilai tertinggi dari penomoran yang ada didatabase berdasarkan tanggal
			$query = "SELECT (left( no_surat_pengajuan, 3 )) AS maxKode FROM pengajuan_brg ORDER BY left( no_surat_pengajuan, 3 ) desc";
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
	// echo "<script> alert('Stok Kurang')</script>";
	// $pesan = $_GET['pesan'];
	// var_dump($pesan);end;
	echo "
	<div style=\"margin-right:10%;margin-left:15%\" class=\"alert alert-warning alert-dismissable\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
	<p><i class=\"icon fa fa-info\"></i>
	<strong>".$_GET['pesan']."</strong>
	</p>
	</div> ";
}
if(isset($_GET['pesan2'])){
	// echo "<script> alert('Stok Kurang')</script>";
	// $pesan = $_GET['pesan'];
	// var_dump($pesan);end;
	echo "
	<div style=\"margin-right:10%;margin-left:15%\" class=\"alert alert-success alert-dismissable\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
	<p><i class=\"icon fa fa-info\"></i>
	<strong>".$_GET['pesan']."</strong>
	</p>
	</div> ";
}
if(isset($_GET['pesan3'])){
	// echo "<script> alert('Stok Kurang')</script>";
	// $pesan = $_GET['pesan'];
	// var_dump($pesan);end;
	echo "
	<div style=\"margin-right:10%;margin-left:15%\" class=\"alert alert-success alert-dismissable\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
	<p><i class=\"icon fa fa-info\"></i>
	<strong>".$_GET['pesan']."</strong>
	</p>
	</div> ";
}
?>
		<br>
        <form class="form-horizontal" method="POST" action="?module=buat_pengajuan" name="text_form">
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
        echo "<td align=center>$no</td>
			  <td align=center>$r[id_barang]</td>";

		$sql=mysql_query("SELECT * FROM barang where id_barang='$r[id_barang]'");
		$rs=mysql_fetch_array($sql);
		echo "<td>$rs[nama_brg]</td>";
		echo "<td align=center>$r[jumlah]</td>";
		?> 
		<td align=center>
		<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=buat_pengajuan&aksi=hapus&id_barang=<?php echo $r['id_barang'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $r[id_barang]; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
     </td></tr>
     <?php
      $no++;
	  $counter++;
    }
	$sql2=mysql_query("SELECT sum(jumlah) as jml FROM tmp");
	$rs2=mysql_fetch_array($sql2);
echo "<tr>
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
		if(isset($_POST['btnTambah'])){
													
			$brg=substr($_POST[barang],0,7);
			$sqlcek1=mysql_query("SELECT * FROM stok where id_barang='$brg'");
			$rscek1=mysql_fetch_array($sqlcek1);

				if(trim($_POST[barang])==""){
				// header('location:main.php?module=barangkeluar&pesan=Isi dulu Barang !');
					echo "<meta http-equiv='refresh' content='0; url=?module=buat_pengajuan&pesan=Isi dulu Barang !'>";
				}else if(trim($_POST[qty])==""){
				// header('location:main.php?module=barangkeluar&pesan=Isi dulu Jumlah Barang !');
					echo "<meta http-equiv='refresh' content='0; url=?module=buat_pengajuan&pesan=Isi dulu Jumlah Barang !'>";
				}else{
			mysql_query("INSERT INTO tmp(
										no_surat,
										id_barang,
										jumlah) 
						VALUES(
										'$_POST[no_surat_pengajuan]',
										'$brg',
										'$_POST[qty]')");		
			echo "<meta http-equiv='refresh' content='0; url=?module=buat_pengajuan'>";	
			}
		}
			if(isset($_POST['btnSimpan'])){
				$sqlcek=mysql_query("SELECT * FROM tmp");
				$rscek=mysql_num_rows($sqlcek);
				if($rscek > 0){
					mysql_query("INSERT INTO pengajuan_brg where no_surat_pengajuan='$_POST[no_surat_pengajuan]' (
								no_surat_pengajuan,
								id_user,
								tgl,
								id_divisi,
								perihal,
								jml_brg) 
								VALUES(
								'$_POST[no_surat_pengajuan]',
								'$_POST[id_user]',
								'$_POST[tgl]',
								'$_POST[id_divisi]',
								'$_POST[perihal]',
								'$_POST[jml]')");
				$sql=mysql_query("SELECT * FROM tmp");
				while($rs=mysql_fetch_array($sql)){
				mysql_query("INSERT INTO detail_pengajuan where no_surat_pengajuan='$_POST[no_surat_pengajuan]'(
								no_surat_pengajuan,
								id_barang,
								jml_brg) 
								VALUES(
								'$_POST[no_surat_pengajuan]',
								'$rs[id_barang]',
								'$rs[jumlah]')");
				}
				
				mysql_query("truncate table tmp");
				
				echo "<meta http-equiv='refresh' content='0; url=?module=buat_pengajuan&pesan=Pengajuan Barang Berhasil Dikirim !'>";
				//header('location:main.php?module=buat_pengajuan&pesan=Data barang keluar berhasil disimpan ! ');
				
				}
				else{
					header('location:main.php?module=buat_pengajuan&pesan=Data Kosong !');
				}
			} 
?>
