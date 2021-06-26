
  <!----- ------------------------- MENAMPILKAN DATA MASTER barang ------------------------- ----->			

  <div class="box box-solid box-success">
    <div class="box-header">
      <h3 class="btn btn disabled box-title">
        <i class="fa fa-map-marker"></i>
      Data Master barang </h3>
      <a class="btn btn-default pull-right"href="?module=barang&aksi=tambah">
        <i class="fa  fa-plus"></i> Tambah Data</a>		
      </div>		
      <div class="box-body">
       <table id="example1" class="table table-bordered table-striped">
        <thead>
         <tr class="text-red">

          <th class="col-sm-1">ID barang</th>
          <th class="col-sm-2">Nama Barang</th>
          <th class="col-sm-1">Kategori</th> 
          <th class="col-sm-1">Satuan</th> 
          <th class="col-sm-2">Kode Produk</th> 
          <th class="col-sm-3">Spesifikasi</th>
          <th class="col-sm-1">Aksi</th>
        </tr>
      </thead>

      <tbody>
        <?php 
// Tampilkan data dari Database
        $sql = "SELECT * FROM barang";
        $tampil = mysql_query($sql);
        $no=1;
        while ($tampilkan = mysql_fetch_array($tampil)) { 

          $Kode = $tampilkan['id_barang'];
          ?>

          <tr>
           <td><?php echo $tampilkan['id_barang']; ?></td>	
           <td><?php echo $tampilkan['nama']; ?></td>
           <td><?php echo $tampilkan['id_kategori']; ?></td>
           <td><?php echo $tampilkan['satuan']; ?></td>
           <td><?php echo $tampilkan['kode_produk']; ?></td>
           <td><?php echo $tampilkan['spesifikasi']; ?></td>

           <td align="center">
             <a class="btn btn-xs btn-info" href="?module=barang&aksi=edit&id_barang=<?php echo $tampilkan['id_barang'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
             <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=barang&aksi=hapus&id_barang=<?php echo $tampilkan['id_barang'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>	?')"> <i class="glyphicon glyphicon-trash"></i></a>
           </td>

           <?php
         }
         ?>
       </tr>
     </tbody>
   </table>
 </div><!-- /.box-body -->
</div><!-- /.box -->

<!----- ------------------------- END MENAMPILKAN DATA MASTER barang ------------------------- ----->
<div class="box box-solid box-success">
        <div class="box-header">
          <h3 class="btn disabled box-title">
            <i class="fa fa-truck"></i>
          Keranjang Pesanan</h3>  
        </div>    
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr class="text-red">
                <th >No</th> 
                <th>Nama Barang</th> 
                <th>Spesifikasi</th> 
                <th class="col-sm-2">qty</th> 
                <th >AKSI</th>  
              </tr>
            </thead>

            <tbody>
              <?php 
              // Tampilkan data dari Database
              $sql = "SELECT * FROM pesanan_tmp ";
              $tampil = mysql_query($sql);
              $no=1;
              while ($tampilkan = mysql_fetch_array($tampil)) { 
                $Kode = $tampilkan['id_barang'];

                ?>

                <tr>
                  <td><?php echo $no++; ?></td> 
                  <td><input type="text" class="form-control" name="barang1" value="<?php echo $tampilkan['nama']; ?>"></td> 
                  <td><input type="text" class="form-control" name="spesifikasi1" value="<?php echo $tampilkan['spesifikasi']; ?>"></td> 
                  <td><input type="text" class="form-control" name="qty1" value="<?php echo $tampilkan['qty']; ?>"></td> 
                  <td align="center">
                    <a class="btn btn-xs btn-info" href="?module=pesanan&aksi=edit&id_barang=<?php echo $tampilkan['id_barang'];?>" alt="Edit Data"><i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn btn-xs btn-danger"href="<?php echo $aksi ?>?module=pesanan
                      &aksi=hapus&id_barang=<?php echo $tampilkan['id_barang'];?>"  alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA <?php echo $Kode; ?>  ?')"> <i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                    <?php
                  }
                  ?>
                </tr>
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->