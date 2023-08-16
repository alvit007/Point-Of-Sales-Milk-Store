<?php

session_start();
include "koneksi.php";

function runQuery($query) {
    include "koneksi.php";
    $result = mysqli_query($koneksi,$query);
    while($row=mysqli_fetch_assoc($result)) {
        $resultset[] = $row;
    }		
    if(!empty($resultset))
        return $resultset;
}

if (isset($_GET["action"]) && $_GET["action"] == "add") {
    if (!empty($_GET["name"])) {

        $productByCode = runQuery("SELECT * FROM table_barang WHERE nama_barang='" . $_GET["name"] . "'");
        $itemArray = array(
            $productByCode[0]["nama_barang"] => array(
                'id' => $productByCode[0]["id_barang"],
                'name' => $productByCode[0]["nama_barang"],
                'merk' => $productByCode[0]["merk_barang"],
                'qty' => 1,
                'price' => $productByCode[0]["harga_barang"],
                'img' => $productByCode[0]["gambar_barang"]
            )
        );

        if (!empty($_SESSION["cart_item"])) {
            if (array_key_exists($productByCode[0]["nama_barang"], $_SESSION["cart_item"])) {
                // ID barang sudah ada di keranjang, tampilkan pesan
                echo "Barang sudah ada di keranjang.";
            } else {
                // ID barang belum ada di keranjang, tambahkan ke keranjang
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
            }
        } else {
            // Keranjang kosong, tambahkan barang pertama ke keranjang
            $_SESSION["cart_item"] = $itemArray;
        }
    }
} elseif (isset($_GET["action"]) && $_GET["action"] == "remove") {
    foreach ($_SESSION['cart_item'] as $k => $v) {
        if ($v['name'] == $_GET['name']) {
            unset($_SESSION["cart_item"][$k]);
            break; // Add a break statement to exit the loop after removing the item
        }
    }
    if (empty($_SESSION["cart_item"])) {
        unset($_SESSION["cart_item"]);
    }
    header('Location: view_cart.php');
    exit; // Add an exit statement after redirecting
}

 if (isset($_POST["update_quantity"])) {
    if (!empty($_SESSION["cart_item"])) {
        foreach ($_SESSION["cart_item"] as $k => $v) {
            if ($v["name"] == $_POST["update_quantity_name"]) {
                $_SESSION["cart_item"][$k]["qty"] = $_POST["quantity"];
                header('Location: view_cart.php');
                break;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Milky Baby - Shop Cart Page</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="cache-control" content="no-cache" />

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
                    <input type="text" class="form-control" id="inputModalSearch" name="search"
                        placeholder="Search ..." />
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cart Container -->
    <?php
if (isset($_SESSION["cart_item"])) {
    $total_price = 0;
    $total_quantity = 0;
?>

    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Produk</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach ($_SESSION["cart_item"] as $item) {
                        $item_subtotal = $item["qty"] * $item["price"];
                        ?>
                        <tr>
                            <td scope="row"><img src="admin/uploads/<?php echo $item['img']; ?>"
                                    class="img-fluid mx-auto" alt="" style="width: 50px;">
                            </td>
                            <td scope="row"><?php echo $item["merk"]; echo "<br>" . $item["name"] ?></td>
                            <td scope="row">
                                <form action="view_cart.php" method="post">
                                    <input type="hidden" name="update_quantity_name"
                                        value="<?php echo $item['name']; ?>">
                                    <input type="number" name="quantity" min="1" value="<?php echo $item["qty"]; ?>">
                                    <input type="submit" value="Update" name="update_quantity" class="btn-default ">
                                </form>
                            </td>
                            <td scope="row"><?php echo "Rp" . number_format($item_subtotal, 0); ?></td>
                            <td scope="row">
                                <button type="button" class="btn btn-danger">
                                    <a class="text-decoration-none text-white"
                                        href="view_cart.php?action=remove&name=<?php echo $item["name"]; ?>">Delete</a>
                                </button>
                            </td>
                        </tr>

                        <?php
                        $total_quantity += $item["qty"];
                        $total_price += ($item["price"] * $item["qty"]);
                    }
                    ?>
                        <tr>
                            <td colspan="2"><?php echo "Total : Rp" . number_format($total_price, 0); ?></td>
                            <td colspan="2"><?php echo "Total Qty : " . $total_quantity; ?></td>
                            <td>
                                <form action="place_order.php" method="post">
                                    <button type="submit" class="btn btn-success text-white mt-2"
                                        name="place_order">Place Order</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
}
?>
    <!-- Footer -->
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

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>