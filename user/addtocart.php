<?php
include_once 'config.php';
session_start();
$userid = $_SESSION["uid"];
$produkid = $_POST["idproduk"];
$qty = $_POST["qty"];

$pilih = mysqli_query($koneksi, "SELECT * FROM cart WHERE user_id = $userid AND id_produk = $produkid");
$halo = mysqli_fetch_assoc($pilih);
$idproduk = isset ($halo ["id_produk"]);
if ($idproduk == $produkid){

        global $conn;
        $userid = $_SESSION["uid"];
        $produkid = $_POST["idproduk"];
        $qty = $halo["kuantitas"] + $_POST["qty"];
      
        $query = "UPDATE cart SET
        user_id = $userid,
        id_produk = $produkid,
        kuantitas ='$qty'
        WHERE id_produk = '$produkid'
        ";
        mysqli_query($koneksi, $query);
        echo "<script>alert('barang dimasukkan di keranjang');
        document.location.href = 'cart.php';</script> ";
        return mysqli_affected_rows($koneksi);
}else {
     $query = "INSERT INTO cart VALUES ('','$userid','$produkid','$qty')";
mysqli_query($koneksi, $query); 
echo "<script>alert('barang dimasukkan di keranjang');
document.location.href = 'cart.php';</script> ";  
}