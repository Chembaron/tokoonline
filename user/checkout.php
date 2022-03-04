<?php
include 'config.php';
session_start();
$uid = $_SESSION['uid'];
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
}
$date = date("d-m-Y");
$var = $date.$uid;
$res = mysqli_query($koneksi, "SELECT SUM(harga * kuantitas) FROM user AS u 
INNER JOIN cart AS c ON c.user_id=u.id 
INNER JOIN barang AS b ON b.id=c.id_produk WHERE u.id='$uid'");
$row = mysqli_fetch_row($res);
$sum = $row[0];
$cart = query("SELECT b.nama, c.kuantitas, b.image, b.harga, b.id, b.stok FROM user AS u 
INNER JOIN cart AS c ON c.user_id = u.id INNER JOIN barang AS b ON b.id = c.id_produk WHERE u.id = '$uid'");



if (isset($_POST['submit'])) {
    if (checkout($_POST) > 0 & pembelian($_POST) > 0) {
        echo "<script>
        alert('data baru berhasil ditambahkan');
        </script>";
        header("Location: pembelian.php");
    }else{
        echo "<script>alert('data gagal ditambahkan');
        </script>";
        
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
        <?php
        include_once 'header.php';
        ?>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>Checkout</h2>
                            </div>

                            <form action="" method="POST">
                                <div class="row">
                                <input type="hidden" name="uit" value="<?= $var;?>">
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" name="no_hp" id="telp" placeholder="Telephone" >
                                    </div>
                                    
                                    <style>
                                        .saya .w-100 {
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
                                    <div class="col-12 mb-3 saya">
                                        <select class="w-100" name="nama_provinsi" id="">

                                        </select>
                                    </div>
                                    <div class="col-12 mb-3 saya">
                                        <select class="w-100" name="nama_distrik" id="">

                                        </select>
                                    </div>
                                    <div class="col-12 mb-3 saya">
                                        <select class="w-100" name="ekspedisi" id="">

                                        </select>
                                    </div>
                                    <div class="col-12 mb-3 saya">
                                        <select class="w-100" name="paket" id="">
                                        <!-- halo -->

                                        </select>
                                    </div>
                                    <?php
                                    foreach ($cart as $data) :
                                    ?>
                                        <input type="hidden" value="<?= $data["id"] ?>" name="produk_id[]">
                                        <input type="hidden" value="<?= $data["kuantitas"] ?>" name="qty[]">
                                    <?php
                                    endforeach;
                                    ?>
                                    <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    $id_transaksi = date("dmyHis") . $uid;

                                    ?>
                                    <div class="col-12 mb-3 saya">
                                        <input type="hidden" name="berat" value="1200">
                                        <input type="hidden" name="provinsi">
                                        <input type="hidden" name="distrik">
                                        <input type="hidden" name="tipe">
                                        <input type="hidden" name="kodepos">
                                        <input type="hidden" name="nama_ekspedisi">
                                        <input type="hidden" name="nama_paket">
                                        <input type="hidden" name="ongkir">
                                        <input type="hidden" name="id_transaksi" value="<?= $id_transaksi;?>">
                                        <input type="hidden" name="uid" value="<?= $uid;?>">
                                        <input type="hidden" name="uit" value="<?= $var;?>">
                                        <input type="hidden" name="sum" value="<?= $sum;?>">
                                        <input type="hidden" name="tgl" value="<?= $date;?>">
                                        <input type="hidden" name="estimasi">
                                        
                                    </div>

                                    <!-- <div class="col-12 mb-3">
                                        <textarea name="comment" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="Tinggalkan komentar tentang produk anda"></textarea>
                                    </div> -->
                                    
                                    
                                </div>
                                <div class="cart-btn mt-100">
                                    <button type="sumbit" name="submit" class="btn amado-btn w-100">Submit</button>
                                   
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary">
                            <h5>Cart Total</h5>

                            <div class="payment-method">
                                <!-- Cash on delivery -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="cod" checked>
                                    <label class="custom-control-label" for="cod">Cash on Delivery</label>
                                </div>
                                <!-- Paypal -->
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="paypal">
                                    <label class="custom-control-label" for="paypal">Paypal <img class="ml-15" src="img/core-img/paypal.png" alt=""></label>
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
    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'post',
                url: 'dataprovinsi.php',
                success: function(hasil) {
                    $("select[name=nama_provinsi]").html(hasil);
                }
            });
            $("select[name=nama_provinsi]").on("change", function() {
                var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
                $.ajax({
                    type: 'post',
                    url: "datadistrik.php",
                    data: 'id_provinsi=' + id_provinsi_terpilih,
                    success: function(hasil_distrik) {
                        $("select[name=nama_distrik]").html(hasil_distrik);
                    }
                });
            });
            $.ajax({
                type: 'post',
                url: 'dataekspedisi.php',
                success: function(hasil_ekspedisi) {
                    $("select[name=ekspedisi]").html(hasil_ekspedisi);
                }
            });
            $("select[name=ekspedisi]").on('change', function() {
                //ekspedisi
                var ekspedisi_terpilih = $("select[name=ekspedisi]").val();

                //id distrik
                var distrik_terpilih = $("option:selected", "select[name=nama_distrik]").attr("id_distrik");
                //total berat
                var total_berat = $("input[name=berat]").val();
                $.ajax({
                    type: 'post',
                    url: 'datapaket.php',
                    data: 'ekspedisi=' + ekspedisi_terpilih + '&distrik=' + distrik_terpilih + '&berat=' + total_berat,
                    success: function(hasil_paket) {
                        $("select[name=paket]").html(hasil_paket);
                        $("input[name=nama_ekspedisi]").val(ekspedisi_terpilih);
                    }

                })
            });
            $("select[name = nama_distrik]").on('change', function() {
                var prov = $("option:selected", this).attr("nama_provinsi");
                var dist = $("option:selected", this).attr("nama_distrik");
                var tipe = $("option:selected", this).attr("tipe_distrik");
                var kodepos = $("option:selected", this).attr("kode_pos");
                $("input[name=provinsi]").val(prov);
                $("input[name=distrik]").val(dist);
                $("input[name=tipe]").val(tipe);
                $("input[name=kodepos]").val(kodepos);


            });
            $("select[name=paket]").on("change", function() {
                var paket = $("option:selected", this).attr('paket');
                var ongkir = $("option:selected", this).attr('ongkir');
                var etd = $("option:selected", this).attr('etd');
                $("input[name=nama_paket]").val(paket);
                $("input[name=ongkir]").val(ongkir);
                $("input[name=estimasi]").val(etd);
            })

        });
    </script>

</body>

</html>