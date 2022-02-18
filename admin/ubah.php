<?php 
include_once "config.php";
session_start();
if(!isset($_SESSION["login"])){
  header("Location: ../user/login.php");
  exit;
}if($_SESSION['level']!='admin'){
  header("Location: ../user/index.php");
}


$id = $_GET['id'];
$edit = query("SELECT * FROM barang WHERE id = $id")[0];
if (isset($_POST["simpan"])) {
  if (edit($_POST) > 0){
    echo "<script>alert('data berhasil diubah');
    </script>";
  }else {
    echo "<script>alert('gagal');</script>";
  }
}
//  ?>

<?php 

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Simple Tables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="style.css">
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php
    include 'header.php';
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
    include 'sidebar.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="fw-bold">Tambah barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Form Tambah Barang</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="content-wrapper pt-5 mx-auto">
      <div class="container card shadow overflow-hidden" style="width: 70%">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-12 overflow-auto p-4" style="height: 520px" id="ams">
              <h4 class="mb-3 text-primary">Edit barang</h4>
              <!-- <div class="form-floating mb-3 mt-5">
                <label for="nama">Id</label>
                <input type="text" name="id" class="form-control" id="id"  value="<?= $edit[''];?>">
              </div> -->
              <input type="hidden" name="id" value="<?= $edit['id'];?>">
              <input type="hidden" name="gambarlama" value="<?= $edit['image'];?>">
              <div class="form-floating mb-3 mt-5">
                <label for="nama">Nama barang</label>
                <input type="text" name="nama" class="form-control" id="nama"  value="<?= $edit['nama'];?>">
              </div>
              <div class="form-floating mb-3">
                <label for="stok">Stok</label>
                <input type="number" disabled class="form-control" id="stok" name="stok" required value="<?= $edit['stok'];?>">
                <input type="hidden" class="form-control" id="stok" name="stok" required value="<?= $edit['stok'];?>">
                <a class="btn btn-primary" href="tstok.php?id=<?= $edit['id'];?>" role="button">Tambah</a>
              </div>
              <div class="form-floating mb-3">
                <label for="harga">Harga Barang</label>
                <input type="number" name="harga" class="form-control" id="Harga" value="<?= $edit['harga'];?>">
              </div>
              <div class="form-group">
              <div class="form-floating mb-3">
                <label for="deskripsi">Tambah Deskripsi</label>
                <input type="number" name="deskripsi" class="form-control" id="deskripsi" value="<?= $edit['deskripsi'];?>">
              </div>
              <div class="form-group">
                <label for="gambar">Gambar Sebelum</label>
                <div class="form-group">
                  <img width="100" src="img/<?= $edit['image'];?>" alt="" srcset="">
                </div>
                <label for="gambarupdate">gambar sesudah</label>
                <input type="file" class="form-control" id="gambar" name="image" autocomplete="off" onchange="readURL(this);" style="max-width: 150px">
                <img id="blah" src="http://placehold.it//180" alt="your image">
              </div>
              <div class="form-floating mb-3">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" class="form-control">
                  <?php 
                $query = mysqli_query($koneksi, "SELECT * FROM kategori_id");
                while ($data = mysqli_fetch_assoc($query)) { ?>
                   <option value="<?php echo $data['id'];?>"><?php echo $data['kategori'];?></option>
                <?php } ?>
                </select>
              </div>
              <button type="submit" name="simpan" class="btn-primary">Simpan</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
<!--  -->
<!-- <div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-primary ml-4">Tambah Barang</button>

</div> -->
        <!-- /.row -->
        
        <!-- /.row -->

        <!-- /.row -->

        <!-- /.row -->
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0-rc
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="gambar.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
