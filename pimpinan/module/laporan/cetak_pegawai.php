<?php 
include "head.php";
?>
          <section class="content-header">
            <h1>
             Laporan
              <small>Data Pegawai</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Laporan</a></li>
              <li class="active">Data Pegawai</li>
            </ol>
          </section>

           
          <section class="content">
            <div class="text-center">
			<h3><img src="inc/zt.png"/></h3>
			<b>Jalan Srikandi, Komp Ruko Wadya Graha II No. 7 - 8 Panam <br/>
			Pekanbaru, RIAU</b>
			</div><br/>
             
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title center">Daftar Pegawai</h3>
				<span class="pull-right">
				Pekanbaru, <?php echo Indonesia2Tgl(date('Y-m-d'));?> 
				</span>					
              </div>
              <div class="box-body">
<table class="table table-bordered table-striped">
<thead>
	<tr class="text-black">
		<th class="col-xs-1">No</th>
		<th class="col-sm-1">NIP</th>
		<th class="col-sm-3">Nama pegawai</th>
		<th class="col-sm-1">JK</th> 
		<th>Tempat/Tgl. Lahir</th> 
		<th class="col-sm-1">No. HP</th> 
		<th class="col-sm-1">Email</th>
		<th class="col-sm-1">Tgl. Masuk</th>		
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database
$sql = "SELECT * FROM pegawai";
$tampil = mysql_query($sql);
$no=1;
while ($data = mysql_fetch_array($tampil)) { ?>

	<tr>
	<td><?php echo $no++; ?></td>
	<td><?php echo $data['nip']; ?></td>
	<td><?php echo $data['nm_pegawai']; ?></td>
	<td><?php echo $data['jk']; ?></td>
	<td><?php echo $data['tpt_lhr'] .", ". IndonesiaTgl($data['tgl_lhr']); ?></td>
	<td><?php echo $data['no_hp']; ?></td>
	<td><?php echo $data['email']; ?></td>	
	<td><?php echo IndonesiaTgl($data['tgl_msk']); ?></td>
<?php
}
?>
	</tr>
			</tbody>
		</table>	
              </div><!-- /.box-body -->
            </div>
          </section><!-- /.content -->
<?php
include "tail.php";
?>