<?php
$aksi="module/mengelola_pengajuan/aksi_mengelola_pengajuan.php";

switch($_GET[aksi]){
  default:
  ?>
  <!----- ------------------------- MENAMPILKAN DATA MASTER divisi ------------------------- ----->			
  <h3 class="box-title margin text-center">Data Pengajuan Barang</h3>
  <center> <div class="batas"> </div></center>
  <hr/>
  <div class="box box-solid box-info">
    <div class="box-header">
      <h3 class="btn btn enable box-title">
        <i class="fa fa-map-marker"></i>
      Data Pengajuan Barang</h3>		
      </div>		
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
        <thead>
         <tr class="text-green">
          <th class="col-sm-2">Nomer Surat</th>
          <th class="col-sm-1">Nama Divisi</th>
          <th class="col-sm-2">Nama Pemohon</th>
          <th class="col-sm-1">Aksi</th>
        </tr>
      </thead>

      <tbody>
        <?php 
        $sql=("SELECT pengajuan_pengadaan_brg.no_surat_pengadaan,divisi.nama_divisi,user.nama FROM pengajuan_pengadaan_brg INNER JOIN divisi ON pengajuan_pengadaan_brg.id_divisi=divisi.id_divisi INNER JOIN user ON pengajuan_pengadaan_brg.id_user=user.id_user");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['no_surat_pengadaan'];
          ?>

          <tr>
           <td><?php echo $tampilkan['no_surat_pengadaan']; ?></td>
           <td><?php echo $tampilkan['nama_divisi']; ?></td>	
           <td><?php echo $tampilkan['nama']; ?></td>

           <td align="center">
             <a class="btn btn-xs btn-info" href="?module=mengelola_pengajuan&aksi=tinjau&no_surat_pengadaan=<?php echo $tampilkan['no_surat'];?>" alt="Tinjau Surat"><i class="glyphicon glyphicon-file"></i></a>
             <a class="btn btn-xs btn-primary" href="?module=mengelola_pengajuan&aksi=acc&no_surat_pengadaan=<?php echo $tampilkan['no_surat'];?>" alt="Disetuji"><i class="glyphicon glyphicon-ok-circle"></i></a>
             <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=mengelola_pengajuan&aksi=tolak&no_surat_pengadaan=<?php echo $tampilkan['no_surat'];?>"  alt="Ditolak" onclick="return confirm('ANDA YAKIN AKAN MENOLAK PENGAJUAN <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-remove-circle"></i></a>
           </td>
           
           <?php
         }
         ?>
       </tr>
     </tbody>
   </table>
 </div><!-- /.box-body -->
</div><!-- /.box -->

<!----- ------------------------- END MENAMPILKAN DATA MASTER PENGAJUAN------------------------- ----->
<?php	
break;
case "tinjau" :
$data=mysql_query("select * from pengajuan where no_surat='$_GET[no_surat]'");
$edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA MASTER divisi ------------------------- ----->
<h3 class="box-title margin text-center">Tinjau Surat Pengajuan "<?php echo $_GET['no_surat']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=mengelola_pengajuan&aksi=tinjau" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">No Surat </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="no_surat" value="<?php echo $edit['no_surat']; ?>" >
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">ID Divisi</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_divisi" placeholder="ID Divisi" value="<?php echo $edit['id_divisi']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Divisi</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_divisi" value="<?php echo $edit['nama_divisi']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Pemohon</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama_pemohon" value="<?php echo $edit['nama_pemohon']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">No.Telpon </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="telp" placeholder="No.Telpon" value="<?php echo $edit['telp']; ?>">
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
     <a href="?module=divisi">
      <button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
    </div>
  </div>

</form>
</div>
</div>
<!----- ------------------------- END EDIT DATA MASTER divisi ------------------------- ----->
<?php
break;
}
?>