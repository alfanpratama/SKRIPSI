<?php
$aksi="module/pelanggan/pelanggan_aksi.php";


switch($_GET[aksi]){
  default:
  ?>
  <!----- ------------------------- MENAMPILKAN DATA MASTER pelanggan ------------------------- ----->			
  <h3 class="box-title margin text-center">Data Master pelanggan</h3>
  <center> <div class="batas"> </div></center>
  <hr/>
  <div class="box box-solid box-info">
    <div class="box-header">
      <h3 class="btn btn enable box-title">
        <i class="fa fa-map-marker"></i>
      Data Master pelanggan </h3>
      <a class="btn btn-default pull-right"href="?module=pelanggan&aksi=tambah">
        <i class="fa  fa-plus"></i> Tambah Data</a>		
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
             <a class="btn btn-xs btn-info" href="?module=pelanggan&aksi=edit&id_pelanggan=<?php echo $tampilkan['id_pelanggan'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
             <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=pelanggan&aksi=hapus&id_pelanggan=<?php echo $tampilkan['id_pelanggan'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
           </td>
           
           <?php
         }
         ?>
       </tr>
     </tbody>
   </table>
 </div><!-- /.box-body -->
</div><!-- /.box -->

<!----- ------------------------- END MENAMPILKAN DATA MASTER pelanggan ------------------------- ----->
<?php 
break;
case "tambah": 
//ID
$sql ="SELECT max(id_pelanggan) as terakhir from pelanggan";
$hasil = mysql_query($sql);
$data = mysql_fetch_array($hasil);
$lastID = $data['terakhir'];
$lastNoUrut = substr($lastID, 3, 9);
$nextNoUrut = $lastNoUrut + 1;
$nextID = "PEL".sprintf("%03s",$nextNoUrut);
?>
<!----- ------------------------- TAMBAH DATA MASTER pelanggan ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data Master pelanggan</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=pelanggan&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Pelanggan </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_pelanggan" value="<?php echo  $nextID; ?>" readonly="yes">
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
    <label class="col-sm-4 control-label">Nama Pelanggan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="cp" placeholder="Nama Pelanggan">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">Email</label>
    <div class="col-sm-5">
      <input type="email" class="form-control"  name="email" >
    </div>
  </div> 
  <div class="form-group">
    <label class="col-sm-4 control-label">User</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="user" value="<?php echo $_SESSION['nama'];?>" readonly='yes'>
      <input type="hidden" class="form-control" required="required" name="id_user" value="<?php echo $_SESSION['id'];?>" readonly='yes'>
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
<!----- ------------------------- END TAMBAH DATA MASTER pelanggan ------------------------- ----->
<?php	
break;
case "edit" :
$data=mysql_query("select * from pelanggan where id_pelanggan='$_GET[id_pelanggan]'");
$edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA MASTER pelanggan ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data pelanggan "<?php echo $_GET['id_pelanggan']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=pelanggan&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID pelanggan </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_pelanggan" value="<?php echo $edit['id_pelanggan']; ?>" >
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" placeholder="Nama Instansi" value="<?php echo $edit['nama_brg']; ?>">
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
    <label class="col-sm-4 control-label">Nama Pelanggan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="cp" placeholder="Nama Pelanggan" value="<?php echo $edit['cp']; ?>">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">Email</label>
    <div class="col-sm-5">
      <input type="email" class="form-control"  name="email" value="<?php echo $edit['email']; ?>" >
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">User</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="user" value="<?php echo $_SESSION['nama'];?>" readonly='yes'>
    </div>
  </div> 
  <div class="form-group">
    <label class="col-sm-4"></label>
    <div class="col-sm-5">
     <hr/>
     <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
     <a href="?module=pelanggan">
      <button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
    </div>
  </div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER pelanggan ------------------------- ----->
<?php
break;
}
?>