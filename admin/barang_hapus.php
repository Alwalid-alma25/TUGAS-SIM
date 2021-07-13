<?php 
include '../koneksi.php';
$id  = $_GET['id'];

mysqli_query($koneksi, "update transaksi set transaksi_barang='1' where transaksi_barang='$id'");

mysqli_query($koneksi, "delete from barang where barang_id='$id'");
header("location:barang.php");