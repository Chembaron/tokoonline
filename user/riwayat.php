<?php
session_start();
include_once "config.php";

$uid = $_SESSION["uid"];
$cart = query("SELECT p.id_transaksi, b.date, b.id_user, p.total_pembelian, b.status, p.id_barang, g.nama,b.id FROM pembelian AS p 
INNER JOIN pembayaran AS b ON b.id_transaksi = p.id_transaksi 
INNER JOIN barang as g ON g.id = p.id_barang WHERE b.id_user = $uid GROUP BY b.id_transaksi");
$history = query("SELECT * FROM pembayaran WHERE id_user = $uid");
$dsn = '';
$harga = '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>TOKO MAJU GERAK | Cart</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="Type your keyword...">
                            <button type="submit"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix" id="cartList">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <?php
        include_once 'header.php';
        ?>
        <!-- Header Area End -->
        <div class="amado_product_area section-padding-100 mx-auto">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="container card shadow overflow-hidden p-5 m-auto" style="width: 100%;">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">ID Transaksi</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Barang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $a = 1;
                                    ?>
                                    <?php
                                    foreach ($cart as $data) :    
                                    ?>
                                    <?php
                                        $transaksi = $data["id_transaksi"];
                                        $datariwayat = query("SELECT b.nama, b.id FROM barang AS b INNER JOIN pembelian AS p ON b.id = p.id_barang WHERE p.id_transaksi = $transaksi");
                                    ?>
                                        <tr>
                                            <input type="hidden" value="<?= $data["id_transaksi"] ?>">                                          
                                                <th scope="row"><?= $a ?></th>
                                                <td><?= $data["id_transaksi"] ?></td>
                                                <td><?= $data["status"] ?></td>
                                                <td>
                                                    <a class="amado-btn-group mr-1" href="ubahdatabeli.php?id=<?= $data["id"]; ?>" role="button" onclick="return confirm('Yakin barang sudah diterima?')"><i class="fa fa-edit">Edit</i></a>
                                                    <a class="amado-btn-group mr-1" href="hapusdatabeli.php?id=<?= $data["id"]; ?>" role="button" onclick="return confirm('Yakin ingin menghapus history?')"><i class="fa fa-trash"></i>Hapus</a>
                                                </td>
                                            <td>
                                                <ul>
                                                    <?php foreach($datariwayat as $riw): 
                                                    ?>
                                                    <li><a href="productdetails.php?id=<?= $riw['id']?>" style="font-size : medium"><?= $riw['nama'];?></a><li>
                                                    <?php endforeach;
                                                    ?>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php
                                        $a++;
                                        ?>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <!-- ##### Newsletter Area Start ##### -->
    <section class="newsletter-area section-padding-100-0">
        <div class="container">
            <div class="row align-items-center">
                <!-- Newsletter Text -->
                <div class="col-12 col-lg-6 col-xl-7">
                    <div class="newsletter-text mb-100">
                        <h2>Subscribe for a <span>25% Discount</span></h2>
                        <p>Nulla ac convallis lorem, eget euismod nisl. Donec in libero sit amet mi vulputate consectetur. Donec auctor interdum purus, ac finibus massa bibendum nec.</p>
                    </div>
                </div>
                <!-- Newsletter Form -->
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="newsletter-form mb-100">
                        <form action="#" method="post">
                            <input type="email" name="email" class="nl-email" placeholder="Your E-mail">
                            <input type="submit" value="Subscribe">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Newsletter Area End ##### -->

    <!-- ##### Footer Area Start ##### -->
    <?php
    include_once 'footer.php';
    ?>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
    <script src="qty.js"></script>
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>

</body>

</html>