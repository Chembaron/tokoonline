<?php 
include_once "config.php";
$id = $_GET['id'];
if (delkat($id)>0) {
	echo "<script>
		alert('data berhasil dihapus');
		document.location.herf = 'tkategori.php';
	</script>";
}
 ?>