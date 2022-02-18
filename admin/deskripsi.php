<?php 
include "config.php";
$deskripsi = query("SELECT  nama, deskripsi FROM barang");
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TOKO MAJU GERAK</title>

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
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!--  -->
<div class="btn-group" role="group" aria-label="Basic example">
  <link rel="stylesheet" type="text/css" href="tambah.php">
  <button type="button" class="btn btn-primary ml-4">Tambah Barang</button>

</div>
        <!-- /.row -->
        <div class="row mt-3 ml-2">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Barang</h3>

                <!--  -->
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Barang</th>
                      <th>Deskripsi</th>
                      <th>Action</th>
                    </tr>
                    <tbody>
                      <?php
                        $a=1;
                      ?>
                      <?php
                        foreach ($deskripsi as $desc):
                      ?>
                      <tr>
                        <td><?= $a?></td>
                        <td><?= $desc ['nama'];?></td>
                        <td><?= $desc ['deskripsi'];?></td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-success mr-2" href="ubah.php?id=<?= $edit['id'];?>" role="bottom">Edit</a>
                          </div>
                        </td>
                      </tr>
                      <?php $a++;?>
                    <?php endforeach;?>
                    </tbody>
                  </thead>               
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
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
