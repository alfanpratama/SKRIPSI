<?php
// Koneksi library FPDF
require('fpdf.php');

// Setting halaman PDF
$pdf = new FPDF('L','mm','Legal');
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetFont('Arial','B',16);
// Membuat string
$pdf -> image('logo1.jpeg',30,20,250,20); 
// Setting spasi kebawah supaya tidak rapat


$pdf->Cell(15,35,'',0,1);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(300,6,'SALES LOCAL ORDER (SLO)',0,0 ,'C');
$pdf->SetFont('Arial','',10);

$pdf->Cell(15,15,'',0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'Instansi/Perusahaan',1,0);
$pdf->Cell(130,6,':',0,0);
$pdf->Cell(50,6,'Tgl/Bln/Thn',1,0);
$pdf->Cell(130,6,':',0,0);
$pdf->SetFont('Arial','',10);

$pdf->Cell(15,6,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'Attn/Jabatan',1,0);
$pdf->Cell(130,6,':',0,0);
$pdf->Cell(50,6,'No. Purchase Order',1,0);
$pdf->Cell(130,6,':',0,0);
$pdf->SetFont('Arial','',10);

$pdf->Cell(15,6,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'Alamat',1,0);
$pdf->Cell(130,6,':',0,0);
$pdf->Cell(50,6,'Tanggal PO',1,0);
$pdf->Cell(130,6,':',0,0);
$pdf->SetFont('Arial','',10);

$pdf->Cell(15,6,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'No SLO',1,0);
$pdf->Cell(130,6,':',0,0);
$pdf->Cell(50,6,'Target Selesai',1,0);
$pdf->Cell(130,6,':',0,0);
$pdf->SetFont('Arial','',10);

$pdf->Cell(15,15,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,6,'No',1,0);
$pdf->Cell(40,6,'Nama Barang',1,0);
$pdf->Cell(90,6,'Spesifikasi',1,0);
$pdf->Cell(20,6,'Qty',1,0);
$pdf->Cell(40,6,'Harga Satuan(Rp)',1,0);
$pdf->Cell(40,6,'Total Harga (Rp)',1,0);
$pdf->Cell(50,6,'Sumber Barang',1,0);

$pdf->Cell(15,6,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(165,6,'Total',1,0);
$pdf->Cell(40,6,'',1,0);
$pdf->Cell(40,6,'',1,0);
$pdf->Cell(50,6,'',1,0);
$pdf->SetFont('Arial','',10);

$pdf->Cell(15,9,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,6,'Keterangan',0,0);
$pdf->Cell(130,6,':',0,0);

$pdf->Cell(15,9,'',0,1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,'a. Sistem Pembayaran',0,0);
$pdf->Cell(70,6,'',0,0);
$pdf->Cell(25,6,'COD',0,0);
$pdf->Cell(20,6,':',1,0);
$pdf->Cell(20,6,'',0,0);
$pdf->Cell(20,6,'Kredit:',0,0);
$pdf->Cell(35,6,'',1,0);

$pdf->Cell(15,6,'',0,1);
$pdf->Cell(50,6,'',0,0);
$pdf->Cell(70,6,'',0,0);
$pdf->Cell(25,6,'DP',0,0);
$pdf->Cell(20,6,':',1,0);
$pdf->Cell(20,6,'',0,0);
$pdf->Cell(20,6,'',0,0);
$pdf->Cell(35,6,'',1,0);


$pdf->Cell(15,10,'',0,1);
$pdf->Cell(50,6,'Logistic Delivery',0,0);
$pdf->Cell(100,6,'',1,0);
$pdf->Cell(55,6,'...............................',0,0);

$pdf->Cell(15,6,'',0,1);
$pdf->Cell(50,6,'',0,0);
$pdf->Cell(100,6,'',1,0);
$pdf->Cell(55,6,'...............................',0,0);


$pdf->Cell(15,15,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,6,'Account Executive',0,0);
$pdf->Cell(30,6,'disetujui',0,0);
$pdf->Cell(50,6,'Account Manager',0,0);

$pdf->Cell(15,14,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,15,'________________',0,0);
$pdf->Cell(30,15,'',0,0);
$pdf->Cell(50,15,'________________',0,0);


$pdf->Output();
?>