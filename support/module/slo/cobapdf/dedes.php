<?php

$server="localhost";
$username="root";
$password="";
$database="cobadesi";
$conn = mysqli_connect($server,$username,$password,$database)or die("gagal, database tidak ditemukan");
if (!$conn){
    die ("Connection Failed: ". mysqli_connect_error());
    }
// Koneksi library FPDF
require('fpdf.php');

// Setting halaman PDF
$pdf = new FPDF('L','mm','Legal');
// Menambah halaman baru
$pdf->AddPage();
// Setting jenis font
$pdf->SetFont('Arial','B',16);
// Membuat string
$pdf->Cell(350,7,'DATA PRIBADI',0,1,'C');
$pdf->SetFont('Arial','B',9);
$pdf->Cell(350,7,'SISTEMKUHH.',0,1,'C');
$pdf -> image('logo.jpg',150,10,10,10); 
// Setting spasi kebawah supaya tidak rapat
$pdf->Cell(15,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(25,6,'NIM',1,0);
$pdf->Cell(40,6,'NAMA',1,0);
$pdf->Cell(50,6,'ALAMAT',1,0);
$pdf->Cell(30,6,'hp',1,0);
$pdf->Cell(25,6,'tempat',1,0);
$pdf->Cell(25,6,'tanggal',1,0);
$pdf->Cell(25,6,'hobi',1,0);
$pdf->Cell(25,6,'agama',1,0);
$pdf->Cell(25,6,'pendidikan',1,0);
$pdf->Cell(25,6,'telp',1,0);
 
$pdf->Cell(10,6,'',0,1);
$pdf->SetFont('Arial','',10);
$query = mysqli_query($conn, "SELECT * FROM eci");
while ($row = mysqli_fetch_array($query)){
    $pdf->Cell(25,6,$row['NIM'],1,0);
    $pdf->Cell(40,6,$row['NAMA'],1,0);
    $pdf->Cell(50,6,$row['ALAMAT'],1,0);
    $pdf->Cell(30,6,$row['hp'],1,0);
	$pdf->Cell(25,6,$row['tempat'],1,0);
    $pdf->Cell(25,6,$row['tanggal'],1,0);
    $pdf->Cell(25,6,$row['hobi'],1,0);
    $pdf->Cell(25,6,$row['agama'],1,0);
	$pdf->Cell(25,6,$row['pendidikan'],1,0);
    $pdf->Cell(25,6,$row['telp'],1,0);
}

$pdf->Output();
?>