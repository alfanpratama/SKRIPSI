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
$aksi='module/barang_masuk/aksi_masuk.php';


?>
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
?>
<div class="box box-solid box-info">
	<div class="box-header">
		<h3 class="btn btn enable box-title">Input Barang Masuk</h3>
	</div>
	<div class="box-body table-responsive">

		<br>
		<form class="form-horizontal" method="POST" action="?module=brg_masuk" name="text_form">
			<table class="table-bordered">
				<tr>
					<th width="600">
						<label class="col-sm-2 control-label">ID barang </label>
						<div class="col-sm-6">

							<select name="barang" class="form-control select2" >
								<option value=""></option>
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
									<input type="text"   class="form-control" name="qty" id="qty" onkeypress="return isNumberKey(event)">&nbsp;
								</div>
							</th>
							<th>
								<input type="submit" value="Tambah" name="btnTambah" class="btn btn-primary btn-block" id="btnTambah">
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
										<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=brg_masuk&aksi=hapus&id_barang=<?php echo $r['id_barang'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $r[id_barang]; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
									</td></tr>
									<?php
									$no++;
									$counter++;
								}
								$sql2=mysql_query("SELECT sum(jumlah) as jml FROM tmp");
								$rs2=mysql_fetch_array($sql2);

								$ceknomor=mysql_fetch_array(mysql_query("SELECT id_brg_masuk FROM brg_masuk ORDER BY id_brg_masuk DESC LIMIT 1"));
								$cekQ=$ceknomor[id_brg_masuk];
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
										<label class="col-sm-4 control-label">No Barang Masuk</label>
										<div class="col-sm-3">
											<input type=text class="form-control" name="id_brg_masuk" id="id_brg_masuk" value="<?php echo $idpr; ?>" readonly="yes">
										</div>
									</div>
									<div class="form-group">

										<label class="col-sm-4 control-label">No Surat Pengadaan Barang</label>
										<div class="col-sm-5">  
											<select name="no_surat_pengadaan" class="form-control"  >
												<option value=""></option>
												<?php $q = mysql_query ("SELECT * FROM pengajuan_pengadaan_brg");
												while ($k = mysql_fetch_array($q)){ ?>
													<option value="<?php echo $k['no_surat_pengadaan']; ?>" 
														<?php (@$h['no_surat_pengadaan']==$k['no_surat_pengadaan'])?print(" "):print(""); ?>  > <?php  echo $k['no_surat_pengadaan']; ?>
														</option> <?php } ?>
													</select>
												</div>
											</div>
									<div class="form-group">

										<label class="col-sm-4 control-label">Tanggal Barang Masuk</label>   
										<div class="col-sm-5">
											<input type=text class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?php echo $tgl; ?>" readonly="yes">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">Supplier</label>
										<div class="col-sm-5">  
											<select name="id_supplier" class="form-control"  >
												<option value=""></option>
												<?php $q = mysql_query ("SELECT * FROM supplier");
												while ($k = mysql_fetch_array($q)){ ?>
													<option value="<?php echo $k['id_supplier']; ?>" 
														<?php (@$h['id_supplier']==$k['id_supplier'])?print(" "):print(""); ?>  > <?php  echo $k['nama_sup']; ?>
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
													
													$brg=substr($_POST[barang],0,7);
													$sqlcek1=mysql_query("SELECT * FROM stok where id_barang='$brg'");
													$rscek1=mysql_fetch_array($sqlcek1);

													if(trim($_POST[barang])==""){
				// header('location:main.php?module=barangkeluar&pesan=Isi dulu Barang !');
														echo "<meta http-equiv='refresh' content='0; url=?module=brg_masuk&pesan=Isi dulu Barang !'>";
													}else if(trim($_POST[qty])==""){
				// header('location:main.php?module=barangkeluar&pesan=Isi dulu Jumlah Barang !');
														echo "<meta http-equiv='refresh' content='0; url=?module=brg_masuk&pesan=Isi dulu Jumlah Barang !'>";
													}else{
														mysql_query("INSERT INTO tmp(
															no_surat,
															no_pengajuan,
															id_barang,
															jumlah) 
															VALUES(
															'$_POST[id_brg_masuk]',
															'$_POST[no_surat_pengadaan]',
															'$brg',
															'$_POST[qty]')");
														echo "<meta http-equiv='refresh' content='0; url=?module=brg_masuk'>";
													}
												}
												
												if(isset($_POST['btnSimpan'])){
													$sqlcek=mysql_query("SELECT * FROM tmp");
													$rscek=mysql_num_rows($sqlcek);
													if($rscek > 0){
														mysql_query("INSERT INTO brg_masuk where id_brg_masuk='$_POST[id_brg_masuk]' (
															id_brg_masuk,
															no_surat_pengadaan,
															tgl_masuk,
															id_supplier,
															jml_brg) 
															VALUES(
															'$_POST[id_brg_masuk]',
															'$_POST[no_surat_pengadaan]',
															'$_POST[tgl_masuk]',
															'$_POST[id_supplier]',
															'$_POST[jml]')");
														$sql=mysql_query("SELECT * FROM tmp");
														while($rs=mysql_fetch_array($sql)){
															mysql_query("INSERT INTO detail_brg_masuk where id_brg_masuk='$_POST[id_brg_masuk]'(
																id_brg_masuk,
																id_barang,
																jml_brg) 
																VALUES(
																'$_POST[id_brg_masuk]',
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

														echo "<meta http-equiv='refresh' content='0; url=?module=brg_masuk&pesan=Data Barang Masuk berhasil Disimpan !'>";
														// header('location:main.php?module=brg_keluar&pesan=Data barang keluar berhasil disimpan ! ');

													}
													else{
														echo "<meta http-equiv='refresh' content='0; url=?module=brg_masuk&pesan=Data Kosong !'>";
														// header('location:main.php?module=brg_keluar&pesan=Data Kosong !');
													}
												}
											} 
										?>