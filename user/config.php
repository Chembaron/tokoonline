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
	
	$user_id = $data['uit'];
	$username = htmlspecialchars($data['username']);
	$alamat = htmlspecialchars($data['alamat']);
	$telp = htmlspecialchars($data['telp']);
	$prov = htmlspecialchars($data['provinsi']);
	$kota = htmlspecialchars($data['distrik']);
	$ekspedisi = htmlspecialchars($data['ekspedisi']);
	$ongkir = htmlspecialchars($data['ongkir']);
	$etd = htmlspecialchars($data['estimasi']);
	$date = htmlspecialchars($data['tgl']);
	$query = "INSERT INTO ongkir VALUES ('', '$user_id', '$username', '$alamat', '$telp','$prov', '$kota', '$ekspedisi', '$ongkir', '$etd', '$date')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);

}
//pembelian
function pembelian($data){
	global $koneksi;
	
	$uid = $data['uid'];
	
	$ongkir = htmlspecialchars($data['idt']);
	$date = $data['tgl'];
	$total = htmlspecialchars($data['sum']);
	
	$query = "INSERT INTO pembelian VALUES ('', '$uid', '$ongkir', '$date', '$total')";
	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);

}
function sold($data)
{
	global $koneksi;

	$transaksi = htmlspecialchars($data['transaksi']);
	$uid = $data['userid'];
	$produk = $data['produk'];
	$stokdibeli = $data['stokdibeli'];
	$status = $data['status'];
	$jumlah_dipilih = count($produk);
	
	

	for($x = 0; $x < $jumlah_dipilih; $x++){
		$query = "INSERT INTO sold VALUES ('', '$transaksi', '$uid', '$produk[$x]', '$stokdibeli[$x]', '$status')";
		mysqli_query($koneksi, $query);
	}
	return mysqli_affected_rows($koneksi);
}