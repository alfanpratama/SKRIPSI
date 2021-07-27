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
	$("#barang").autocomplete("get_list.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});
});
</script>
<?php
include "pengaturan/fungsi_alert.php";
$aksi="module/barang_masuk/aksi_masuk.php";

  
?>
<div class="box box-solid box-info">
	<div class="box-header">
		<h3 class="btn btn enable box-title">Data Master barang </h3>
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
        <form method="POST" action="?module=brg_masuk" name="text_form">
        	<table class="table-bordered">
        	<tr>
				<th width="600">
    				<label class="col-sm-2 control-label">ID barang </label>
    				<div class="col-sm-6">
      					<input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="masukan nama/kode barang">&nbsp;
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
			 <td align=center>$r[kode_brg]</td>";
			 
				$sql=mysql_query("SELECT * FROM barang where kode_brg='$r[kode_brg]'");
				$rs=mysql_fetch_array($sql);
				echo "<td>$rs[nama_brg]</td>";
			
       echo "
             
			 <td align=center>$r[jumlah]</td>";
		
		echo"
		<td align=center>
	               <a class='btn btn-danger btn-sm' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=barangmasuk&act=hapus&id=$r[id]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">hapus</a>
				   
             </td></tr>";
      $no++;
	  $counter++;
    }
	$sql2=mysql_query("SELECT sum(jumlah) as jml FROM tmp");
	$rs2=mysql_fetch_array($sql2);

 $ceknomor=mysql_fetch_array(mysql_query("SELECT no_brgmasuk FROM barang_masuk ORDER BY no_brgmasuk DESC LIMIT 1"));
	$cekQ=$ceknomor[no_brgmasuk];
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
    echo "
	<tr>
    <td colspan='3' align='right'><b>Jumlah Barang : </b></td>
    <td align='center'><b>$rs2[jml]</b><input type=hidden name=jml id=jml value=$rs2[jml]></td>
    <td align='center'>&nbsp;</td>
	</tr>
	<br>
	<br>
	</table>

		<table>
		  <tr>
		  	<td width='250'>
		  	<div class='form-group'>
		  		No Barang Masuk
		  	</td>   
		  	<td> 
		  		: <input type=text name='no_brgmasuk' id='no_brgmasuk' value='$idpr' readonly>
		  	</td>
		  </tr>
          <tr>
          	<td width='250'>
          	<div class='form-group'>
          		Tanggal Barang Masuk
          	</td>   
          	<td> 
          		: <input type=text id='tgl_masuk' name='tgl_masuk' value='$tgl' readonly>
          	</td>
          </tr>
           <tr>
          	<td width='250'>
          	<div class='form-group'>
          		Tanggal Mutasi
          	</td>   
          	<td> 
          		: <select name='kode_supp' id='kode_supp'></option>";
				$hasil4 = mysql_query("SELECT * FROM supplier order by kode_supp");
		while($r4=mysql_fetch_array($hasil4)){
			echo "<option value='$r4[kode_supp]'>$r4[nama_supp]</option>";
		}
		echo	"</select>
          	</td>
          </tr>
		<tr>
          	<td>
          		<button type=submit value='Simpan' name='btnSimpan' class='btn btn-success btn-block'>Simpan</button>
          	</td>
          </tr>
        </table>
		
		</form>
		<br>
		";

		if($_POST) {
			if(isset($_POST['btnTambah'])){
			if(trim($_POST[barang])==""){
				header('location:main.php?module=barangmasuk&pesan=Isi dulu Barang !');
			}else if(trim($_POST[qty])==""){
				header('location:main.php?module=barangmasuk&pesan=Isi dulu Jumlah Barang !');
			}else{
			$brg=substr($_POST[barang],0,7);
			$sqlcek1=mysql_query("SELECT * FROM barang where kode_brg='$brg'");
			$rscek1=mysql_fetch_array($sqlcek1);
				mysql_query("INSERT INTO tmp(
								  kode_brg,
								  jumlah) 
							VALUES(
								'$brg',
								'$_POST[qty]')");
				echo "<meta http-equiv='refresh' content='0; url=?module=barangmasuk'>";
			}
			}

			if(isset($_POST['btnSimpan'])){
			$sqlcek=mysql_query("SELECT * FROM tmp");
			$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
				mysql_query("INSERT INTO barang_masuk(
								  no_brgmasuk,
								  tgl_masuk,
								  kode_supp,
								  username,
								  jml_brg) 
							VALUES(
								'$_POST[no_brgmasuk]',
								'$_POST[tgl_masuk]',
								'$_POST[kode_supp]',
								'$_SESSION[namauser]',
								'$_POST[jml]')");
				$sql=mysql_query("SELECT * FROM tmp");
				while($rs=mysql_fetch_array($sql)){
					mysql_query("INSERT INTO detail_brgmasuk(
								  no_brgmasuk,
								  kode_brg,
								  jml_brg) 
							VALUES(
								'$_POST[no_brgmasuk]',
								'$rs[kode_brg]',
								'$rs[jumlah]')");
					$sql2=mysql_query("SELECT * FROM stok where kode_brg='$rs[kode_brg]'");
					$rs2=mysql_fetch_array($sql2);
					$sisastok = $rs2[stok] + $rs[jumlah];
					mysql_query("update stok set
								  stok=$sisastok where
								  kode_brg='$rs[kode_brg]'");
				}
				
				
				mysql_query("truncate table tmp");
				
				echo "<meta http-equiv='refresh' content='0; url=?module=barangmasuk'>";
				header('location:main.php?module=barangmasuk&pesan=Data barang masuk berhasil disimpan ! ');
				
				}
				else{
					header('location:main.php?module=barangmasuk&pesan=Data Kosong !');
				}
			}
		} 
?>