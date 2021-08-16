<?php 
include "head.php";
?>
<?php 
        $sql=("SELECT pengajuan_brg.tgl,pengajuan_brg.no_surat_pengajuan,pengajuan_brg.perihal,user.nama,divisi.nama_divisi,pengajuan_brg.tgl,detail_pengajuan.id_barang,barang.nama_brg,detail_pengajuan.jml_brg,user.nama FROM pengajuan_brg INNER JOIN user ON pengajuan_brg.id_user=user.id_user INNER JOIN divisi ON pengajuan_brg.id_divisi=divisi.id_divisi INNER JOIN detail_pengajuan ON pengajuan_brg.no_surat_pengajuan=detail_pengajuan.no_surat_pengajuan INNER JOIN barang ON detail_pengajuan.id_barang=barang.id_barang WHERE pengajuan_brg.no_surat_pengajuan='$_GET[no_surat_pengajuan]'");
// Tampilkan data dari Database
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 
          $Kode = $tampilkan['no_surat_pengajuan'];
          ?>
          <section class="content-header">
            <h1>
             Surat Pengajuan Barang
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"> Surat Pengajuan Barang</a></li>
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
                <h4 class="box-title center">Nomor Surat 	: <?php echo $tampilkan['no_surat_pengajuan']; ?></h4><br>
                <h4 class="box-title center">Lampiran 		: -</h4><br>
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
			<span class="pull-right"><h4>
				BAUK</h4>
				<br><br><br><br>
				<h4 class="box-title center">Dewi Lokayati S.Kom</h4>			 
				</span>
				<h4 class="box-title center">Pemohon</h4><br><br><br><br>
				<h4 class="box-title center"><?php echo $tampilkan['nama']; ?></h4><br>
				<h4 class="box-title center">NIK :</h4>
         	</div><!-- /.box-body -->
        </div>
<?php
}
?>
          </section><!-- /.content -->
<?php
include "tail.php";
?>