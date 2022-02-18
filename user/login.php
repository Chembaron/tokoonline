<?php
session_start();
include 'config.php';
//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if( $key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}
//cek session
if(isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username ='$username'");
    $cek = mysqli_num_rows($result);
    if (mysqli_num_rows($result) === 1) {
        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            //set session
            $_SESSION["login"] = true;

            //cek remember me
            if(isset($_POST['remember'])){
                //cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
                // setcookie('login', 'true', time() + 60);
            }
                if($row['level'] == "admin"){
                    $_SESSION['username'] = $username;
                    $_SESSION['level'] = "admin";
                    header("Location: ../admin/index.php");
                    exit;

                }else if($row['level'] == "user"){
                    $_SESSION['uid'] = $row['id'];
                    $_SESSION['level'] = "user";
                    header("Location: index.php");
                    exit;
                }else{
                    header('Location: login.php');
                }
        }
    }
    $error = true;
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
    <title>Amado - Furniture Ecommerce Template | Product Details</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">

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

        <!-- Register page Start -->
        <div class="amado_product_area section-padding-100 mx-auto">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="container card shadow overflow-hidden p-5 m-auto" style="width: 100%;">
                            <h3 class="text-center">Menu Login</h3>
                            <hr />
                            <?php
                            if (isset($error)) :
                            ?>
                                <p style="color: red;">Data yang anda masukkan salah!</p>
                            <?php endif; ?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" onclick="showHiddenPassword(this)" class="form-control" id="password" name="password"/>
                                    <span><i class="fa-solid fa-eye" onclick="showHiddenPassword(this)"></i></span>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="remember">Remember me:</label>
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login" class="amado-btn">Login</button>
                                </div>
                                <a href="register.php">Belum punya akun? daftar sekarang</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Register page End-->
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
    <script src="pass.js"></script>
</body>

</html>