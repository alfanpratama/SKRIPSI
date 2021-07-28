<?php
include "pengaturan/fungsi_alert.php";

switch($_GET[act]){
  // Tampil stok
  default:
  $offset=$_GET['offset'];
  //jumlah data yang ditampilkan perpage
  $limit = 10;
  if (empty ($offset)) {
    $offset = 0;
  }
?>
<div class="box box-solid box-info">
<?php
  $tampil=mysql_query("SELECT * FROM stok ORDER BY id_barang");
  $baris=mysql_num_rows($tampil);
?>
  <div class="box-header">
    <h3 class="btn btn enable box-title">Data Stok Barang</h3>
  </div>
  <?php
  if($baris>0){
  ?>
  <div class="box-body table-responsive">
  <table id="example1" class="table table-bordered table-striped">
    <tr>
      <th class="col-sm-1">No</th>
      <th class="col-sm-1">Kode Barang</th>
      <th class="col-sm-2">Nama Barang</th>
      <th class="col-sm-1">Stok Barang</th>
      </tr>
  <?php
  $hasil = mysql_query("SELECT * FROM stok ORDER BY id_barang limit $offset,$limit");
  $no = 1;
  $no = 1 + $offset;
  $warnaGenap = "#B2CCFF";   // warna tua
  $warnaGanjil = "#E0EBFF";  // warna muda
  $counter = 1;
    while ($r=mysql_fetch_array($hasil)){
  $sql = mysql_query("SELECT * FROM barang where id_barang='$r[id_barang]'");
  $r2=mysql_fetch_array($sql);
  if ($counter % 2 == 0) $warna = $warnaGenap;
  else $warna = $warnaGanjil;
       echo "<tr bgcolor='".$warna."'>
       <td align=center>$no</td>
       <td align=center>$r[id_barang]</td>
       <td>$r2[nama_brg]</td>
       <td align=center>$r[stok]</td>
       </tr>";
      $no++;
    $counter++;
    }
    echo "</table>";
  echo "<div class=paging>";

  if ($offset!=0) {
    $prevoffset = $offset-10;
    echo "<span class=prevnext> <a href=$PHP_SELF?module=stok&offset=$prevoffset>Back</a></span>";
  }
  else {
    echo "<span class=disabled>Back</span>";//cetak halaman tanpa link
  }
  //hitung jumlah halaman
  $halaman = intval($baris/$limit);//Pembulatan

  if ($baris%$limit){
    $halaman++;
  }
  for($i=1;$i<=$halaman;$i++){
    $newoffset = $limit * ($i-1);
    if($offset!=$newoffset){
      echo "<a href=$PHP_SELF?module=stok&offset=$newoffset>$i</a>";
      //cetak halaman
    }
    else {
      echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
    }
  }

  //cek halaman akhir
  if(!(($offset/$limit)+1==$halaman) && $halaman !=1){

    //jika bukan halaman terakhir maka berikan next
    $newoffset = $offset + $limit;
    echo "<span class=prevnext><a href=$PHP_SELF?module=stok&offset=$newoffset>Next</a>";
  }
  else {
    echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
  }
  
  echo "</div>";
  }else{
  echo "<br><b>Data Kosong !</b>";
  }
    break;
 
}
?>
      </table>
    </div>
  </div>