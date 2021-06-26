<?php
include ("../koneksi.php");  ?>
<br/>
<div style="margin-right:10%;margin-left:15%" class="alert alert-info alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h4><i class="icon fa fa-info"></i>
Welcome <?php echo $_SESSION['nama']; ?>! &nbsp;&nbsp;
Anda berada di halaman "<?php echo $_SESSION['level']; ?>"
</h4>
</div>
<!-- <div class="">
<?php 
$data=mysql_query("SELECT * FROM lokasi_krj");
while ($k = mysql_fetch_array($data)) { 
?>

<div class="col-xs-1 text-center">
  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
  <div class="knob-label"><?php echo $k['nm_lokasi']; ?></div>
</div> 
<?php } ?>
</div><!-- /.row -->
<div class="box box-solid box-primary">
<div class="box-header">
<i class="fa fa-info"></i>Informasi
</div>
<div class="box-body">
<h4>Hak Akses sebagai HRD:</h4>
<li>Mengelola data Pegawai</li>
<li>Mengelola data SK Kerja</li>
<li>Mengelola data Prestasi Pegawai</li>
<li>Mengelola data Hukuman Pegawai</li>
</div>
</div><!-- /.row --
