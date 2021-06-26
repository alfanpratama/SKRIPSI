<script>
	function startCalc(){
		interval = setInterval("calc()",1);}
		function calc(){
			a = document.f1.qty.value;
			b = document.f1.harga_jual.value;
			c = document.f1.diskon.value;
			d = document.f1.subtotal.value;
			document.f1.subtotal.value = (((a*1)*(b*1))-c);
			document.f1.ppn.value = (((d*1)*10)/100);

		}
		function stopCalc(){
			clearInterval(interval);}
		</script>


		<?php
		$aksi="module/pesanan/pesanan_aksi.php";
		$aksi2="module/pesanan/pesanan.php";
		include '../koneksi.php';
		switch($_GET['aksi']){
			default:
//membuat inisial nama
			$jml= mysql_num_rows(mysql_query('SELECT * FROM user'));
			$kode_unik = $jml+1;
			$inisial =strtoupper(substr($_SESSION['nama'],0,2));
//membuat nomor otomatis
			include "fungsi-romawi.php";
			$bulan	= date('n');
			$romawi	= getRomawi($bulan);
			$tahun 	= date ('Y');
			$nomor 	= "/SP-ABS/".$inisial."/".$romawi."/".$tahun;

		// membaca kode / nilai tertinggi dari penomoran yang ada didatabase berdasarkan tanggal
			$query = "SELECT (left( no_surat, 3 )) AS maxKode FROM pesanan  ORDER BY left( no_surat, 3 ) desc";
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
			?>



			<!----- ------------------------- MENAMPILKAN DATA MASTER jabatan ------------------------- ----->			
			<h3 class="box-title margin text-center">Data Pesanan</h3>
			<br/>
			<div class="row">
				<div class="col-md-6">
					<div class="box  box-info">
						<div class="box-header">
							<h3 class="btn disabled box-title">
								<i class="fa fa-shopping-cart "></i>
							1. Pilih Barang</h3>	
						</div>		
						<div class="box-body table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr class="text-green">
										<th class="col-sm-1">No</th> 
										<th>Nama Barang</th>
										<th>Spesifikasi</th> 
										<th class="col-sm-1">AKSI</th> 	
									</tr>
								</thead>

								<tbody>
									<?php 
// Tampilkan data dari Database
									$sql = "SELECT * FROM barang";
									$tampil = mysql_query($sql);
									$no=1;
									while ($tampilkan = mysql_fetch_array($tampil)) { 
										$Kode = $tampilkan['id_barang'];

										?>

										<tr>
											<td><?php echo $no++; ?></td> 
											<td><?php echo $tampilkan['nama_brg']; ?></td>
											<td><?php echo $tampilkan['spesifikasi']; ?></td> 
											<td align="center">
												<a class="btn btn-xs btn-info" href="?module=pesanan&aksi=tambah&id_barang=<?php echo $tampilkan['id_barang'];?>" alt="Tambah Data"><i class="glyphicon glyphicon-shopping-cart"></i></a>

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


				<!-- Daftar Pelanggan -->
				<?php
				$data=mysql_query("select * from pelanggan where id_pelanggan='".$_GET['id_pelanggan']."'");
				$tambah_pelanggan=mysql_fetch_array($data);
				$id_pelanggan=$_GET['id_pelanggan'];
				$id_user=$_SESSION['id'];
				?>
				<div class="row">
					<div class="col-md-6">
						<div class="box  box-info">
							<div class="box-header">
								<h3 class="btn disabled box-title">
									<i class="fa fa-user "></i>
								2. Masukkan Data Pelanggan</h3>	
							</div>		
							<form class="form-horizontal" action="<?php echo $aksi?>?module=pesanan&aksi=simpan&id_pelanggan=<?php echo $id_pelanggan;?>" role="form" method="post" >   <div class="form-group">
								<label class="col-sm-4 control-label">Nomor Surat </label>
								<div class="col-sm-5">
									<input type="text" class="form-control" readonly name="no_surat" value="<?php echo $nomorbaru; ?>" >
									<input type="hidden" class="form-control" readonly name="id_user" value="<?php echo $id_user; ?>" >
								</div>
							</div> 

							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Pelanggan </label>
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<a  href="?module=pesanan&aksi=lanjut" alt=""><i class="fa fa-user-plus "></i></a>
										</div>
										<input type="text" class="form-control" required="yes" readonly id="nama" name="nama_pelanggan" value="<?php echo $tambah_pelanggan['nama_pel'] ?>"  />
									</div>
								</div>
							</div>
							<?php $hari_ini=date("Y-m-d");   ?>
							<div class="form-group">
								<label class="col-sm-4 control-label">Tanggal</label>	
								<div class="col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input type="date" name="tanggal" required="required" class="form-control pull-right" value="<?php echo $hari_ini;?>" />
									</div><!-- /.input group -->
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4"></label>
								<div class="col-sm-5">

									<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>

									<button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-disk"></i><i> Reset</i></button>
								</div>
							</div>
							<hr/>
						</form>
					</div>
				</div>
			</div>
			<!--END Daftar Pelanggan-->




			<div class="col-md-12">
				<div class="box box-solid box-info">
					<div class="box-header">
						<h3 class="btn enable box-title">
							<i class="fa fa-truck"></i>
						Keranjang Pesanan</h3>	
					</div>		
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="text-green">
									<th >No</th> 
									<th>Nama Barang</th> 
									<th>Spesifikasi</th> 
									<th class="col-sm-1">qty</th>  
									<th class="col-sm-2">Harga Jual</th> 
									<th class="col-sm-2">PPN</th> 
									<th class="col-sm-2">Status Barang</th> 
									<th class="col-sm-1" >AKSI</th> 	
								</tr>
							</thead>

							<tbody>
								<?php 
							// Tampilkan data dari Database
								$sql = "SELECT * FROM pesanan_tmp ";
								$tampil = mysql_query($sql);
								$no=1;
								while ($tampilkan = mysql_fetch_array($tampil)) { 
									$Kode = $tampilkan['id_barang'];

									?>

									<tr>
										<td><?php echo $no++; ?></td> 
										<td><?php echo $tampilkan['nama_brg']; ?></td> 
										<td><?php echo $tampilkan['spesifikasi']; ?></td> 
										<td><?php echo $tampilkan['qty']; ?></td>
										<td><?php echo $tampilkan['harga_jual']; ?></td>
										<td><?php echo $tampilkan['ppn']; ?></td> 
										<td><?php echo $tampilkan['status_barang']; ?></td>
										<td align="center">
											<a class="btn btn-xs btn-info" href="?module=pesanan&aksi=edit&id_barang=<?php echo $tampilkan['id_barang'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
											<a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=pesanan
												&aksi=hapus&id_barang=<?php echo $tampilkan['id_barang'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
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



			<?php	
			break;
			case "lanjut" :

			?>

			<!----- ------------------------- TAMBAH PELANGGAN  ------------------------- ----->
			<h3 class="box-title margin text-center">Data Master pelanggan</h3>
			<center> <div class="batas"> </div></center>
			<hr/>
			<div class="box box-solid box-info">
				<div class="box-header">
					<h3 class="btn btn enable box-title">
						<i class="fa fa-map-marker"></i>
					Data Master pelanggan </h3>

				</div>		
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr class="text-green">

								<th class="col-sm-1">ID Pelanggan</th>
								<th class="col-sm-2">Nama Instansi</th>
								<th class="col-sm-1">Telepon</th> 
								<th class="col-sm-3">Alamat</th> 
								<th class="col-sm-2">Nama User</th> 
								<th class="col-sm-1">Email</th>
								<th class="col-sm-1">Aksi</th>
							</tr>
						</thead>

						<tbody>
							<?php 
// Tampilkan data dari Database
							$sql = "SELECT * FROM pelanggan";
							$tampil = mysql_query($sql);
							$no=1;
							while ($tampilkan = mysql_fetch_array($tampil)) { 

								$Kode = $tampilkan['id_pelanggan'];
								?>

								<tr>
									<td><?php echo $tampilkan['id_pelanggan']; ?></td>	
									<td><?php echo $tampilkan['nama_pel']; ?></td>
									<td><?php echo $tampilkan['telp']; ?></td>
									<td><?php echo $tampilkan['alamat']; ?></td>
									<td><?php echo $tampilkan['cp']; ?></td>
									<td><?php echo $tampilkan['email']; ?></td>

									<td align="center">
										<a class="btn btn-xs btn-info" href="?module=pesanan&id_pelanggan=<?php echo $tampilkan['id_pelanggan'];?>" alt="Tambah Data"><i class="glyphicon glyphicon-ok"></i></a>

									</td>

									<?php
								}
								?>
							</tr>
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->

			<!----- ------------------------- END Tambah Pelanggan ------------------------- ----->



			<?php	
			break;
			case "edit" :
			$data=mysql_query("select * from pesanan_tmp where id_barang='".$_GET['id_barang']."'");
			$edit=mysql_fetch_array($data);
			?>

			<!----- ------------------------- EDIT DATA MASTER BARANG  ------------------------- ----->
			<h3 class="box-title margin text-center">Edit Data Barang "<?php echo $_GET['id_barang']; ?>"</h3>
			<br/>
			<form  class="form-horizontal" action="<?php echo $aksi?>?module=pesanan&aksi=edit" role="form" name="f1" method="post">             

				<div class="form-group">
					<label class="col-sm-4 control-label">Nama Pesanan</label>
					<div class="col-sm-5">
						<input type="hidden" class="form-control" readonly name="id_user" value="<?php echo $id_user; ?>" >
						<input type="hidden" class="form-control" readonly name="id_barang" value="<?php echo $edit['id_barang']; ?>" >
						<input type="text" class="form-control" required="required" name="nama"value="<?php echo $edit['nama_brg']; ?>">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label">Spesifikasi</label>
					<div class="col-sm-5">
						<input type="text" class="form-control"  name="spesifikasi"value="<?php echo $edit['spesifikasi']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Qty</label>
					<div class="col-sm-5">
						<input type="number" class="form-control" required="required" name="qty" onFocus="startCalc();" onBlur="stopCalc();">
					</div>
				</div>
				<div class="form-group">

					<div class="col-sm-5">
						<input type="hidden" class="form-control" required="required" name="harga_beli" value="<?php echo $edit['harga_beli']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label">Harga Jual</label>
					<div class="col-sm-5">
						<input type="number" class="form-control" required="required" name="harga_jual" value="<?php echo $edit['harga_jual']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Diskon</label>
					<div class="col-sm-5">
						<input type="number" class="form-control" name="diskon" value="<?php echo $edit['diskon']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Subtotal</label>
					<div class="col-sm-5">
						<input type="number" class="form-control" readonly required="required" name="subtotal" value="<?php echo $edit['subtotal']; ?>" onchange="tryNumberFormat(this.form.thirdBox);">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">PPN</label>
					<div class="col-sm-5">
						<input type="number" class="form-control"  name="ppn" value="<?php echo $edit['ppn']; ?>" onchange="tryNumberFormat(this.form.thirdBox);">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4"></label>
					<div class="col-sm-5">
						<hr/>
						<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
						<a href="?module=pesanan">
							<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
						</div>
					</div>

				</form>
			</div>
		</div>
		<!----- ------------------------- END EDIT DATA MASTER jabatan ------------------------- ----->

		<?php 
		break;
		case "tambah": 
//ID
		$data=mysql_query("select * from barang where id_barang='".$_GET['id_barang']."'");
		$tambah=mysql_fetch_array($data);
		$harga=$tambah['harga_jual'];
		if($harga=='0' ){

			echo "<script> alert('Harga Masih Belum Di Input')</script>";
			echo("<META HTTP-EQUIV=Refresh CONTENT=\"0.1;URL=?module=pesanan\">");
		}else{ 
	//membuat inisial nama
			$jml= mysql_num_rows(mysql_query('SELECT * FROM user'));
			$kode_unik = $jml+1;
			$inisial =strtoupper(substr($_SESSION['nama'],0,2));
//membuat nomor otomatis
			include "fungsi-romawi.php";
			$bulan	= date('n');
			$romawi	= getRomawi($bulan);
			$tahun 	= date ('Y');
			$nomor 	= "/SP-ABS/".$inisial."/".$romawi."/".$tahun;

		// membaca kode / nilai tertinggi dari penomoran yang ada didatabase berdasarkan tanggal
			$query = "SELECT (left( no_surat, 3 )) AS maxKode FROM pesanan ORDER BY left( no_surat, 3 ) desc";
			$hasil = mysql_query($query);
			$data  = mysql_fetch_array($hasil);
			$no= $data['maxKode'];
			$noUrut= $no + 1;

	//membuat Nomor Surat Otomatis dengan awalan depan 0 misalnya , 01,02 
	//jika ingin 003 ,tinggal ganti %03
			$kode =  sprintf("%03s", $noUrut);
			$nomorbaru = $kode.$nomor;

			$id_user=$_SESSION['id'];
			?>

			
			<!----- ------------------------- TAMBAH DATA MASTER barang ------------------------- ----->
			<h3 class="box-title margin text-center">Tambah Barang "<?php echo $_GET['id_barang']; ?>" </h3>


			<br/>
			<form class="form-horizontal" action="<?php echo $aksi?>?module=pesanan&aksi=tambah" role="form" method="post" name="f1">             
				<div class="form-group">
					<label class="col-sm-4 control-label">Nomor Surat </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" readonly name="no_surat" value="<?php echo $nomorbaru; ?>" >
						<input type="hidden" class="form-control" readonly name="id_user" value="<?php echo $id_user; ?>" >
					</div>
				</div> 



				<div class="form-group">
					<label class="col-sm-4 control-label">Nama Barang </label>
					<div class="col-sm-5">
						<input type="hidden" class="form-control" readonly name="id_barang" value="<?php echo $tambah['id_barang']; ?>" >
						<input type="text" class="form-control"  name="nama" value="<?php echo $tambah['nama_brg']; ?>" >

					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Spesifikasi</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" required="required" name="spesifikasi" value="<?php echo $tambah['spesifikasi']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Qty</label>
					<div class="col-sm-5">
						<input type="number" class="form-control" required="required" name="qty" onFocus="startCalc();" onBlur="stopCalc();">
					</div>
				</div>
				<div class="form-group">

					<div class="col-sm-5">
						<input type="hidden" class="form-control" required="required" name="harga_beli" value="<?php echo $tambah['harga_beli']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label">Harga Jual</label>
					<div class="col-sm-5">
						<input type="number" class="form-control" required="required" name="harga_jual" value="<?php echo $tambah['harga_jual']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Diskon</label>
					<div class="col-sm-5">
						<input type="number" class="form-control" name="diskon" value="<?php echo $edit['diskon']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Subtotal</label>
					<div class="col-sm-5">
						<input type="number" class="form-control" readonly required="required" name="subtotal" value="<?php echo $edit['subtotal']; ?>" onchange="tryNumberFormat(this.form.thirdBox);">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">PPN</label>
					<div class="col-sm-5">
						<input type="number" class="form-control"  name="ppn" value="<?php echo $tambah['ppn']; ?>" onchange="tryNumberFormat(this.form.thirdBox);">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Status Barang</label>
					<div class="col-sm-5">
						<select class="form-control" name="status_barang" >
							<option>Ready</option>
							<option>Indent</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4"></label>
					<div class="col-sm-5">
						<hr/>
						<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
						<a href="?module=pesanan">
							<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
						</div>
					</div>

				</form>
				<?php
			}
			break;
		}
		?>