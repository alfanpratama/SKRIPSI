<?php
$server="localhost";
$username="root";
$password="";
$database="skripsi";
$conn = mysqli_connect($server,$username,$password,$database)or die("gagal, database tidak ditemukan");

if (!$conn){
    die ("Connection Failed: ". mysqli_connect_error());
    }
    ?>