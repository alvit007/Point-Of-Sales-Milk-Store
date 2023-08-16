<?php error_reporting(E_ALL);
ini_set('display_errors', 1);?>
<html>
<head>
    <title> Admin - Barang</title>

    <?php require_once('auth.php'); ?>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/application.js" type="text/javascript" charset="utf-8"></script>
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
                loadingImage: 'src/loading.gif',
                closeImage: 'src/closelabel.png'
            });
        });
    </script>
</head>
<body>
    <?php include('navfixed.php');?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li><a href="index.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li>
                        <li class="active"><a href="products.php"><i class="icon-list-alt icon-2x"></i> Products</a></li>
                        <li><a href="salesreport.php"><i class="icon-bar-chart icon-2x"></i> Sales Report</a></li>
                    </ul>
                </div><!--/.well -->
            </div><!--/span-->
            <div class="span10">
                <div class="contentheader">
                    <i class="icon-table"></i> Products
                </div>
                <ul class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li> /
                    <li class="active">Products</li>
                </ul>

                <div style="margin-top: -19px; margin-bottom: 21px;">
                    <a href="index.php">
                        <button class="btn btn-default btn-large" style="float: left;">
                            <i class="icon icon-circle-arrow-left icon-large"></i> Back
                        </button>
                    </a>
                    <?php
                    include('../connect.php');
                    $result = $db->prepare("SELECT * FROM table_barang ORDER BY id_barang DESC");
                    $result->execute();
                    $rowcount = $result->rowcount();
                    ?>
                    <div style="text-align:center;">
                        Total Number of Products:
                        <font color="green" style="font:bold 22px 'Aleo';"> [<?php echo $rowcount;?>]</font>
                    </div>
                </div>
                <a rel="facebox" href="addproduct.php">
                    <button type="submit" class="btn btn-info" style="float:right; width:230px; height:35px;">
                        <i class="icon-plus-sign icon-large"></i> Add Product
                    </button>
                </a><br><br>
                <table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
                    <thead>
                        <tr>
                            <th width="12%">Brand Name</th>
                            <th width="14%">Generic Name</th>
                            <th width="13%">Gambar</th>
                            <th width="9%">Date Received</th>
                            <th width="10%">Expiry Date</th>
                            <th width="6%">Original Price</th>
                            <th width="6%">Selling Price</th>
                            <th width="6%">QTY</th>
                            <th width="8%">Total</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('../connect.php');
                        $result = $db->prepare("SELECT *, harga_barang * qty as total FROM table_barang ORDER BY id_barang DESC");
                        $result->execute();
                        for($i=0; $row = $result->fetch(); $i++){
                            $total = $row['total'];
                        ?>
                        <?php
                        include('../connect.php');
                        $id_barang = $row['id_barang'];
                        $imageQuery = "SELECT gambar_barang FROM table_barang WHERE id_barang = '$id_barang'";
                        $imageResult = $db->query($imageQuery);
                        ?>
                        <tr>
                            <td><?php echo $row['merk_barang']; ?></td>
                            <td><?php echo $row['nama_barang']; ?></td>
                            <?php
                            if ($imageResult && $imageResult->rowCount() > 0) {
                                $imageRow = $imageResult->fetch(PDO::FETCH_ASSOC);
                                $imagePath = '../uploads/' . $imageRow['gambar_barang'];
                                if (file_exists($imagePath)) {
                                    echo '<td><img src="' . $imagePath . '" alt="Product Image"></td>';
                                } else {
                                    echo '<td>Gambar tidak ditemukan.</td>';
                                }
                            } else {
                                echo '<td>Gambar tidak ditemukan.</td>';
                            }
                            ?>
                            <td><?php echo $row['tanggal_datang']; ?></td>
                            <td><?php echo $row['tanggal_expire']; ?></td>
                            <td><?php echo number_format($row["hargamodal_barang"], 0); ?></td>
                            <td><?php echo number_format($row["harga_barang"], 0); ?></td>
                            <td><?php echo $row['qty']; ?></td>
                            <td><?php echo number_format($row["total"], 0); ?></td>
                            <td>
                                <a rel="facebox" title="Click to edit the product" href="editproduct.php?id=<?php echo $row['id_barang']; ?>">
                                    <button class="btn btn-warning"><i class="icon-edit"></i></button>
                                </a>
                                <a href="#" id="<?php echo $row['id_barang']; ?>" class="delbutton" title="Click to Delete the product">
                                    <button class="btn btn-danger"><i class="icon-trash"></i></button>
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".delbutton").click(function() {
                //Save the link in a variable called element
                var element = $(this);
                //Find the id of the link that was clicked
                var del_id = element.attr("id");
                //Built a url to send
                var info = 'id=' + del_id;
                if (confirm("Sure you want to delete this Product? There is NO undo!")) {
                    $.ajax({
                        type: "GET",
                        url: "deleteproduct.php",
                        data: info,
                        success: function() {}
                    });
                    $(this).parents(".record").animate({
                            backgroundColor: "#fbc7c7"
                        }, "fast")
                        .animate({
                            opacity: "hide"
                        }, "slow");
                }
                return false;
            });
        });
    </script>
</body>
</html>
