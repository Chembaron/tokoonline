<?php 
session_start();
include_once "config.php";
if(!isset($_SESSION["login"])){
  header("Location: ../user/login.php");
  exit;
}
if (isset($_POST['simpan'])) {
  if (add($_POST) > 0) {
    # code...
  }
}
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
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php 
    include 'header.php';
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Toko Maju Gerak</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander The Great</a>
        </div>
      </div>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
      </div>

      <!-- Sidebar Menu -->
      <?php
        include 'sidebar.php';
      ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

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
        <form action="" method="POST" enctype="multipart/form-data" >
          <div class="row">
            <div class="col-lg-12 overflow-auto p-4" style="height: 520px" id="ams">
              <h4 class="mb-3 text-primary">Tambah barang</h4>
              
              <div class="form-floating mb-3 mt-5">
                <label for="nama">Nama barang</label>
                <input type="text" name="nama" autocomplete="off" class="form-control" id="nama">
              </div>
              <div class="form-floating mb-3">
                <label for="stok">Stok</label>
                <input type="number" name="stok" autocomplete="off" class="form-control" id="stok">
              </div>
              <div class="form-floating mb-3">
                <label for="harga">Harga Barang</label>
                <input type="number" name="harga" autocomplete="off" class="form-control" id="harga">
              </div>
              <div class="form-floating mb-3">
                <label for="deskripsi">Tambah Deskripsi</label>
                <input type="text" name="deskripsi" autocomplete="off" class="form-control" id="deskripsi">
              </div>
              <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="image" autocomplete="off" onchange="readURL(this);" style="max-width: 150px">
                <img id="blah" src="http://placehold.it/180" alt="your image">
              </div>
              <div class="form-floating mb-3">
                <label for="kategori">Kategori</label>
                <select id="kategori" class="form-control" name="kategori" required>
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
  <?php
    include 'footer.php';
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="gambar.js"></script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
