<?php
include 'config.php';
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$uid = $_SESSION['uid'];
$cart = query("SELECT b.nama, b.stok, c.kuantitas, b.image, b.harga, c.id
FROM user AS u 
INNER JOIN cart AS c ON c.user_id = u.id 
INNER JOIN barang AS b ON b.id=c.id_produk WHERE u.id='$uid'");
$res = mysqli_query($koneksi, "SELECT SUM(harga * kuantitas) FROM user AS u 
INNER JOIN cart AS c ON c.user_id=u.id 
INNER JOIN barang AS b ON b.id=c.id_produk WHERE u.id='$uid'");
$row = mysqli_fetch_row($res);
$sum = $row[0];
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

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama barang</th>
                                        <th>Harga</th>
                                        <th>Quantity</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $acart) : ?>

                                        <tr>
                                            <td class="cart_product_img">
                                                <a href="#"><img src="../admin/img/<?= $acart["image"] ?>" alt="Product"></a>
                                            </td>
                                            <td class="cart_product_desc">
                                                <h5><?= $acart["nama"] ?></h5>
                                            </td>
                                            <td class="price">
                                                <span><?= number_format($acart["harga"]); ?></span>
                                            </td>
                                            <td class="qty">
                                                <div class="qty-btn d-flex">

                                                    <div class="quantity">
                                                        <style>
                                                            input[type=number]::-webkit-outer-spin-button {
                                                                -webkit-appearance: none;
                                                                -moz-appearance: none;
                                                                appearance: none;
                                                                margin: 0;
                                                            }

                                                            .halo {
                                                                outline: none;
                                                            }
                                                        </style>
                                                        <input class="form-control" onblur="qty(this)" style="text-align:center;" id="<?php echo $acart['id']; ?>" type="number" min="1" max="<?= $acart['stok']?>" value="<?php echo $acart['kuantitas']; ?>">
                                                        <a class="" href="hapus.php?id=<?= $acart["id"]; ?>" role="button" onclick="return confirm('Yakin ingin menghapus?')">
                                                            <p style="display: inline; padding: 0%;"><i class="fa fa-trash"></i></p>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>
                            <ul class="summary-table">
                                <li><span>subtotal:</span> <span>Rp <?= number_format($sum); ?></span></li>
                            </ul>
                            <div class="cart-btn mt-100">
                                <a href="checkout.php" class="btn amado-btn w-100">Checkout</a>
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