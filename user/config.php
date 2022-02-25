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
	$image = upload();
	$query = "INSERT INTO barang VALUES ('', '$image', '$nama', '$stok','$harga', '$kategori')";
	mysqli_query($koneksi, $query);
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
//menambahkan user baru
function regs($data){
    global $koneksi;

    $username = stripslashes($data['username']);
    $password = mysqli_real_escape_string($koneksi, $data['password']);
	$email = htmlspecialchars(stripslashes($data['email']));
	$level = htmlspecialchars($data['level']);
    //enkripsi password
	$ceknama = mysqli_query($koneksi, "SELECT username FROM user WHERE username = '$username'");
	if(mysqli_fetch_assoc($ceknama)){
		echo "<script>
		alert('Username is already used');
		</script>";
		return false;

	}
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO user VALUES('','$username', '$email', '$level', '$password')");
    return mysqli_affected_rows($koneksi);
}
//checkout
function checkout($data){
	global $koneksi;
	
	$user_id = $data['uid'];
	$username = htmlspecialchars($data['username']);
	$alamat = htmlspecialchars($data['alamat']);
	$telp = htmlspecialchars($data['no_hp']);
	$prov = htmlspecialchars($data['provinsi']);
	$id_transaksi = $data["id_transaksi"];
	$kota = htmlspecialchars($data['distrik']);
	$ongkir = htmlspecialchars($data['ongkir']);
	$etd = htmlspecialchars($data['estimasi']);
	$date = htmlspecialchars($data['tgl']);
	$query = "INSERT INTO ongkir VALUES ('', '$user_id', '$id_transaksi', '$username', '$alamat', '$telp', '$prov', '$kota', '$ongkir', '$etd', '$date')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);

}
// '$ekspedisi'
//pembelian
function pembelian($data){
	global $koneksi;
	
	$uid = $data['uid'];
	$id_barang = $data['produk_id'];
	$qty = ($data['qty']);
	$tarif = $data['ongkir'];
	$alamat = ($data['alamat']);
	$status = "Proses pengisian data";
	$id_transaksi = $data["id_transaksi"];
	$date = $data['tgl'];
	$sum = $data['sum'];
	$total = $sum + $tarif;
	$jumlah_dipilih = count($id_barang);
	for($x = 0 ; $x < $jumlah_dipilih; $x++){
		$query = "INSERT INTO pembelian VALUES ('','$uid','$id_transaksi','$id_barang[$x]','$qty[$x]','$total','$tarif','$date','$alamat', '$status')";
        mysqli_query($koneksi, $query);
	}
	
    $query2 = "INSERT INTO pembayaran VALUES ('','','$uid','$id_transaksi','$date','$status')";
	
	mysqli_query($koneksi, $query2);
	return mysqli_affected_rows($koneksi);

}
// function sold($data)
// {
// 	global $koneksi;

// 	$transaksi = htmlspecialchars($data['transaksi']);
// 	$uid = $data['userid'];
// 	$produk = $data['produk'];
// 	$stokdibeli = $data['stokdibeli'];
// 	$status = $data['status'];
// 	$jumlah_dipilih = count($produk);
	
	

// 	for($x = 0; $x < $jumlah_dipilih; $x++){
// 		$query = "INSERT INTO sold VALUES ('', '$transaksi', '$uid', '$produk[$x]', '$stokdibeli[$x]', '$status')";
// 		mysqli_query($koneksi, $query);
// 	}
// 	return mysqli_affected_rows($koneksi);
// }
//pembayaran
function buktibayar($data)
{
    global $koneksi;
    $userid = htmlspecialchars($data["userid"]);
    $gambar = upload();

    $produk = $data["produk"];
    $stokdibeli = $data["stokdibeli"];
    $status = htmlspecialchars($data["status"]);
    $id_transaksi = $data["id_transaksi"];
    $query2 = "UPDATE pembayaran SET image = '$gambar' WHERE id_transaksi = $id_transaksi ";
    $query3 = "UPDATE pembayaran SET status = '$status' WHERE id_transaksi = $id_transaksi ";
	mysqli_query($koneksi, $query2);
    mysqli_query($koneksi, $query3);
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
	move_uploaded_file($tfile, 'bayar/'. $namabaru);
	return $namabaru;
}
function tambah($data)
{
    global $koneksi;
    $userid = htmlspecialchars($data["userid"]);
    $id = $data["produk_id"];
    $ssudah = $data["stokbaru"];
    $jumlah_dipilih = count($id);
    for ($x = 0; $x < $jumlah_dipilih; $x++) {
        $query1 = "UPDATE barang SET stok = '$ssudah[$x]' WHERE id = $id[$x]";
        mysqli_query($koneksi, $query1);
    }
    $query2 = "DELETE FROM cart WHERE user_id = $userid";
    mysqli_query($koneksi, $query2);
    $query3 = "DELETE FROM sold WHERE id_user = $userid";
    mysqli_query($koneksi, $query3);
    $query4 = "DELETE FROM ongkir WHERE id_user = $userid";
    mysqli_query($koneksi, $query4);
    return mysqli_affected_rows($koneksi);
}