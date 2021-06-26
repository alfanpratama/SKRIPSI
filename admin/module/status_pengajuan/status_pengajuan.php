
  <!----- ------------------------- MENAMPILKAN DATA MASTER divisi ------------------------- ----->			
  <h3 class="box-title margin text-center">Status Pengajuan Barang</h3>
  <center> <div class="batas"> </div></center>
  <hr/>
  <div class="box box-solid box-info">
    <div class="box-header">
      <h3 class="btn btn enable box-title">
        <i class="fa fa-map-marker"></i>
      Status Pengajuan Barang</h3>		
      </div>
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
        <thead>
         <tr class="text-green">          
          <th class="col-sm-2">Nomer Surat</th>
          <th class="col-sm-1">ID Divisi</th>
          <th class="col-sm-3">Nama Divisi</th>
          <th class="col-sm-2">ID User</th>
          <th class="col-sm-3">Nama Pemohon</th>
          <th class="col-sm-2">BAUK</th> 
          <th class="col-sm-2">KETUA</th> 
          <th class="col-sm-1">YAYASAN</th>
          <th class="col-sm-2">Tinjau</th>
        </tr>
      </thead>

      <tbody>
        <?php 
// Tampilkan data dari Database
        $sql = "SELECT * FROM cek_status";
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['id'];
          ?>

          <tr>
           <td><?php echo $tampilkan['no_surat']; ?></td>
           <td><?php echo $tampilkan['id_divisi']; ?></td>	
           <td><?php echo $tampilkan['nama_divisi']; ?></td>
           <td><?php echo $tampilkan['id_user']; ?></td>
           <td><?php echo $tampilkan['nama_pemohon']; ?></td>
           <td><?php echo $tampilkan['bauk']; ?></td>
           <td><?php echo $tampilkan['ketua']; ?></td>
           <td><?php echo $tampilkan['yayasan']; ?></td>
           <td align="center">
               <a class="btn btn-xs btn-warning" href="?module=cek_penawaran&aksi=lanjut&no_surat=<?php echo $tampilkan['no_surat'];?>" alt="Edit Data"><i class="glyphicon glyphicon-download"></i></a>
             </td>
           <?php
         }
         ?>
       </tr>
     </tbody>
   </table>
 </div><!-- /.box-body -->
</div><!-- /.box -->