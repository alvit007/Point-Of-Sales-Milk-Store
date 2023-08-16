<?php
    session_start();
    include "koneksi.php";

    date_default_timezone_set('Asia/Jakarta');

    // Mendapatkan tanggal dan waktu sekarang
    $currentDateTime = new DateTime();
    $currentDateTime->setTimezone(new DateTimeZone('Asia/Jakarta')); // Ganti 'Your_Timezone' dengan zona waktu yang sesuai
    $currentDateTimeFormatted = $currentDateTime->format('Y-m-d H:i:s');

    // Menambahkan 1 jam ke waktu sekarang
    $modifiedDateTime = clone $currentDateTime;
    $modifiedDateTime->modify('+1 hour');
    $modifiedDateTimeFormatted = $modifiedDateTime->format('Y-m-d H:i:s');
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Milky Baby - Order Success Page</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="cache-control" content="no-cache" />

    <link rel="apple-touch-icon" href="/assets/img/milkybabylogo.png" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/milkybabylogo.png" />

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/templatemo.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />

    <!-- Load fonts style after rendering the layout styles -->
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css" />
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <p>
                        Halo,
                        <?php
            echo $_SESSION['nama'];                 
            ?>!
                    </p>
                </div>
                <div>
                    <a href="logout.php" class="logout-btn text-decoration-none text-light">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
                <img src="assets/img/milkybabylogo.png" alt="Milky Baby Logo" id="nav-logo" />
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between"
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Shop</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ..." />
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal"
                        data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="cart.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <!-- <span
                            class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"><?php echo $num_items_in_cart = isset($_SESSION['cart_item']) ? $total_quantity += $item["qty"] : 0;?></span> -->
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="profile.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                        <span
                            class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">+99</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="search"
                        placeholder="Search ..." />
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Container -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-9 d-flex justify-content-center">
                <h1 class="h1">Pembelian Berhasil!</h1>
                <?php
                    $query_order_success = mysqli_query($koneksi, "SELECT * FROM table_pembelian WHERE invoice = ".$_SESSION['invoice']);
                    if ($query_order_success && mysqli_num_rows($query_order_success) > 0) {
                        $row_order_success = mysqli_fetch_array($query_order_success);
                        ?>
                <table class="table">
                    <tr scope="row">
                        <td>No. Invoice</td>
                        <td>:</td>
                        <td><?php echo $row_order_success['invoice'] ?></td>
                    </tr>
                    <tr scope="row">
                        <td>Nama Pelanggan</td>
                        <td>:</td>
                        <td><?php echo $row_order_success['nama_pelanggan'] ?></td>
                    </tr>
                    <tr scope="row">
                        <td>No. Handphone</td>
                        <td>:</td>
                        <td><?php echo $row_order_success['no_hp'] ?></td>
                    </tr>
                    <tr scope="row">
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $row_order_success['alamat'] ?></td>
                    </tr>
                    <tr scope="row">
                        <td>Tgl. Pembelian</td>
                        <td>:</td>
                        <td><?php echo $row_order_success['tgl_pembelian'] ?></td>
                    </tr>
                    <tr scope="row">
                        <td>Metode Pembayaran</td>
                        <td>:</td>
                        <td>Cash On Delivery</td>
                    </tr>
                    <tr scope="row">
                        <td>Total Harga</td>
                        <td>:</td>
                        <td><?php echo number_format($row_order_success['total_harga'],0) ?></td>
                    </tr>
                    <tr scope="row">
                        <td>Estimasi Sampai</td>
                        <td>:</td>
                        <td><?php echo $modifiedDateTimeFormatted ?></td>
                    </tr>
                </table>
                <?php
                    }
                
                ?>
            </div>
        </div>
    </div>

    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">
                        Milky Baby
                    </h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            Cibungur, Bungursari, Kabupaten Purwakarta
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">021-123454321</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">
                        Further Info
                    </h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Home</a></li>
                        <li>
                            <a class="text-decoration-none" href="https://goo.gl/maps/DfoEvfAj1rcfPYL48"
                                target="_blank">Shop
                                Locations</a>
                        </li>
                        <li><a class="text-decoration-none" href="#">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i
                                    class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i
                                    class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2023 Toko Susu Mujur Jaya
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>