<?php
session_start();
include 'config.php';
$id =$_GET['id'];
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
$kategori = query('SELECT * FROM kategori_id');
$databarang = query("SELECT b.id, b.nama, b.stok, b.harga, k.kategori, b.image
  FROM barang AS b
  INNER join kategori_id AS k 
  ON b.kategori = k.id  ");
  $datapilihan = query("SELECT b.id, b.nama, b.stok, b.harga, k.kategori, b.image, b.kategori
   FROM barang AS b 
   JOIN kategori_id AS k ON b.kategori = k.id WHERE b.kategori = '$id'");
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
    <title>Amado - Furniture Ecommerce Template | Shop</title>

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
                        <?php foreach($kategori as $kt):?>
                            <li><a href="shop.php?id=<?= $kt["id"]; ?>"><?= $kt['kategori'];?></a></li>
                        <?php endforeach;?>
                        
                        
                    </ul>
                </div>
            </div>

            <!-- ##### Single Widget ##### -->

            <!-- ##### Single Widget ##### -->
            

            <!-- ##### Single Widget ##### -->
            
        </div>

        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <div class="total-products">
                                <p>Showing 1-8 0f 25</p>
                                <div class="view d-flex">
                                    <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                                    <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <!-- Sorting -->
                            <div class="product-sorting d-flex">
                                <div class="sort-by-date d-flex align-items-center mr-15">
                                    <p>Sort by</p>
                                    <form action="#" method="get">
                                        <select name="select" id="sortBydate">
                                            <option value="value">Date</option>
                                            <option value="value">Newest</option>
                                            <option value="value">Popular</option>
                                        </select>
                                    </form>
                                </div>
                                <div class="view-product d-flex align-items-center">
                                    <p>View</p>
                                    <form action="#" method="get">
                                        <select name="select" id="viewProduct">
                                            <option value="value">12</option>
                                            <option value="value">24</option>
                                            <option value="value">48</option>
                                            <option value="value">96</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Single Product Area -->
                    <?php foreach($datapilihan as $data):?>
                    <div class="col-12 col-sm-6 col-md-12 col-xl-6">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <a href="productdetails.php?id=<?= $data['id'];?>">
                            <div class="product-img">
                                <img src="../admin/img/<?= $data['image'];?>" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="img/product-img/product2.jpg" alt="">
                            </div>

                            <!-- Product Description -->
                            <div class="product-description d-flex align-items-center justify-content-between">
                                <!-- Product Meta Data -->
                                <div class="product-meta-data">
                                    <div class="line"></div>
                                    <p class="product-price">Rp <?php echo number_format($data['harga']); ?><p>
                                    
                                        <h6 style="letter-spacing: 1px;"><?= strtoupper($data["nama"]);  ?></h6>
                                </div>
                                <!-- Ratings & Cart -->
                                <div class="ratings-cart text-right">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                    <div class="cart">
                                        <a href="cart.php?id=<?= $data["id"]; ?>" data-toggle="tooltip" data-placement="left" title="Add to Cart"><img src="img/core-img/cart.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <?php endforeach;?>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                <li class="page-item active"><a class="page-link" href="#">01.</a></li>
                                <li class="page-item"><a class="page-link" href="#">02.</a></li>
                                <li class="page-item"><a class="page-link" href="#">03.</a></li>
                                <li class="page-item"><a class="page-link" href="#">04.</a></li>
                            </ul>
                        </nav>
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