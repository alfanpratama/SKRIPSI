<?php
$aksi="module/barang/barang_aksi.php";


switch($_GET[aksi]){
default:
?>
<!----- ------------------------- MENAMPILKAN DATA MASTER supplier ------------------------- ----->     
<h3 class="box-title margin text-center">Data Barang</h3>
<center> <div class="batas"> </div></center>
<hr/>
  <div class="box box-solid box-info">
    <div class="box-header">
    <h3 class="btn btn enable box-title">
    <i class="fa fa-map-marker"></i>
    Data Barang </h3>
    <a class="btn btn-default pull-right"href="?module=barang&aksi=tambah">
    <i class="fa  fa-plus"></i> Tambah Data</a>   
    </div>    
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
<thead>
  <tr class="text-green">
    
    <th class="col-sm-1">ID Barang</th>
    <th class="col-sm-2">Nama Barang</th>
    <th class="col-sm-1">Kategori Barang</th> 
    <th class="col-sm-1">Harga Barang</th> 
    <th class="col-sm-1">Satuan</th> 
    <th class="col-sm-3">Spesifikasi</th>
    <th class="col-sm-1">Aksi</th>
  </tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM barang ";
$tampil = mysql_query($sql);
$no=1;
while ($tampilkan = mysql_fetch_array($tampil)) { 

$Kode = $tampilkan['id_barang'];
?>

  <tr>
  <td><?php echo $tampilkan['id_barang']; ?></td> 
  <td><?php echo $tampilkan['nama_brg']; ?></td>
  <td><?php echo $tampilkan['id_kategori']; ?></td>
  <td><?php echo $tampilkan['harga']; ?></td>
  <td><?php echo $tampilkan['satuan']; ?></td>
  <td><?php echo $tampilkan['spesifikasi']; ?></td>

  <td align="center">
  <a class="btn btn-xs btn-info" href="?module=barang&aksi=edit&id_barang=<?php echo $tampilkan['id_barang'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
  <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=barang&aksi=hapus&id_barang=<?php echo $tampilkan['id_barang'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>  ?')"> <i class="glyphicon glyphicon-trash"></i></a>
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
$sql ="SELECT max(id_barang) as terakhir from barang";
  $hasil = mysql_query($sql);
  $data = mysql_fetch_array($hasil);
  $lastID = $data['terakhir'];
  $lastNoUrut = substr($lastID, 3, 9);
  $nextNoUrut = $lastNoUrut + 1;
  $nextID = "BRG".sprintf("%03s",$nextNoUrut);
?>
<!----- ------------------------- TAMBAH DATA MASTER supplier ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Barang</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=barang&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Barang </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_barang" value="<?php echo  $nextID; ?>" readonly="yes">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Barang</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_brg" placeholder="Nama Barang">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Kategori</label>
    <div class="col-sm-5">  
      <select name="id_kategori" class="form-control">
      <option value=" "> -- Pilih Kategori Produk -- </option>
      <?php $q = mysql_query ("SELECT * FROM kategori_barang");
        while ($k = mysql_fetch_array($q)){ ?>
        <option value="<?php echo $k['id_kategori']; ?>" 
          <?php (@$h['id_kategori']==$k['id_kategori'])?print(" "):print(""); ?>  > <?php  echo $k['nama_kategori']; ?>
        </option> <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Harga Barang</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="harga" value="Rp.">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">satuan </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="satuan" placeholder="Satuan Barang">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Spesifikasi </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="spesifikasi" placeholder="Spesifikasi Barang">
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
$data=mysql_query("SELECT * FROM barang WHERE id_barang='$_GET[id_barang]'");
$edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA MASTER supplier ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data Barang "<?php echo $_GET['id_barang']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=barang&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Barang </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_barang" value="<?php echo $edit['id_barang']; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Barang</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_brg" placeholder="Nama Barang" value="<?php echo $edit['nama_berg']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Kategori</label>
      <div class="col-sm-5">  
        <select name="id_kategori" class="form-control">
          <?php $q = mysql_query ("select * from kategori_barang");
           while ($k = mysql_fetch_array($q)){ ?>
          <option value="<?php echo $k['id_kategori']; ?>" 
          <?php (@$h['id_kategori']==$k['id_kategori'])?print(" "):print(""); ?>  > <?php  echo $k['nama_kategori']; ?>
          </option> <?php } ?>
        </select>
      </div>
    </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Harga Barang</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="harga" value="<?php echo $edit['harga']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Satuan </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="satuan" placeholder="Satuan Barang" value="<?php echo $edit['satuan']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Spesifikasi</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="spesifikasi" placeholder="Spesifikasi Barang" value="<?php echo $edit['spesifikasi']; ?>">
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