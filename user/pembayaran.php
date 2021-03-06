<?php
include 'config.php';

session_start();


$uid = $_SESSION["uid"];
$query = mysqli_query($koneksi, "SELECT o.id_user, p.id, o.id_transaksi, p.total_pembelian, p.tanggal, o.kota, o.ongkir, o.estimasi, o.nama_user, o.alamat, o.no_hp
FROM pembelian AS p INNER JOIN ongkir AS o ON o.id_transaksi = p.id_transaksi WHERE p.id_user = $uid");
$nota = mysqli_fetch_assoc($query);

$alamat = $nota["alamat"] . " " . $nota["kota"];
$cart = query("SELECT b.nama, c.kuantitas, b.image, b.harga, b.id, b.stok FROM user AS u
 INNER JOIN cart AS c ON c.user_id = u.id
 INNER JOIN barang AS b ON b.id = c.id_produk WHERE u.id = $uid");
$stok = query("SELECT * FROM barang AS b INNER JOIN cart AS c ON b.id = c.id_produk WHERE c.user_id = $uid");
$tt = date("dmys");
$id_transaksi = $tt . $uid;
if (isset($_POST["submit"])) {
    if (buktibayar($_POST) > 0 & tambah($_POST) > 0) {
        echo "<script>alert('Barang segera diantar');
        document.location.href = 'cart.php';</script> ";
    } else {
        echo "<script>alert('data gagal ditambahkan');</script> ";
    }
}

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
    <title>Amado - Furniture Ecommerce Template | Checkout</title>

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
    <div class="main-content-wrapper d-flex clearfix">

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

        <!-- Header Area End -->
        <div class="amado_product_area section-padding-100 mx-auto">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="container card shadow overflow-hidden p-5 m-auto" style="width: 100%;">
                            
                        <div class="cart-title text-center">
                                <h2>Form Pembayaran</h2>
                            </div>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <input type="hidden" class="form-control" id="userid" value="<?= $uid ?>" placeholder="id" name="userid">
                                        <input type="hidden" name="status" value="pengemasan">
                                        <input type="hidden" value="<?= $alamat ?>" name="alamat">
                                        <?php
                                        foreach ($stok as $qty) :
                                        ?>
                                            <input type="hidden" name="sbelum[]" id="sbelum" value="<?= $qty['stok']?>">
                                        <?php
                                        endforeach;
                                        ?>
                                          <?php
                                        foreach ($cart as $data) :
                                        ?>
                                            <input type="hidden" value="<?= $data['id']?>" name="produk_id[]">
                                            <input type="hidden" value="<?= $data['nama']?>" name="produk[]">
                                            <input type="hidden" value="<?= $data['kuantitas']?>" name="stokdibeli[]">
                                            <?php
                                            $stokbaru = $data["stok"] - $data["kuantitas"];
                                            ?>
                                            <input type="hidden" value="<?= $stokbaru ?>" name="stokbaru[]">
                                        <?php
                                        endforeach;
                                        ?>
                                        <input type="hidden" value="<?= $nota["id_transaksi"] ?>" name="id_transaksi">
                                    </div>
                                    <style>
                                        .halo .w-100 {
                                            background-color: #F5F7FA;
                                            border: none;
                                            height: 60px;
                                            color: #676A94;
                                            padding-left: 30px;
                                            font-size: 14px;
                                            border-radius: none;
                                            outline-style: hidden;
                                        }

                                        .halo .w-100:focus {
                                            outline: none !important;
                                            border-color: aqua;
                                            box-shadow: 0 0 0 2px #BFDEFF;
                                        }
                                    </style>
                                    <div class="col-md-12 mb-3 halo">
                                        <label for="gambar">Kirim Foto Bukti Pembayaran:</label>
                                        <input type="file" class="form-control" id="gambar" name="image" autocomplete="off" onchange="readURL(this);" style="max-width: 150px;">
                                        <img id="blah" src="http://placehold.it/180" alt="your image" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <img src="../qrcode.png" alt="" style="max-width: 100px; display: inline-block;">
                                    </div>
                                    <button type="submit" class="amado-btn" name="submit" style="display: inline-block;">Submit</button>
                                    <div class="col-12">
                                    </div>
                                </div>
                            </form>
                        </div>
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
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <!-- <script src="js/popper.min.js"></script> -->
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <script src="gambar.js"></script>
    <!-- Plugins js -->
    <!-- <script src="js/plugins.js"></script> -->
    <!-- Active js -->
    <!-- <script src="js/active.js"></script> -->
    <!-- -->

    <!-- -->

</body>

</html>