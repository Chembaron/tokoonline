<?php 
include_once "config.php";
$id = $_GET['id'];
if (delete($id)>0) {
	echo "<script>
		alert('data berhasil dihapus');
	</script>";
}
 ?>