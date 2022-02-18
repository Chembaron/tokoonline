<?php 
include "config.php";
$databarang = query("SELECT b.id, b.nama, b.stok, b.harga, k.kategori, b.image
  FROM barang AS b
  INNER JOIN kategori_id AS k 
  ON b.kategori = k.id  ");
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
                      <th>Stok</th>
                      <th>Harga</th>
                      <th>Kategori</th>
                      <th>Gambar</th>
                      <th>Action</th>
                    </tr>
                    <tbody>
                      <?php
                        $a=1;
                      ?>
                      <?php
                        foreach ($databarang as $data):
                      ?>
                      <tr>
                        <td><?= $a?></td>
                        <td><?= $data ['nama'];?></td>
                        <td><?= $data ['stok'];?></td>
                        <td><?= $data ['harga'];?></td>
                        <td><?= $data ['kategori'];?></td>
                        <td><img style="max-width: 100px"src="img/<?= $data['image'];?>"></td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-success mr-2" href="ubah.php?id=<?= $data['id'];?>" role="bottom">Edit</a>
                            <a class="btn btn-danger" href="hapus.php?id=<?= $data['id'];?>" role="bottom">Hapus</a>
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
