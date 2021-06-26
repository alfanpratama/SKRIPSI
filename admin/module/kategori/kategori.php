<?php
$aksi="module/kategori/kategori_aksi.php";
switch($_GET[aksi]){
	default:
	?>
	<!----- ------------------------- MENAMPILKAN DATA MASTER kategori ------------------------- ----->			
	<h3 class="box-title margin text-center">Data Master kategori</h3>
	<br/>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-solid box-warning">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa  fa-plus"></i>
					Tambah Data kategori</h3>		 	
				</div>		
				<div class="box-body">
					<?php
					$sql ="SELECT max(id_kategori) as terakhir from kategori_barang";
					$hasil = mysql_query($sql);
					$data = mysql_fetch_array($hasil);
					$lastID = $data['terakhir'];
					$lastNoUrut = substr($lastID, 3, 9);
					$nextNoUrut = $lastNoUrut + 1;
					$nextID = "KTG".sprintf("%03s",$nextNoUrut);
					?> 
					<form class="form-horizontal" action="<?php echo $aksi?>?module=kategori&aksi=tambah" role="form" method="post">             

						<div class="form-group">

							<div class="col-sm-7">
								<input type="hidden" class="form-control" required="required" name="id_kategori" value="<?php echo  $nextID; ?>" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Nama kategori</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" required="required" name="nama_kategori" placeholder="Nama kategori">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4"></label>
							<div class="col-sm-7">
								<hr/>
								<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
								<button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i><i> Reset</i></button> 
							</div>
						</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		<div class="col-md-6">
			<div class="box box-solid box-info">
				<div class="box-header">
					<h3 class="btn enable box-title">
						<i class="fa fa-male"></i>
					Data Master kategori</h3>	
				</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr class="text-green">
								<th class="col-sm-1">No</th> 
								<th>Nama kategori</th> 
								<th class="col-sm-2">AKSI</th> 	
							</tr>
						</thead>

						<tbody>
							<?php 
// Tampilkan data dari Database
							$sql = "SELECT * FROM kategori_barang";
							$tampil = mysql_query($sql);
							$no=1;
							while ($tampilkan = mysql_fetch_array($tampil)) { 
								$Kode = $tampilkan['id_kategori'];

								?>

								<tr>
									<td><?php echo $no++; ?></td> 
									<td><?php echo $tampilkan['nama_kategori']; ?></td> 
									<td align="center">
										<a class="btn btn-xs btn-info" href="?module=kategori&aksi=edit&id_kategori=<?php echo $tampilkan['id_kategori'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
										<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=kategori&aksi=hapus&id_kategori=<?php echo $tampilkan['id_kategori'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
									</td>
									<?php
								}
								?>
							</tr>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
	<!----- ------------------------- END TAMBAH DATA MASTER kategori ------------------------- ----->
	<?php	
	break;
	case "edit" :
	$data=mysql_query("select * from kategori_barang where id_kategori='$_GET[id_kategori]'");
	$edit=mysql_fetch_array($data);
	?>

	<!----- ------------------------- EDIT DATA MASTER kategori ------------------------- ----->
	<h3 class="box-title margin text-center">Edit Data kategori "<?php echo $_GET['id_kategori']; ?>"</h3>
	<br/>
	<form class="form-horizontal" action="<?php echo $aksi?>?module=kategori&aksi=edit" role="form" method="post">             

		<div class="form-group">

			<div class="col-sm-5">
				<input type="hidden" class="form-control" readonly name="id_kategori" value="<?php echo $edit['id_kategori']; ?>" >
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Nama kategori</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" required="required" name="nm_kategori"value="<?php echo $edit['nama_kategori']; ?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4"></label>
			<div class="col-sm-5">
				<hr/>
				<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
				<a href="?module=kategori">
					<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
				</div>
			</div>

		</form>
	</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER kategori ------------------------- ----->
<?php
break;
}
?>