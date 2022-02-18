<?php
include('config.php');
$bany = $_POST['kuantitas'];
$kera = $_POST['id'];
$hasil = "";
$cart = mysqli_query($koneksi,"SELECT c.id, b.stok, c.kuantitas FROM 
barang AS b, cart AS c WHERE b.id = c.id_produk  AND c.id = '$kera'");
$data = mysqli_fetch_array($cart);
$qua = $data['stok'];
if ($bany != "") {
  if ($bany > $qua) {
    $hasil = 'batas';
  }else {
    mysqli_query($koneksi,"UPDATE cart SET kuantitas = '$bany' WHERE id = '$kera'");
  }
}
echo json_encode(array('status' => $hasil));
?>