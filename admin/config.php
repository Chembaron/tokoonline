<?php
//koneksi
$koneksi = mysqli_connect("localhost", "root", "", "penjualan");

function query($query){
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)){
		$rows[]=$row;
	}
	return $rows;
}
//menambahkan data ke database 
function add($data){
	global $koneksi;

	$nama = htmlspecialchars($data['nama']);
	$stok = htmlspecialchars($data['stok']);
	$harga = htmlspecialchars($data['harga']);
	$kategori = htmlspecialchars($data['kategori']);
	$deskripsi = htmlspecialchars($data['deskripsi']);
	$image = upload();
	$query = "INSERT INTO barang VALUES ('', '$image', '$nama', '$stok','$harga', '$kategori', '$deskripsi')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}
//menghapus data di database 
function delete($id){
	global $koneksi;
	$query1 = mysqli_query($koneksi, "SELECT * FROM barang WHERE id = $id");
	$data1 = mysqli_fetch_array($query1);

	mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id");
	$path = "img/".$data1['image'];
	unlink($path);
	return mysqli_affected_rows($koneksi);

}
//mengubah data di database
function edit($data){
	global $koneksi;
	$id = $data['id'];
	$nama = htmlspecialchars($data['nama']);
	$harga = htmlspecialchars($data['harga']);
	$stok = htmlspecialchars($data['stok']);
	$kategori = htmlspecialchars($data['kategori']);
	$gambarlama = $data['gambarlama'];
	if ($_FILES['image']['error']===4) {
		$image = $gambarlama;
	}else{
		$image = upload();
	}

	$query = "UPDATE barang SET 
				nama = '$nama', 
				stok = '$stok', 
				harga = '$harga', 
				kategori = '$kategori', 
				image='$image' 
				WHERE id = $id";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}
//upload gambar
function upload(){
	$nfile = $_FILES['image']['name'];
	$ufile = $_FILES['image']['size'];
	$tfile = $_FILES['image']['tmp_name'];
	$gambarvalid = ['jpg','jpeg','png'];
	$valid = explode('.','$nfile');
	$valid = strtolower(end($gambarvalid));
	if (!in_array($valid, $gambarvalid)) {
		echo "<script>alert('File yang anda pilih bukan gambar')</script>";
		return false;
	}
	if ($ufile > 30000000) {
		echo "<script>alert('Ukuran file terlalu besar')</script>";
		return false;
	}
	$namabaru = uniqid();
	$namabaru .= '.';
	$namabaru .= $valid;
	move_uploaded_file($tfile, 'img/'. $namabaru);
	return $namabaru;
}




//menambahkan kategori
function kategori($data){
	global $koneksi;
	$kategori = htmlspecialchars($data['kategori']);
	$query = "INSERT INTO kategori_id VALUES ('','$kategori')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}
//mengubah kategori
function ubahkat($data){
	global $koneksi;
	$id = $data['id'];
	$kategori = htmlspecialchars($data['kategori']);
	$query = "UPDATE kategori_id SET kategori = '$kategori' WHERE id = $id";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}
function delkat($id){
	global $koneksi;
	mysqli_query($koneksi, "DELETE FROM kategori_id WHERE id = $id");
	 return mysqli_affected_rows($koneksi);
}









//menambah stok
function stok($query)
{
    global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)){
		$rows[]=$row;
	}
	return $rows;
}
function tambahs($data)
{
    $id = $data["id_barang"];
    global $koneksi;
    $sbelum = htmlspecialchars($data["stok_sebelum"]);
    $stambah = htmlspecialchars($data["stok_ditambah"]);
    $ssudah = $sbelum + $stambah;
    $idbarang = htmlspecialchars($data["id_barang"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    mysqli_query($koneksi, "UPDATE barang SET stok= '$ssudah' WHERE id= $id");
    $query = "INSERT INTO stok VALUES ('','$sbelum','$ssudah','$stambah','$idbarang','$tanggal' )";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function hapus($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM stok WHERE id= $id");
    return mysqli_affected_rows($koneksi);
}
function ubah($data)
{
    $id = $data["id_barang"];
    global $koneksi;
    $sbelum = htmlspecialchars($data["stok_sebelum"]);
    $ssudah = htmlspecialchars($data["stok_sesudah"]);
    $stambah = htmlspecialchars($data["stok_ditambahkan"]);
    $idbarang = htmlspecialchars($data["id_barang"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    $query = "UPDATE stok SET
                stok_sebelum='$sbelum',
                stok_sesudah= '$ssudah',
                stok_ditambahkan='$stambah',
                tanggal = '$tanggal'
                WHERE id= $id
                ";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
function cari($keyword)
{
    $query = "SELECT * FROM stok WHERE id_barang LIKE '%$keyword%'";
    return stok($query);
}

?>