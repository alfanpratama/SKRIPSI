<?php
$aksi="module/user/user_aksi.php";
include "../koneksi.php";

switch($_GET[aksi]){
  default:
  ?>

  <!----- ------------------------- MENAMPILKAN DATA User ------------------------- ----->			
  <h3 class="box-title margin text-center">Data User</h3>
  <center> <div class="batas"> </div></center>
  <hr/>
  <d iv class="box box-solid box-info">
    <div class="box-header">
      <h3 class="btn btn enable box-title">
        <i class="fa  fa-user-secret"></i> 
      Data User </h3>
      <a class="btn btn-default pull-right"href="?module=user&aksi=tambah">
        <i class="fa  fa-plus"></i> Tambah data</a>		
      </div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
        <thead>
         <tr class="text-green">
          <th class="col-sm-1">ID user</th>
          <th>Nama</th>
          <th class="col-sm-2">Username</th>
          <th class="col-sm-2">Level</th> 
          <th class="col-sm-2">No Hp</th> 
          <th class="col-sm-1">Status</th> 
          <th class="col-sm-1">Blokir?</th> 
          <th class="col-sm-1">AKSI</th> 
        </tr>
      </thead>

      <tbody>
        <?php 
// Tampilkan data dari Database
        $sql = "SELECT * FROM user where level<>'gm' ";
        $tampil = mysql_query($sql);
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['id_user'];
          $blokir = $tampilkan['blokir'];?>

          <tr>
           <td><?php echo $tampilkan['id_user']; ?></td>
           <td><?php echo $tampilkan['nama']; ?></td>
           <td><?php echo $tampilkan['user']; ?></td>
           <td><?php echo $tampilkan['level']; ?></td>
           <td><?php echo $tampilkan['no_hp']; ?></td>
           <td><?php if  ( $blokir== 'Y' ) {
            echo "<a class='btn btn-xs btn-warning' disabled >NonAktif</a>";}
            else {echo "<a class='btn btn-xs btn-success' disabled>Aktif</a>"; }   ?></td>
            <td align="center">
             <?php if ( $blokir== 'N' ) { ?>
               <a class="btn btn-xs btn-warning"  data-toggle="tooltip" title="Blokir User??" href="<?php echo $aksi ?>?module=user&aksi=yes&id_user=<?php echo $tampilkan['id_user']; ?>" onclick="return confirm('Apakah anda yakin ingin blokir <?php echo $tampilkan['user']; ?> ?')"><i class="glyphicon glyphicon-ok"></i></a>
             <?php }
             else { ?>
               <a class="btn btn-xs btn-success" data-toggle="tooltip" title="UnBlokir User??" href="<?php echo $aksi ?>?module=user&aksi=no&id_user=<?php echo $tampilkan['id_user']; ?>" onclick="return confirm('Apakah anda yakin UnBlokir <?php echo $tampilkan['user']; ?>?')"><i class="glyphicon glyphicon-remove"></i></a>

             <?php } ?>
           </td>
           <td align="center"><a class="btn btn-xs btn-info" href="?module=user&aksi=edit&id_user=<?php echo $tampilkan['id_user'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
           <!--  <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=user&aksi=hapus&id_user=<?php echo $tampilkan['id_user'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?> ?')"> <i class="glyphicon glyphicon-trash"></i></a> -->
          </td>
          <?php
        }
        ?>
      </tr>
    </tbody>
  </table>
</div><!-- /.box-body -->
</div><!-- /.box -->

<!----- ------------------------- END MENAMPILKAN DATA User ------------------------- ----->
<?php 
break;
case "tambah": 
//ID
$sql ="SELECT max(id_user) as terakhir from user";
$hasil = mysql_query($sql);
$data = mysql_fetch_array($hasil);
$lastID = $data['terakhir'];
$lastNoUrut = substr($lastID, 3, 9);
$nextNoUrut = $lastNoUrut + 1;
$nextID = "USR".sprintf("%03s",$nextNoUrut);
?>
<!----- ------------------------- TAMBAH DATA User ------------------------- ----->
<h3 class="box-title margin text-center">Tambah Data User</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=user&aksi=tambah" role="form" method="post">             
  <div class="form-group">
    <label class="col-sm-4 control-label">ID user </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_user" value="<?php echo  $nextID; ?>" readonly="yes">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" placeholder="Nama user">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nomor HP</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="no_hp" value="+62">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Level </label>
    <div class="col-sm-5">
      <select name="level" class="form-control">
        <option value=" "> -- Pilih Level -- </option>
        <option value="admin">Sales</option>
        <option value="hrd">Support Marketing</option>
        <option value="gm">Manager Marketing</option>
      </select>
    </div>
  </div>
  <hr/>
  <div class="form-group">
    <label class="col-sm-4 control-label">Username</label>
    <div class="col-sm-5">
      <input type="email" class="form-control" required="required" name="user" placeholder="username">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" required="required" name="pass" value="12345">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">  </label>
    <div class="col-sm-5">
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
      <button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-disk"></i><i>Reset</i></button>
    </div>
  </div> 
</form> 
<!----- ------------------------- END TAMBAH DATA User ------------------------- ----->
<?php 
break;
case "edit": 
//ID
$data=mysql_query("select * from user where id_user='$_GET[id_user]'");
$edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA User ------------------------- ----->
<h3 class="box-title margin text-center">Edit Data User "<?php echo $_GET['id_user']; ?>"</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=user&aksi=edit" role="form" method="post">             
  <div class="form-group">
    <label class="col-sm-4 control-label">ID user </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_user" value="<?php echo  $edit ['id_user']; ?>" readonly="yes">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" placeholder="Nama user" value="<?php echo  $edit ['nama']; ?>" >
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nomor HP</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="no_hp"value="<?php echo  $edit ['no_hp']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Level </label>
    <div class="col-sm-5">
      <select name="level" class="form-control">
        <option value=" "> -- Pilih Level -- </option>
        <option value="admin">Sales</option>
        <option value="hrd">Support Marketing</option>
        <option value="gm">Manager Marketing</option>
      </select>
    </div>
  </div>
  <hr/>
  <div class="form-group">
    <label class="col-sm-4 control-label">Username</label>
    <div class="col-sm-5">
      <input type="email" class="form-control" required="required" name="user" placeholder="username" value="<?php echo  $edit ['user']; ?>">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">Password</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" required="required" name="pass" value="<?php echo  $edit ['pass']; ?>">
    </div>
  </div>  
  <div class="form-group">
    <label class="col-sm-4 control-label">  </label>
    <div class="col-sm-5">
      <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
      <button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-disk"></i><i>Reset</i></button>
    </div>
  </div> 
</form> 
<!----- ------------------------- END EDIT DATA User ------------------------- ----->
<?php	
break;
}
?>
