<h3 class="box-title margin text-center">Cek Status Pengadaan Barang</h3>
  <center> <div class="batas"> </div></center>
  <hr/>
  <div class="box box-solid box-info">
    <div class="box-header">
      <h3 class="btn btn enable box-title">
        <i class="fa fa-map-marker"></i>
      Cek Status Pengadaan Barang</h3>    
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

              <form class="form-horizontal" action="module/mengelola_pengadaan/pengadaan.php" method="get">
              <input type="hidden" name="no_surat_pengadaan" value="<?php echo $tampilkan['no_surat_pengadaan']; ?>">             
              <button type="submit"name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-search"></i>&nbsp;</button> 
              </form>
              </td>
           
           <?php
         }
         ?>
       </tr>
     </tbody>
   </table>
 </div><!-- /.box-body -->
</div><!-- /.box -->
