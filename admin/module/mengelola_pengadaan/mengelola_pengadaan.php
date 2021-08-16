<?php
$aksi="module/mengelola_pengadaan/aksi_mengelola_pengadaan.php";

switch($_GET[aksi]){
  default:
  ?>
  <!----- ------------------------- MENAMPILKAN DATA MASTER divisi ------------------------- ----->     
  <h3 class="box-title margin text-center">Data Pengadaan Barang</h3>
  <center> <div class="batas"> </div></center>
  <hr/>
  <div class="box box-solid box-info">
    <div class="box-header">
      <h3 class="btn btn enable box-title">
        <i class="fa fa-map-marker"></i>
      Data Pengadaan Barang</h3>    
      </div>    
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
        <thead>
         <tr class="text-green">
          <th class="col-sm-2">Nomer Surat</th>
          <th class="col-sm-1">Nama Divisi</th>
          <th class="col-sm-2">Nama Pemohon</th>
          <th class="col-sm-1">Tanggal</th>
          <th class="col-sm-1">Status</th>
          <th class="col-sm-1">Aksi</th>
        </tr> 
      </thead>

      <tbody>
        <?php 
        $sql=("SELECT pengajuan_pengadaan_brg.no_surat_pengadaan,divisi.nama_divisi,user.nama,pengajuan_pengadaan_brg.tgl,pengajuan_pengadaan_brg.acc FROM pengajuan_pengadaan_brg INNER JOIN divisi ON pengajuan_pengadaan_brg.id_divisi=divisi.id_divisi INNER JOIN user ON pengajuan_pengadaan_brg.id_user=user.id_user");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['no_surat_pengadaan'];
          $acc = $tampilkan['acc'];
          ?>

          <tr>
           <td><?php echo $tampilkan['no_surat_pengadaan']; ?></td>
           <td><?php echo $tampilkan['nama_divisi']; ?></td>  
           <td><?php echo $tampilkan['nama']; ?></td>
           <td><?php echo $tampilkan['tgl']; ?></td>
           <td><?php if  ( $acc== 'X' ) {
            echo "<a class='btn btn-xs btn-warning' disabled >Ditinjau</a>";
            }
            else if ($acc== 'Y') {
            echo "<a class='btn btn-xs btn-success' disabled>Disetujui</a>";
            }
            else if ($acc== 'N') {
            echo "<a class='btn btn-xs btn-danger' disabled >Ditolak</a>"; 
            }   ?></td>
           <td align="center">

              <form class="form-horizontal" action="module/mengelola_pengadaan/pengajuan_pengadaan.php" method="get">
              <input type="hidden" name="no_surat_pengadaan" value="<?php echo $tampilkan['no_surat_pengadaan']; ?>">             
              <button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-search"></i></button> 
              </form>
              <!-- <a class="btn btn-xs btn-info" href="module/mengelola_pengajuan/pengajuan.php&no_surat_pengadaan=<?php echo $tampilkan['no_surat_pengadaan'];?>" target="_blank" alt="Tinjau Data"><i class="glyphicon glyphicon-pencil"></i></a> -->
               <a class="btn btn-xs btn-success"  data-toggle="tooltip" title="Menyetujui Pengadaan??" href="<?php echo $aksi ?>?module=mengelola_pengadaan&aksi=Disetujui&no_surat_pengadaan=<?php echo $tampilkan['no_surat_pengadaan']; ?>" onclick="return confirm('Apakah anda yakin menyetujui pengadaan <?php echo $tampilkan['no_surat_pengadaan']; ?> ?')"><i class="glyphicon glyphicon-ok"></i></a>
               <a class="btn btn-xs btn-danger" data-toggle="tooltip" title="Menolak Pengadaan??" href="<?php echo $aksi ?>?module=mengelola_pengadaan&aksi=Ditolak&no_surat_pengadaan=<?php echo $tampilkan['no_surat_pengadaan']; ?>" onclick="return confirm('Apakah anda yakin Menolak Pengadaan <?php echo $tampilkan['no_surat_pengadaan']; ?>?')"><i class="glyphicon glyphicon-remove"></i></a>
             <a class="btn btn-xs btn-info" href="?module=mengelola_pengadaan&aksi=edit&no_surat_pengadaan=<?php echo $tampilkan['no_surat_pengadaan'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
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
case "tinjau": 

include 'pengadaan.php';
?>



<?php 
break;
case "edit": 
//ID
$data=mysql_query("SELECT * FROM pengajuan_pengadaan_brg where no_surat_pengadaan='$_GET[no_surat_pengadaan]'");
$edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA User ------------------------- ----->
<h3 class="box-title margin text-center">Tambahkan Catatan Pengadaan "<?php echo $_GET['no_surat_pengadaan']; ?>"</h3>
<center> <div class="batas"> </div></center>
<hr/>

<form class="form-horizontal" action="<?php echo $aksi?>?module=mengelola_pengadaan&aksi=edit" role="form" method="post">             
  <div class="form-group">
    <label class="col-sm-4 control-label">No Surat Pengadaan </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="no_surat_pengadaan" value="<?php echo  $edit ['no_surat_pengadaan']; ?>" readonly="yes">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Catatan</label>
    <div class="col-sm-5">
      <textarea type="text" class="form-control" required="required" name="catatan" placeholder="Isi Catatan" value="<?php echo  $edit ['catatan']; ?>" >
      </textarea>
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
