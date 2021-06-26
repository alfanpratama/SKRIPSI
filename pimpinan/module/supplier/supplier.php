<?php
$aksi="module/supplier/supplier_aksi.php";


switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER supplier ------------------------- ----->			
<h3 class="box-title margin text-center">Data Master supplier</h3>
<center> <div class="batas"> </div></center>
<hr/>
	<div class="box box-solid box-info">
		<div class="box-header">
		<h3 class="btn btn enable box-title">
		<i class="fa fa-map-marker"></i>
		Data Master supplier </h3>
		<a class="btn btn-default pull-right"href="?module=supplier&aksi=tambah">
		<i class="fa  fa-plus"></i> Tambah Data</a>		
		</div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
	<tr class="text-green">
    
    <th class="col-sm-1">ID supplier</th>
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
$sql = "SELECT * FROM supplier";
$tampil = mysql_query($sql);
$no=1;
while ($tampilkan = mysql_fetch_array($tampil)) { 

$Kode = $tampilkan['id_supplier'];
?>

	<tr>
	<td><?php echo $tampilkan['id_supplier']; ?></td>	
	<td><?php echo $tampilkan['nama_sup']; ?></td>
	<td><?php echo $tampilkan['telp']; ?></td>
	<td><?php echo $tampilkan['alamat']; ?></td>
  <td><?php echo $tampilkan['cp']; ?></td>
  <td><?php echo $tampilkan['email']; ?></td>

	<td align="center">
	<a class="btn btn-xs btn-info" href="?module=supplier&aksi=edit&id_supplier=<?php echo $tampilkan['id_supplier'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
	<!-- <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=supplier&aksi=hapus&id_supplier=<?php echo $tampilkan['id_supplier'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a> -->
	</td>
	
	<?php
	}
	?>
	</tr>
			</tbody>
		</table>
	</div><!-- /.box-body -->
</div><!-- /.box -->

<!----- ------------------------- END MENAMPILKAN DATA MASTER supplier ------------------------- ----->
<?php 
break;
 case "tambah": 
//ID
$sql ="SELECT max(id_supplier) as terakhir from supplier";
  $hasil = mysql_query($sql);
  $data = mysql_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "SUP".sprintf("%03s",$nextNoUrut);
?>
<!----- ------------------------- TAMBAH DATA MASTER supplier ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Master supplier</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=supplier&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID supplier </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_supplier" value="<?php echo  $nextID; ?>" readonly="yes">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Instansi</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" placeholder="Nama Instansi">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nomor Telp</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="telp" value="+62">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Alamat </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="alamat" placeholder="Alamat">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama supplier</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="cp" placeholder="Nama supplier">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">Email</label>
    <div class="col-sm-5">
      <input type="email" class="form-control" required="required" name="email" >
    </div>
  </div> 

  <div class="form-group">
    <label class="col-sm-4 control-label">  </label>
    <div class="col-sm-5">
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-disk"></i><i> Reset</i></button>
    </div>
  </div> 
</form> 
<!----- ------------------------- END TAMBAH DATA MASTER supplier ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysql_query("select * from supplier where id_supplier='$_GET[id_supplier]'");
$edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA MASTER supplier ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data supplier "<?php echo $_GET['id_supplier']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=supplier&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID supplier </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_supplier" value="<?php echo $edit['id_supplier']; ?>" >
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" placeholder="Nama Instansi" value="<?php echo $edit['nama_sup']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nomor Telp</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="telp" value="<?php echo $edit['telp']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Alamat </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="alamat" placeholder="Alamat" value="<?php echo $edit['alamat']; ?>">
    </div>
  </div>
  
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama supplier</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="cp" placeholder="Nama supplier" value="<?php echo $edit['cp']; ?>">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">Email</label>
    <div class="col-sm-5">
      <input type="email" class="form-control" required="required" name="email" value="<?php echo $edit['email']; ?>" >
    </div>
  </div>  

<div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
	<hr/>
<button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
<a href="?module=supplier">
<button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
    </div>
</div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER supplier ------------------------- ----->
<?php
break;
}
?>