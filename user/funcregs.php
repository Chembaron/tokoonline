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
//menambahkan user baru
function regs($data){
    global $koneksi;

    $username = stripslashes($data['username']);
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO user VALUES('','$username','$password')");
    return mysqli_affected_rows($koneksi);
}

