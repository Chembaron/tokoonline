<?php
include_once "config.php";
$id = $_GET["id"];
global $koneksi;
$status = "Barang Diterima";
$query = "UPDATE pembayaran SET status = '$status' WHERE id = '$id'";
mysqli_query($koneksi, $query);
echo "<script>document.location.href = 'riwayat.php';</script>";