<?php 
include "head.php";
?>
<?php 
        $sql=("SELECT pengajuan_pengadaan_brg.tgl,pengajuan_pengadaan_brg.no_surat_pengadaan,pengajuan_pengadaan_brg.perihal,user.nama,divisi.nama_divisi,pengajuan_pengadaan_brg.tgl,detail_pengadaan.id_barang,barang.nama_brg,detail_pengadaan.jml_brg,user.nama FROM pengajuan_pengadaan_brg INNER JOIN user ON pengajuan_pengadaan_brg.id_user=user.id_user INNER JOIN divisi ON pengajuan_pengadaan_brg.id_divisi=divisi.id_divisi INNER JOIN detail_pengadaan ON pengajuan_pengadaan_brg.no_surat_pengadaan=detail_pengadaan.no_surat_pengadaan INNER JOIN barang ON detail_pengadaan.id_barang=barang.id_barang WHERE pengajuan_pengadaan_brg.no_surat_pengadaan='$_GET[no_surat_pengadaan]'");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['no_surat_pengadaan'];
          ?>
          <section class="content-header">
            <h1>
             Surat Pengajuan Pengadaan Barang
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"> Surat Pengajuan Pengadaan Barang</a></li>
            </ol>
          </section>

           
          <section class="content">
          	
            <div class="text-center">
			<h3><img src="inc/kop.png"/></h3>
			</div><br/>
            <div class="box box-default">
              <div class="box-header with-border">
              	<br>
              	<span class="pull-right"><h4>
				Bandung, <?php echo $tampilkan['tgl']; ?></h4> 
				</span>
              	<br>
                <h4 class="box-title center">Nomor Surat : <?php echo $tampilkan['no_surat_pengadaan']; ?></h4><br>
				<h4 class="box-title center">Hal			: Pengajuan Barang</h4>
				<br>
				<br>
				<h4 class="box-title center">Kepada Yth Bapa/Ibu Pimpinan </h4><br>
				<h4 class="box-title center">di</h4><br>
				<h4 class="box-title center">Tempat</h4>
				<br>
				<br>
				<h4 class="box-title center">Dengan Hormat</h4><br><br>
              	<h4 class="box-title center"><?php echo $tampilkan['perihal']; ?> maka dengan ini saya : </h4><br><br>
              	<h4 class="box-title center">Nama 		 	: <?php echo $tampilkan['nama']; ?></h4><br>
                <h4 class="box-title center">Divisi 		: <?php echo $tampilkan['nama_divisi']; ?></h4><br><br>
              	<h4 class="box-title center">memohon kepada  Bapa/Ibu Pimpinan untuk menyetujui pengjuan barang barang tersebut dengan data barang sebagai berikut :</h4>
              	</div>
              <div class="box-body">
         <?php
     ?>
<table class="table table-bordered table-bordered">
	<thead>

		<tr class="text-black">
			<th class="col-xs-1">No</th>
			<th class="col-sm-1">Id Barang</th>
			<th class="col-sm-3">Nama Barang</th>
			<th class="col-sm-1">Jumlah Barang</th>		
		</tr>
	</thead>
	<tbody class="table table-striped">
        <tr>
           <td><?php echo $no++; ?></td>
           <td><?php echo $tampilkan['id_barang']; ?></td>
           <td><?php echo $tampilkan['nama_brg']; ?></td>	
           <td><?php echo $tampilkan['jml_brg']; ?></td>
        </tr>
	</tbody>
</table>	
<br><br> <div class="box-header with-border">
  <span class="pull-left">
        <h4 class="box-title center">Pemohon</h4><br><br><br><br>
        <h4 class="box-title center"><?php echo $tampilkan['nama']; ?></h4><br>
        <h4 class="box-title center">NIK :</h4>
      </span>
  <span class="pull-center">
        <h4 class="box-title center">Pimpinan</h4>
        <br><br><br><br>
        <h4 class="box-title center">Dr Marjito M.Pd</h4><br>
        <h4 class="box-title center">NIK :</h4>
        </span>
			<span class="pull-right">
        <h4 class="box-title center">Yayasan</h4>
        <br><br><br><br>
        <h4 class="box-title center">(........)</h4><br>
        <h4 class="box-title center">NIK :</h4>
				</span>

         	</div><!-- /.box-body -->
        </div>
<?php
}
?>
          </section><!-- /.content -->
<?php
include "tail.php";
?>