<?php

$server="localhost";
$username="root";
$password="";
$database="skripsi";
$conn = mysqli_connect($server,$username,$password,$database)or die("gagal, database tidak ditemukan");
$no_surat=$_GET['no_surat'];
if (!$conn){
    die ("Connection Failed: ". mysqli_connect_error());
    }
// Koneksi library FPDF
require('fpdf.php');

// Setting halaman PDF
$pdf = new FPDF('P','mm','Legal');
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetFont('Arial','B',16);
// Membuat string
$pdf -> image('kop.png',10,20,190,25); 
// Setting spasi kebawah supaya tidak rapat


$pdf->Cell(15,35,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(25,6,'No   :',0,0);
$pdf->SetFont('Arial','',10);
//$query = mysqli_query($conn, "SELECT * FROM detail_pesanan Where no_surat='$no_surat' ");
//while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(25,6,$no_surat,0,0);
//}
$pdf->Cell(15,6,'',0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,6,'Bill To',35,0);
$pdf->Cell(15,10,'',0,1);


$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,6,'Company',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT nama_pel FROM pesanan a, pelanggan b Where a.id_pelanggan=b.id_pelanggan and no_surat='$no_surat' ");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(140,6,$row['nama_pel'],1,0);
}
$pdf->Cell(15,6,'',0,1);


$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'Address',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT alamat FROM pesanan a, pelanggan b Where a.id_pelanggan=b.id_pelanggan and no_surat='$no_surat'");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(140,6,$row['alamat'],1,0);
}
// $pdf->Cell(15,6,'',0,1);

// $pdf->SetFont('Arial','',10);
// $pdf->Cell(50,6,'Kota, K Pos',1,0);
// $pdf->SetFont('Arial','',10);
// $query = mysqli_query($conn, "SELECT alamat FROM pesanan a, pelanggan b Where a.id_pelanggan=b.id_pelanggan and no_surat='$no_surat'");
// while ($row = mysqli_fetch_array($query)){
//     $pdf->Cell(140,6,$row['id_pelanggan'],1,0);
// }
$pdf->Cell(15,6,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'Phone, Fax',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT telp FROM pesanan a, pelanggan b Where a.id_pelanggan=b.id_pelanggan and no_surat='$no_surat'");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(140,6,$row['telp'],1,0);
}
$pdf->Cell(15,6,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'Contact',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT cp FROM pesanan a, pelanggan b Where a.id_pelanggan=b.id_pelanggan and no_surat='$no_surat'");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(140,6,$row['cp'],1,0);
}
$pdf->Cell(15,6,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'Email',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT email FROM pesanan a, pelanggan b Where a.id_pelanggan=b.id_pelanggan and no_surat='$no_surat'");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(140,6,$row['email'],1,0);
}
$pdf->Cell(15,6,'',0,1);
$pdf->SetFillColor(210,221,242);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No',1,0,'C',true);
$pdf->Cell(40,6,'Nama Barang',1,0,'C',true);
$pdf->Cell(55,6,'Spesifikasi',1,0,'C',true);
$pdf->Cell(20,6,'Qty',1,0,'C',true);
$pdf->Cell(35,6,'Harga Satuan(Rp)',1,0,'C',true);
$pdf->Cell(30,6,'Total Harga (Rp)',1,0,'C',true);

$pdf->Cell(15,6,'',0,1);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT * FROM detail_pesanan Where no_surat='$no_surat'");
$no = 1;
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(10,6,$no++,1,0);
    $pdf->Cell(40,6,$row['nama_barang'],1,0);
    $pdf->Cell(55,6,$row['spesifikasi'],1,0);
    $pdf->Cell(20,6,$row['qty'],1,0);
	$pdf->Cell(35,6,number_format($row['harga_jual']),1,0,'R');
    $pdf->Cell(30,6,number_format($row['subtotal']),1,0,'R');
    
    $pdf->Ln();


}
//coba coba//


//batas coba//
$pdf->Cell(190,6,'',1,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(160,6,'SubTotal',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT sum(subtotal) as total FROM detail_pesanan Where no_surat ='$no_surat'");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(30,6,number_format($row['total']),1,0,'R');
}
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(160,6,'Diskon',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT sum(diskon) as diskon FROM detail_pesanan Where no_surat ='$no_surat'");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(30,6,number_format($row['diskon']),1,0,'R');
}
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Cell(160,6,'Total',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT sum(subtotal) as total, sum(diskon) as diskon FROM detail_pesanan Where no_surat ='$no_surat'");
while ($row = mysqli_fetch_array($query)){
    $subtotal=$row['total'];
    $diskon=$row['diskon'];
    $jumlah=$subtotal - $diskon;
    $pdf->Cell(30,6,number_format($jumlah),1,0,'R');
}

$pdf->Cell(15,6,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(160,6,'PPN 10%',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT sum(subtotal) as total,sum(ppn) as ppn,sum(diskon) as diskon FROM detail_pesanan Where no_surat ='$no_surat'");
while ($row = mysqli_fetch_array($query)){
    $subtotal=$row['total'];
    $diskon=$row['diskon'];
    $jumlah=$subtotal - $diskon;
    $ppn=$jumlah *10/100;
    $pdf->Cell(30,6,number_format($ppn),1,0,'R');
}

$pdf->Cell(15,6,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(160,6,'Grand Total',1,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT sum(subtotal) as total, sum(ppn) as ppn, sum(diskon) as diskon FROM detail_pesanan Where no_surat ='$no_surat' group by no_surat");
while ($row = mysqli_fetch_array($query)){
    $subtotal=$row['total'];
    $ppn=$row['ppn'];
    $diskon=$row['diskon'];
    $jumlah=$subtotal - $diskon;
    $ppn=$jumlah *10/100;
    $hasil=$jumlah + $ppn;
    $pdf->Cell(30,6,number_format($hasil),1,0,'R');
    $pdf->Ln();
}

$pdf->Cell(190,15,'',1,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(190,10,'Quote Comment :',1,0);
$pdf->Ln();


$pdf->SetFont('Arial','B',10);
$pdf->Cell(95,6,'Prepared By',0,0);
$pdf->Cell(95,6,'Untuk mengubah penawaran ini menjadi PO',0,0);
$pdf->Ln();
$pdf->Cell(95,6,'',0,0);
//$pdf->SetFont('Arial','B',10);
//$pdf->Cell(95,6,'',0,0,'T');
$pdf->Cell(95,6,'Silahkan Paraf :',0,1);
$pdf->Cell(95,15,'',0,0);
$pdf->Ln();



$pdf->SetFont('Arial','B',10);
$query = mysqli_query($conn, "SELECT nama FROM pesanan a, user b Where a.id_user=b.id_user and no_surat='$no_surat'");
while ($row = mysqli_fetch_array($query)){
$pdf->Cell(95,6,$row['nama'],0,0,'B');
}
$pdf->Cell(95,6,'Nama Lengkap : ',0,0,'B');
$pdf->Ln();


$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,'Date: ',0,0);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT * FROM pesanan Where no_surat='$no_surat'");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell (85,6,$row['tgl_prospek'],0,0);
}

$pdf->Cell(10,6,'Date:  ',0,0);
$pdf->SetFont('Arial','',10);

    $pdf->Cell(10,6,$row['tgl_prospek'],0,0);


$pdf->Output();
?>