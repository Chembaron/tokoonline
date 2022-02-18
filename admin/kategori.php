<?php 
include_once "config.php";
if (isset($_POST['simpan'])) {
  if (kategori($_POST) > 0) {
    echo "<script>
    alert('BERHASIL MENAMBAHKAN KATEGORI');
    document.location.href: 'tkategori.php';
    </script>";
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
      <div class="container card shadow overflow-hidden" style="width: 50%">
        <form action="" method="POST">
          <div class="row">
            <div class="col-lg-12 overflow-auto p-4" style="height: 320px" id="ams">
              <h4 class="mb-3 text-primary">Tambah kategori</h4>
              
              <div class="form-floating mb-3 mt-5">
                <label for="nama">Kategori</label>
                <input type="text" name="kategori" class="form-control" id="kategori" required>
              </div>
            </div>
          </div>
          <div class="col-12" action="POST">
            <input type="submit" name="simpan" value="simpan data" class="btn-primary mb-3">
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
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
