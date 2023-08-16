<?php

include "koneksi.php";
session_start();

function runQuery($query) {
    include "koneksi.php";
    $result = mysqli_query($koneksi,$query);
    while($row=mysqli_fetch_assoc($result)) {
        $resultset[] = $row;
    }		
    if(!empty($resultset))
        return $resultset;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Milky Baby - Product Listing Page</title>
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
    <!-- Close Header -->

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

    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6 pb-4">
                        <div class="d-flex">
                            <select class="form-control">
                                <option>Featured</option>
                                <option>A to Z</option>
                                <option>Item</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
    $queryCount = "SELECT COUNT(*) AS total FROM table_barang";
    $resultCount = mysqli_query($koneksi, $queryCount);
    $rowCount = mysqli_fetch_assoc($resultCount);
    $totalData = $rowCount['total'];

    // Jumlah data yang ditampilkan per halaman
    $dataPerPage = 3;

    // Mendapatkan jumlah total halaman
    $totalPages = ceil($totalData / $dataPerPage);

    // Mendapatkan halaman saat ini (jika tidak ada, set ke halaman pertama)
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    // Mengatur batasan awal dan akhir data yang akan ditampilkan
    $start = ($currentPage - 1) * $dataPerPage;

    // Mengambil data produk sesuai halaman saat ini
    $product_array = runQuery("SELECT * FROM table_barang ORDER BY id_barang ASC LIMIT $start, $dataPerPage");

    if (!empty($product_array)) {
        foreach ($product_array as $key => $value) {
            ?>
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <form
                                action="view_cart.php?action=add&name=<?php echo $product_array[$key]["nama_barang"]; ?>"
                                method="post">
                                <input type="hidden" name="id" value="<?php echo $product_array[$key]["id_barang"]; ?>">
                                <div class="card rounded-0">
                                    <img class="card-img rounded mx-auto d-block img-fluid img-responsive"
                                        src="admin/uploads/<?php echo $product_array[$key]["gambar_barang"]; ?>" />
                                    <input type="hidden" name="img"
                                        value="<?php echo $product_array[$key]["gambar_barang"]; ?>">
                                </div>
                                <div class="card-body">
                                    <h3 class="h3"><?php echo $product_array[$key]["merk_barang"] ?></h3>
                                    <input type="hidden" name="merk"
                                        value="<?php echo $product_array[$key]["merk_barang"]; ?>">
                                    <ul class="w-100 list-unstyled d-flex justify-content-between mb-1">
                                        <li class="namabrg"><?php echo $product_array[$key]["nama_barang"] ?></li>
                                        <input type="hidden" name="nama"
                                            value="<?php echo $product_array[$key]["nama_barang"]; ?>">
                                    </ul>
                                    <p class="mb-1"><?php echo "Rp". number_format($product_array[$key]["harga_barang"],0) ?></p>
                                    <input type="hidden" name="harga"
                                        value="<?php echo number_format($product_array[$key]["harga_barang"],0); ?>">
                                    <div class="d-flex justify-content-between align-items-center mb-0">
                                        <button type="submit" class="btn btn-success text-white mt-2" name="cart"><i
                                                class="fas fa-cart-plus"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
        }
    }
    ?>
                </div>

            </div>
            <div div="row">
                <ul class="pagination pagination-lg justify-content-end">
                  <?php
                    for ($page = 1; $page <= $totalPages; $page++) {
                        echo "<li class='page-item" . ($page == $currentPage ? " active" : "") . "'>";
                        echo "<a class='page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0' href='shop.php?page=$page'>$page</a>";
                        echo "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Start Footer -->
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
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>