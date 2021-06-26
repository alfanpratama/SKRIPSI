 <?php 
include "head.php";
$kode=$_POST['no_surat'];
$left=substr($kode,0,3);

?>
          <section class="content-header">
            <h1>
             Surat Penawaran
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Data </a></li>
              <li class="active">Surat Penawaran</li>
            </ol>
          </section>

           
          <section class="content">
            <div class="text-center">
			<h3><img src="inc/kopsurat.jpg" width="100%" /></h3>
			<!--<b>Jalan Srikandi, Komp Ruko Wadya Graha II No. 7 - 8 Panam <br/>
			Pekanbaru, RIAU</b>-->
			</div><br/>

            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title center"><?php echo "No. "; echo $kode; ?></h3>
				<span class="pull-right"> 
				Bandung, <?php echo Indonesia2Tgl(date('Y-m-d'));?> 
				</span>					
              </div>
              <div class="box-body">
<table class="table table-bordered table-striped">
<thead>
	<tr class="text-black">
		<th class="col-xs-1">No</th>
		<th class="col-sm-3">Nama Barang</th>
		<th class="col-sm-3">Spesifikasi</th>
		<th class="col-sm-2">Status Barang</th> 
		<th class="col-sm-1">Qty</th> 
		<th class="col-sm-1">Harga Satuan</th> 
		<th class="col-sm-1">PPN</th>
		<th class="col-sm-1">Jumlah</th>		
	</tr>
</thead>

<tbody>
<?php 
// Tampilkan data dari Database

$kode=$_POST['no_surat'];

$sql = "SELECT *  FROM detail_pesanan where no_surat like $kode ";
$tampil = mysql_query($sql);
$no=1;

while ($data = mysql_fetch_array($tampil)) {

 ?>

	<tr>
	<td><?php echo $no++; ?></td>
	<td><?php echo $data['no_surat'];; ?></td>
	<td><?php echo $data['nama']; ?></td>
	<td><?php echo $data['spesifikasi']; ?></td>
	<td><?php echo $data['status_barang']; ?></td>
	<td><?php echo $data['qty']; ?></td>
	<td><?php echo $data['harga_jual']; ?></td>	
	<td><?php echo $data['ppn']; ?></td>
	<td><?php echo $data['subtotal']; ?></td>
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