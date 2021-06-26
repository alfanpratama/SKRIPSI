<?php
$aksi="module/harga/harga_aksi.php";


switch($_GET[aksi]){
  default:
  ?>
  <!----- ------------------------- MENAMPILKAN DATA MASTER barang ------------------------- ----->     
  <marquee behavior="alternate"><h3 class="box-title margin text-center">Data Master Harga Barang</h3></marquee>
  <center> <div class="batas"> </div></center>
  <hr/>
  <div class="box box-solid box-info">
    <div class="box-header">
      <h3 class="btn btn enable box-title">
        <i class="fa fa-dollar (alias)"></i>
      Data Master Harga Barang </h3>

    </div>    
      <div class="box-body table-responsive">
       <table id="example1" class="table table-bordered table-striped">
      <thead>
       <tr class="text-green">

        <th class="col-sm-1">ID barang</th>
        <th class="col-sm-2">Nama Barang</th>
        <th >Kategori</th> 
        <th >Satuan</th> 
        <th class="col-sm-2">Kode Produk</th> 
        <th class="col-sm-3">Spesifikasi</th>
        <th class="col-sm-2">Supplier</th>
        <th class="col-sm-1">Harga Beli</th>
        <th class="col-sm-1">Harga Jual</th>
        <th class="col-sm-1">Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php 
// Tampilkan data dari Database
       
      $nol = 0;
      $sql = "SELECT * FROM barang order by harga_beli desc ";
      $tampil = mysql_query($sql);
      $supplier=$tampil['nama_sup'];

      $no=1;
      while ($tampilkan = mysql_fetch_array($tampil)) { 

        $Kode = $tampilkan['id_barang'];
 
        ?>

        <tr>
         <td><?php echo $tampilkan['id_barang']; ?></td>  
         <td><?php echo $tampilkan['nama_brg']; ?></td>
         <td><?php echo $tampilkan['id_kategori']; ?></td>
         <td><?php echo $tampilkan['satuan']; ?></td>
         <td><?php echo $tampilkan['kode_produk']; ?></td>
         <td><?php echo $tampilkan['spesifikasi']; ?></td>
<form class="form-horizontal" action="module/harga/harga_aksi.php" role="form" method="get">
         <td><?php echo $tampilkan['nama_sup']; ?><input type="hidden" name="nama_sup" value="<?php echo $tampilkan['nama_sup']; ?>"></td>
         <td><?php echo format_angka($tampilkan['harga_beli']); ?></td>
         <td><?php echo format_angka($tampilkan['harga_jual']); ?></td>

         <td align="center">
           <a class="btn btn-xs btn-info" href="?module=harga&aksi=edit&id_barang=<?php echo $tampilkan['id_barang'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
    <!--       <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=harga&aksi=hapus&id_barang=<?php echo $tampilkan['id_barang'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>  ?')"> <i class="glyphicon glyphicon-trash"></i></a>-->
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
case "edit" :
$data=mysql_query("select * from barang where id_barang='$_GET[id_barang]'");
$edit=mysql_fetch_array($data);
?>
<!----- ------------------------- EDIT DATA MASTER barang ------------------------- ----->
<h3 class="box-title margin text-center">Input Harga Barang "<?php echo $_GET['id_barang']; ?>"</h3>
<br/>
<form class="form-horizontal" action="<?php echo $aksi?>?module=harga&aksi=edit" role="form" method="post">             

  <div class="form-group">
    <label class="col-sm-4 control-label">ID barang </label>
    <div class="col-sm-5">
      <input type="text" class="form-control" readonly name="id_barang" value="<?php echo $edit['id_barang']; ?>" >
    </div>
  </div>

  <div class="form-group">
    <label class="col-sm-4 control-label">Nama Barang</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" required="required" name="nama" placeholder="Nama Barang" value="<?php echo $edit['nama_brg']; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-4 control-label">Kategori</label>
    <div class="col-sm-5">  
      <select name="id_kategori" class="form-control">

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
          <input type="text" class="form-control"  name="satuan" placeholder="Satuan" value="<?php echo $edit['satuan']; ?>">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label">Kode Produk</label>
        <div class="col-sm-5">
          <input type="text" class="form-control"  name="kode_produk" placeholder="Kode Produk" value="<?php echo $edit['kode_produk']; ?>">
        </div>
      </div>  
      <div class="form-group">
        <label class="col-sm-4 control-label">Spesifikasi</label>
        <div class="col-sm-5">
          <input type="text" class="form-control" name="spesifikasi" value="<?php echo $edit['spesifikasi']; ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">Harga Beli</label>
        <div class="col-sm-5">
          <input type="numeric" class="form-control" name="harga_beli" value="<?php echo $edit['harga_beli']; ?>" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
        </div>
      </div> 
      <div class="form-group">
        <label class="col-sm-4 control-label">Harga Jual</label>
        <div class="col-sm-5">
          <input type="numeric" class="form-control" name="harga_jual" value="<?php echo $edit['harga_jual']; ?>" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-4"></label>
        <div class="col-sm-5">
         <hr/>
         <button type="submit"name="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
         <a href="?module=harga">
          <button class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Batal</button></a>
        </div>
      </div>

    </form>
  </div>
</div>
<!----- ------------------------- END EDIT DATA MASTER barang ------------------------- ----->
<?php
break;
}
?>