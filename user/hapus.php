<?php
include_once "config.php";
$id = $_GET ["id"];
$sql = $koneksi->query("SELECT * FROM cart WHERE id = $id");
$data  = $sql->  fetch_assoc();
$sql =$koneksi->query("DELETE FROM cart WHERE id = $id");

if ($sql){
    echo "<script>
    document.location.href = 'cart.php';
    </script>";
  }else{
    echo "<script>
    document.location.href = 'cart.php';
    </script>";
}





?>