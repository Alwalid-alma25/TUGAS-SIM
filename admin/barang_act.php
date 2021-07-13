<?php 
include '../koneksi.php';
$barang  = $_POST['barang'];

mysqli_query($koneksi, "insert into barang values (NULL,'$barang')");
header("location:barang.php");