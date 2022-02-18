<?php
session_start();
 include 'config.php';
 if(!isset($_SESSION["login"])){
     header("Location: login.php");
     exit;
 }
 $datakategori = query("SELECT * FROM kategori_id");
 $databarang = query("SELECT b.id, b.nama, b.stok, b.harga, k.kategori, b.image
  FROM barang AS b
  INNER JOIN kategori_id AS k 
  ON b.kategori = k.id  ");
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
    <title>TOKO MAJU GERAK | Home</title>

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
        <?php
            include 'header.php';
        ?>
        <!-- Header Area End -->
        <div class="shop_sidebar_area">

            <!-- ##### Single Widget ##### -->
            <div class="widget catagory mb-50">
                <!-- Widget Title -->
                <h6 class="widget-title mb-30">Catagories</h6>

                <!--  Catagories  -->
                <div class="catagories-menu">
                    <ul>
                        <li><a href="index.php">All</a></li>
                        <?php foreach($datakategori as $dk):?>
                            <li><a href="shop.php?id=<?= $dk["id"]; ?>"><?= $dk['kategori'];?></a></li>
                        <?php endforeach;?>
                        
                        
                    </ul>
                </div>
            </div>
            
        </div>
        <!-- Product Catagories Area Start -->
        <div class="amado_product_area section-padding-100 clearfix">
            <div class="amado-pro-catagory clearfix">
                <?php
                foreach ($databarang as $data) :
                ?>
                    <!-- Single Catagory -->
                    <div class="single-products-catagory clearfix">
                        <a href="productdetails.php?id=<?= $data["id"]; ?>">
                            <img src="../admin/img/<?= $data['image'] ?>" alt="">
                            <!-- Hover Content -->
                            <div class="hover-content">
                                </style>
                                <div class="line"></div>
                                <p> Rp<?= number_format($data['harga']); ?></p>
                                <h4><?= $data['nama'] ?></h4>
                            </div>
                        </a>
                    </div>
                <?php
                endforeach;
                ?>


            </div>
        </div>
        <!-- Product Catagories Area End -->
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
        include 'footer.php';
    ?>
    <!-- ##### Footer Area End ##### -->

    <!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
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