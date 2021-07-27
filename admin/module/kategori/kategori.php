<?php
$aksi="module/kategori/kategori_aksi.php";


switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER supplier ------------------------- ----->     
<h3 class="box-title margin text-center">Data Kategori Barang</h3>
<center> <div class="batas"> </div></center>
<hr/>
  <div class="box box-solid box-info">
    <div class="box-header">
    <h3 class="btn btn enable box-title">
    <i class="fa fa-map-marker"></i>
    Data Kategori Barang </h3>
    <a class="btn btn-default pull-right"href="?module=kategori&aksi=tambah">
    <i class="fa  fa-plus"></i> Tambah Data</a>   
    </div>    
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
  <tr class="text-green">
    
    <th class="col-sm-1">ID Kategori</th>
    <th class="col-sm-2">Nama Kategori</th>
    <th class="col-sm-1">Aksi</th>
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
  <td><?php echo $tampilkan['id_kategori']; ?></td> 
  <td><?php echo $tampilkan['nama_kategori']; ?></td>

  <td align="center">
  <a class="btn btn-xs btn-info" href="?module=kategori&aksi=edit&id_kategori=<?php echo $tampilkan['id_kategori'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
  <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=kategori&aksi=hapus&id_kategori=<?php echo $tampilkan['id_kategori'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>  ?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
$sql ="SELECT max(id_kategori) as terakhir from kategori_barang";
  $hasil = mysql_query($sql);
  $data = mysql_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "KB".sprintf("%03s",$nextNoUrut);
?>
<!----- ------------------------- TAMBAH DATA MASTER supplier ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Kategori Barang</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=kategori&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Kategori </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_kategori" value="<?php echo  $nextID; ?>" readonly="yes">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Kategori Barang</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_kategori" placeholder="Nama Kategori Barang">
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
$data=mysql_query("SELECT * FROM kategori_barang WHERE id_kategori='$_GET[id_kategori]'");
$edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA MASTER supplier ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data Kategori Barang "<?php echo $_GET['id_kategori']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=kategori&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Kategori </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_kategori" value="<?php echo $edit['id_kategori']; ?>" >
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Kategori Barang</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_kategori" placeholder="Nama Kategori" value="<?php echo $edit['nama_kategori']; ?>">
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