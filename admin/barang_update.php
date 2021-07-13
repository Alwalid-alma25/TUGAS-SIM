<?php 
include '../koneksi.php';
$id  = $_POST['id'];
$barang  = $_POST['barang'];

mysqli_query($koneksi, "update barang set barang='$barang' where barang_id='$id'");
header("location:barang.php");