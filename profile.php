<!DOCTYPE html>
<html lang="en">
<?php
include "koneksi.php";
?>

<head>
    <title>Milky Baby - Shop Cart Page</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="apple-touch-icon" href="assets/img/mb-favicon.png" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/mb-favicon.png" />

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
                      session_start();
            echo $_SESSION['nama'];                 
            ?>!
                    </p>
                </div>
                <div>
                    <a href="login.php" class="logout-btn text-decoration-none text-light">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
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
                    <a class="nav-icon position-relative text-decoration-none" href="view_cart.php">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="profile.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
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
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ..." />
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Profile -->
    <div class="container py-3">
        <div class="col-lg-16">
            <div class="card mb-4 ">
                <div class="card-body ">
                    <div class="row justify-content-md-center">
                        <div class="col-sm-2">
                            <p class="mb-0">ID Pelanggan</p>
                        </div>
                        <div class="col-sm-7">
                            <p class="text-dark mb-0"><?php echo $_SESSION['id_pelanggan'];?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">
                        <div class="col-sm-2">
                            <p class="mb-0">Nama</p>
                        </div>
                        <div class="col-sm-7">
                            <p class="text-dark mb-0"><?php echo $_SESSION['nama'];?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">
                        <div class="col-sm-2">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-7">
                            <p class="text-dark mb-0"><?php echo $_SESSION['email'];?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">
                        <div class="col-sm-2">
                            <p class="mb-0">Jenis Kelamin</p>
                        </div>
                        <div class="col-sm-7">
                            <p class="text-dark mb-0"><?php echo $_SESSION['jk'];?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">
                        <div class="col-sm-2">
                            <p class="mb-0">Nomor HP</p>
                        </div>
                        <div class="col-sm-7">
                            <p class="text-dark mb-0"><?php echo $_SESSION['no_hp'];?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row justify-content-md-center">
                        <div class="col-sm-2">
                            <p class="mb-0">Alamat</p>
                        </div>
                        <div class="col-sm-7">
                            <p class="text-dark mb-0"><?php echo $_SESSION['alamat'];?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Riwayat Pesanan-->
        <div class="container">
            <p id="success"></p>
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Your <b>Orders</b></h2>
                        </div>

                        <br>
                        <div id="mySpinner" style="display:none;position:relative;top:70px;width:70px;height:70px;"
                            class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th>Detail</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php
				

				$result = mysqli_query($koneksi,"SELECT invoice, tgl_pembelian, total_harga FROM table_pembelian WHERE id_pelanggan =".$_SESSION['id_pelanggan']);
					$i=1;
					while($row = mysqli_fetch_array($result)) {
				?>

                        <tr>

                            <td><?php echo $row["invoice"]; ?></td>
                            <td><?php echo $row["tgl_pembelian"]; ?></td>
                            <td><?php echo "Rp. ".number_format($row["total_harga"],0); ?></td>
                            <form action="details.php" method="POST">
                                <input type="hidden" name="viewDetailsID" value="<?php echo $row["invoice"] ; ?>">
                                <td><button type="submit" class="btn btn-primary">Lihat detail</button></td>
                            </form>


                        </tr>
                        <?php
				$i++;
				}
				?>
                    </tbody>
                </table>

            </div>
        </div>

        <!-- Start Script -->
        <script src="assets/js/jquery-1.11.0.min.js"></script>
        <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/templatemo.js"></script>
        <script src="assets/js/custom.js"></script>
        <!-- End Script -->
</body>

</html>