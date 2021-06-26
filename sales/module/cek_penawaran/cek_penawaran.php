<script>
  function startCalc(){
    interval = setInterval("calc()",1);}
    function calc(){
      a = document.f1.qty.value;
      b = document.f1.harga_jual.value;
      c = document.f1.diskon.value;
      d = document.f1.subtotal.value;
      document.f1.subtotal.value = (((a*1)*(b*1))-c);
      document.f1.ppn.value = (((d*1)*10)/100);

    }
    function stopCalc(){
      clearInterval(interval);} 
    </script>
    <?php
    $aksi="module/cek_penawaran/cek_penawaran.php";
    $aksi2="module/cek_penawaran/cek_aksi.php";
    $aksi3="module/cek_penawaran/cobapdf/cetak_penawaran.php";

    switch($_GET[aksi]){
      default:
      ?>
      <!----- ------------------------- MENAMPILKAN DATA MASTER barang ------------------------- ----->     
      <h3 class="box-title margin text-center">Data Master Penawaran</h3>
      <center> <div class="batas"> </div></center>
      <hr/>
      <div class="box box-solid box-info">
        <div class="box-header">
          <h3 class="btn btn enable box-title">
            <i class="fa fa-clipboard "></i>
          Data Master Penawaran </h3>

        </div>    
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
          <thead>
           <tr class="text-green">

            <th class="col-sm-2">No. Surat</th>
            <th class="col-sm-1">ID Pelanggan</th>
            <th class="col-sm-3">Nama Pelanggan</th>
            <th class="col-sm-2">Tanggal Prospek</th> 
            <th class="col-sm-1" >Lihat Data</th>
            <th class="col-sm-1">Cetak</th>
          </tr>
        </thead>

        <tbody>
          <?php 
// Tampilkan data dari Database
          $id_user=$_SESSION[id];
          $sql = "SELECT pesanan.no_surat,pesanan.id_pelanggan,pesanan.tgl_prospek,pelanggan.id_pelanggan, pelanggan.nama_pel, pesanan.id_user FROM pesanan INNER JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id_pelanggan  ";
          $tampil = mysql_query($sql);
          $no=1;
          while ($tampilkan = mysql_fetch_array($tampil)) { 

            $Kode = $tampilkan['no_surat'];
            $Kode2 = $tampilkan['id_pelanggan'];


            ?>

            <tr>
              
         <form class="form-horizontal" action="module/cek_penawaran/cobapdf/cetak_penawaran.php" role="form" method="get">      
             <td><?php echo $tampilkan['no_surat'];?><input type="hidden" name="no_surat" value="<?php echo $tampilkan['no_surat'];?>"></td>  
             <td><?php echo $tampilkan['id_pelanggan']; ?></td>
             <td><?php echo $tampilkan['nama_pel']; ?></td>
             <td><?php echo $tampilkan['tgl_prospek']; ?></td>

  
             <td align="center">
               <a class="btn btn-xs btn-warning" href="?module=cek_penawaran&aksi=lanjut&no_surat=<?php echo $tampilkan['no_surat'];?>" alt="Edit Data"><i class="glyphicon glyphicon-folder-open"></i></a>
             </td>

             <td align="center">
      <!--       <a class="btn btn-xs btn-info" href="?module=cek_penawaran&aksi=cetak&no_surat=<?php echo $tampilkan['no_surat'];?>" alt="Cetak Penawaran"><i class="glyphicon glyphicon-print"></i></a> -->
<button type="submit" name="submit" onclick="this.form.target='_blank';return true;" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-print"></i>&nbsp;Cetak</button>
             </td>
           </form>
             <?php
           }
           ?>
         </tr>
       </tbody>
     </table>
   </div><!-- /.box-body -->
 </div><!-- /.box -->

 <!----- ------------------------- END MENAMPILKAN DATA MASTER barang ------------------------- ----->
 <?php 
 break;
 case "tambah": 
//ID
 $sql ="SELECT max(id_barang) as terakhir from barang";
 $hasil = mysql_query($sql);
 $data = mysql_fetch_array($hasil);
 $lastID = $data['terakhir'];
 $lastNoUrut = substr($lastID, 3, 9);
 $nextNoUrut = $lastNoUrut + 1;
 $nextID = "BRG".sprintf("%03s",$nextNoUrut);
 ?>
 <!----- ------------------------- TAMBAH DATA MASTER barang ------------------------- ----->
 <h3 class="box-title margin text-center">Tambah Data Master barang</h3>
 <center> <div class="batas"> </div></center>
 <hr/>

 <form class="form-horizontal" action="<?php echo $aksi?>?module=barang&aksi=tambah" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID barang </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="id_barang" value="<?php echo  $nextID; ?>" readonly="yes">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Barang</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" placeholder="Nama Barang">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Kategori</label>
    <div class="col-sm-5">  
      <select name="id_kategori" class="form-control">
        <option value=" "> -- Pilih Kategori Produk -- </option>
        <?php $q = mysql_query ("select * from kategori_barang");
        while ($k = mysql_fetch_array($q)){ ?>
          <option value="<?php echo $k['nama_kategori']; ?>" 
            <?php (@$h['id_kategori']==$k['id_kategori'])?print(" "):print(""); ?>  > <?php  echo $k['nama_kategori']; ?>
            </option> <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">Satuan </label>
        <div class="col-sm-5">
          <input type="text" class="form-control"  name="satuan" placeholder="Satuan">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label">Kode Produk</label>
        <div class="col-sm-5">
          <input type="text" class="form-control"  name="kode_produk" placeholder="Kode Produk">
        </div>
      </div>  
      <div class="form-group">
        <label class="col-sm-4 control-label">Spesifikasi</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="spesifikasi" >
        </div>
      </div> 

      <div class="form-group">
        <label class="col-sm-4 control-label">  </label>
        <div class="col-sm-5">
          <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
          <button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-floppy-disk"></i><i> Reset</i></button>
        </div>
      </div> 
    </form> 
    <!----- ------------------------- END TAMBAH DATA MASTER barang ------------------------- ----->
    <?php 
    break;
    case "edit" :
    $data=mysql_query("select * from detail_pesanan where id_barang='$_GET[id_barang]'");
    $tambah=mysql_fetch_array($data);
    ?>
    <h3 class="box-title margin text-center">Edit Data Barang "<?php echo $_GET['id_barang'];  ?>" No. Surat "<?php echo $_GET['no_surat'];  ?>"</h3>

    <br/>
    <form class="form-horizontal" action="<?php echo $aksi2?>?module=cek_penawaran&aksi=edit" role="form" method="post" name="f1">      

      <div class="form-group">
        <label class="col-sm-4 control-label">Nama Barang </label>
        <div class="col-sm-5">
          <input type="hidden" class="form-control" readonly name="id_barang" value="<?php echo $tambah['id_barang']; ?>" >
          <input type="text" class="form-control" readonly name="nama" value="<?php echo $tambah['nama_barang']; ?>" >

        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">Spesifikasi</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" required="required" name="spesifikasi" value="<?php echo $tambah['spesifikasi']; ?>" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">Qty</label>
        <div class="col-sm-5">
          <input type="number" class="form-control" required="required" name="qty" onFocus="startCalc();" onBlur="stopCalc();" value="<?php echo $tambah['qty']; ?>">
        </div>
      </div>
      <div class="form-group">

        <div class="col-sm-5">
          <input type="hidden" readonly class="form-control" required="required" name="harga_beli" value="<?php echo $tambah['harga_beli']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label">Harga Jual</label>
        <div class="col-sm-5">
          <input type="number" readonly class="form-control" required="required" name="harga_jual" value="<?php echo $tambah['harga_jual']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">Diskon</label>
        <div class="col-sm-5">
          <input type="number" readonly class="form-control" name="diskon" value="<?php echo $tambah['diskon']; ?>" onFocus="startCalc();" onBlur="stopCalc();">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">Subtotal</label>
        <div class="col-sm-5">
          <input type="number" readonly class="form-control" readonly required="required" name="subtotal" value="<?php echo $tambah['subtotal']; ?>" onchange="tryNumberFormat(this.form.thirdBox);">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">PPN</label>
        <div class="col-sm-5">
          <input type="number" readonly class="form-control"  name="ppn" value="<?php echo $tambah['ppn']; ?>" onchange="tryNumberFormat(this.form.thirdBox);">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">Status Barang</label>
        <div class="col-sm-5">
          <select class="form-control" name="status_barang" readonly >
            <option value="<?php echo $tambah['status_barang']; ?>"></option>
            
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4"></label>
        <div class="col-sm-5">
          <hr/>
          <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
          <a href="?module=cek_penawaran">
            <button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
          </div>
        </div>

      </form>  <!----- ------------------------- END EDIT DATA MASTER jabatan ------------------------- ----->

      <?php
      break;
      case "lanjut";
      $data=mysql_query("select * from detail_pesanan where no_surat='$_GET[no_surat]'");
      $edit=mysql_fetch_array($data);
      ?>
      <!----- ------------------------- module/cek_penawaran/cetak_penawaran.php MENAMPILKAN DATA MASTER barang ------------------------- ----->     
      <h3 class="box-title margin text-center">Cek Barang No. Penawaran  "<?php echo $edit['no_surat'] ?>"</h3>
      <center> <div class="batas"> </div></center>
      <hr/>
      <div class="box box-solid box-warning">
        <div class="box-header">
          <h3 class="btn btn enable box-title">
            <i class="fa fa-clipboard "></i>
          Cek Barang Penawaran </h3>
          
          </div>    
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
            <thead>
             <tr class="text-green">

              <th class="col-sm-1">ID Barang</th>
              <th class="col-sm-2">Nama Barang</th>
              <th class="col-sm-2">Spesifikasi</th>
              <th class="col-sm-1">Qty</th> 
              <th class="col-sm-1">Harga</th>
              <th class="col-sm-1">Diskon</th>
              <th class="col-sm-1">Sub Total</th>
              <th class="col-sm-1">PPN</th>
              <th class="col-sm-1">Status</th>
              <th class="col-sm-1" colspan="2">Batalkan?</th>
              <th class="col-sm-1">Edit</th>
            </tr>
          </thead>

          <tbody>
            <?php 
// Tampilkan data dari Database
            $no_surat=$_GET['no_surat'];
            $sql = "SELECT * FROM detail_pesanan WHERE no_surat='$no_surat' ";

            $tampil = mysql_query($sql);
            $no=1;
            while ($tampilkan = mysql_fetch_array($tampil)) { 

              $Kode = $tampilkan['id_barang'];
              $blokir = $tampilkan['acc'];


              ?>

              <tr>
               <td><?php echo $tampilkan['id_barang']; ?></td>  
               <td><?php echo $tampilkan['nama_barang']; ?></td>
               <td><?php echo $tampilkan['Spesifikasi']; ?></td>
               <td><?php echo $tampilkan['qty']; ?></td>
               <td><?php echo $tampilkan['harga_jual']; ?></td>
               <td><?php echo $tampilkan['diskon']; ?></td>
               <td><?php echo $tampilkan['subtotal']; ?></td>
               <td><?php echo $tampilkan['ppn']; ?></td>
               <td><?php echo $tampilkan['status_barang']; ?></td>
               <td><?php if  ( $blokir== 'N' ) {
                echo "<a class='btn btn-xs btn-warning' disabled >Batal</a>";}
                else {echo "<a class='btn btn-xs btn-success' disabled>ACC</a>"; }   ?></td>
                <td align="center">
                 <?php if ( $blokir== 'N' ) { ?>
                   <a class="btn btn-xs btn-success"  data-toggle="tooltip" title="ACC Barang??" href="<?php echo $aksi2 ?>?module=cek_penawaran&aksi=yes&id_barang=<?php echo $tampilkan['id_barang'];?>&no_surat=<?php echo $tampilkan['no_surat'];  ?>" onclick="return confirm('Apakah anda yakin ingin ACC <?php echo $tampilkan['nama_barang']; ?> ?')"><i class="glyphicon glyphicon-ok"></i></a>
                 <?php }
                 else { ?>
                   <a class="btn btn-xs btn-warning" data-toggle="tooltip" title="Batalkan Barang??" href="<?php echo $aksi2 ?>?module=cek_penawaran&aksi=no&id_barang=<?php echo $tampilkan['id_barang']; ?>&no_surat=<?php echo $tampilkan['no_surat'];  ?>" onclick="return confirm('Apakah anda mau membatalkan barang <?php echo $tampilkan['nama_barang']; ?>?')"><i class="glyphicon glyphicon-remove"></i></a>

                 <?php } ?>
               </td>
               <td align="center">
                 <a class="btn btn-xs btn-info" href="?module=cek_penawaran&aksi=edit&no_surat=<?php echo $no_surat ?>&id_barang=<?php echo $tampilkan['id_barang'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
               </td>

               <?php
             }
             ?>
           </tr>
         </tbody>
       </table>
     </div><!-- /.box-body -->
   </div><!-- /.box -->

      <?php
      break;
      case "cetak";
   include 'head.php';
      $data=mysql_query("select * from detail_pesanan where no_surat='$_GET[no_surat]'");
      $edit=mysql_fetch_array($data);
    
      ?>
      <!----- ------------------------- module/cek_penawaran/cetak_penawaran.php MENAMPILKAN DATA MASTER barang ------------------------- ----->     
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
                <h3 class="box-title center"><?php echo "No. "; echo $edit['no_surat'] ;?></h3>
        <span class="pull-right"> 
        Bandung, <?php echo Indonesia2Tgl(date('Y-m-d'));?> 
        </span>         
              </div>
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
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


$data=mysql_query("select * from detail_pesanan where no_surat='$_GET[no_surat]'");

$no=1;

while ($edit = mysql_fetch_array($data)) {

 ?>

  <tr>
  <td><?php echo $no++; ?></td>
  <td><?php echo $edit['no_surat'];; ?></td>
  <td><?php echo $edit['nama_barang']; ?></td>
  <td><?php echo $edit['spesifikasi']; ?></td>
  <td><?php echo $edit['status_barang']; ?></td>
  <td><?php echo $edit['qty']; ?></td>
  <td><?php echo $edit['harga_jual']; ?></td> 
  <td><?php echo $edit['ppn']; ?></td>
  <td><?php echo $edit['subtotal']; ?></td>
<?php
}

?>
  </tr>
      </tbody>
    </table>  
              </div><!-- /.box-body -->
            </div>

   <?php
    include 'tail.php';
   break;
 }
 ?>