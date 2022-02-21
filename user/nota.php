<?php
include 'config.php';

session_start();

// include_once "fbeli.php";
$uid = $_SESSION["uid"];
$query = mysqli_query($koneksi, "SELECT o.id_user, p.id_pembelian, p.total_pembelian, p.tanggal, o.kota, o.ongkir, o.estimasi, o.nama_user, o.alamat, o.no_telephone
FROM pembelian AS p INNER JOIN ongkir AS o ON o.id_user = p.id_ongkir WHERE p.id_user = $uid");
$nota = mysqli_fetch_assoc($query);

$cart = query("SELECT b.nama, c.kuantitas, b.image, b.harga, c.id, b.stok FROM user AS u 
INNER JOIN cart AS c ON c.user_id = u.id 
INNER JOIN barang AS b ON b.id = c.id_produk WHERE u.id = '$uid'");
$tt = date("dmys");
$id_transaksi = $tt . $uid;
if (isset($_POST["submit"])) {
    if (sold($_POST) > 0) {
        echo "<script>alert('data berhasil ditambahkan');</script> ";
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
                            <table style="margin-bottom: 10px;">
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?= $nota["nama_user"] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $nota['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <td>No. Hp</td>
                                    <td>: <?= $nota['no_telephone']; ?></td>
                                </tr>
                                <tr>
                                    <td>Distrik</td>
                                    <td>: <?= $nota['kota']; ?></td>
                                </tr>
                            </table>
                            <form action="" method="post">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Sub Harga</th>
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
                                            $total = $data["kuantitas"] * $data["harga"];
                                            ?>
                                            <tr>
                                                <th scope="row"><?= $a ?></th>

                                                <input type="hidden" value="<?= $uid ?>" name="userid">
                                                <input type="hidden" value="proses" name="status">
                                                <input type="hidden" value="<?= $nota['id_pembelian']; ?>" name="transaksi">
                                                <input type="hidden" value="<?= $data['nama']; ?>" name="produk[]">
                                                <input type="hidden" value="<?= $data['kuantitas'] ?>" name="stokdibeli[]">
                                                <td><?= $data['nama']; ?></td>
                                                <td><?= $data['kuantitas']; ?></td>
                                                <td>Rp <?= number_format($total) ?> </td>
                                            </tr>
                                            <?php
                                            $a++;
                                            ?>
                                        <?php
                                        endforeach;
                                        ?>


                                        <tr class="">
                                            <th colspan="3">Total</th>
                                            <th>Rp <?= number_format($nota['total_pembelian']) ?> </th>
                                        </tr>
                                        <tr class="">
                                            <th colspan="3">Ongkir</th>
                                            <th>Rp <?= number_format($nota['ongkir']) ?> </th>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <button type="submit" class="amado-btn" name="submit">Submit</button>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
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
    <!-- Plugins js -->
    <!-- <script src="js/plugins.js"></script> -->
    <!-- Active js -->
    <!-- <script src="js/active.js"></script> -->
    <!-- -->

    <!-- -->

</body>

</html>