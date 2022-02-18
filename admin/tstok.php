<?php 
include_once "config.php";
$id = $_GET["id"];
$edit = stok("SELECT * FROM barang  WHERE id = $id")[0];
if (isset($_POST['simpan'])) {
  if (tambahs($_POST) > 0) {
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
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
 <?
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
        <form action="" method="POST">
          <div class="row">
            <div class="col-lg-12 overflow-auto p-4" style="height: 520px" id="ams">
              <h4 class="mb-3 text-primary">Tambah barang</h4>
              <input type="hidden" name="id_barang" value="<?= $edit["id"];?>">
              <div class="form-floating mb-3 mt-5">
                <label for="stok_sebelum" class="form-label">Stok Sebelum</label>
                <input type="text" name="stok_sebelum" class="form-control" id="stok_sebelum" value="<?= $edit['stok'];?>" disabled required>
                <input type="hidden" name="stok_sebelum" class="form-control" id="stok_sebelum" value="<?= $edit['stok'];?>" required>
              </div>
              <div class="form-floating mb-3">
                <label for="stok_ditambah" class="form-label">Stok Ditambah</label>
                <input type="number" name="stok_ditambah" class="form-control" id="stok_ditambah"  required>
              </div>
              <div class="form-floating mb-3">
                <input type="hidden" name="stok_sesudah" class="form-control" id="stok_sesudah"  required>
              </div>
              <!-- <div class="form-floating mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="number" name="id_barang" class="form-control" id="id_barang" value="<?= $edit['id'];?>" required>
              </div> -->
              <div class="form-group">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal" required>
              </div>
            </div>
          </div>
          <div class="col-12" action="POST">
            <input type="submit" name="simpan" value="simpan" class="btn-primary mr-3 mb-3">
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
