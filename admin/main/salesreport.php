<html>
<?php
    require_once('auth.php');
?>
<head>
    <title>Admin - Report</title>
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
    <link rel="stylesheet" type="text/css" href="tcal.css" />
    <script type="text/javascript" src="tcal.js"></script>
</head>

<body>
    <?php include('navfixed.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li><a href="index.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li>
                        <li><a href="products.php"><i class="icon-list-alt icon-2x"></i> Products</a></li>
                        <li class="active"><a href="salesreport.php"><i class="icon-bar-chart icon-2x"></i> Sales Report</a></li>
                    </ul>
                </div><!--/.well -->
            </div><!--/span-->
            <div class="span10">
                <div class="contentheader">
                    <i class="icon-bar-chart"></i> Sales Report
                </div>
                <ul class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li> /
                    <li class="active">Sales Report</li>
                </ul>

                <div style="margin-top: -19px; margin-bottom: 21px;">
                    <a href="index.php"><button class="btn btn-default btn-large" style="float: none;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
                </div>

                <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Tanggal Pembelian</th>
                            <th>Customer Name</th>
                            <th>Total Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('../connect.php');
                        $result = $db->prepare("SELECT * FROM table_pembelian ORDER by invoice ASC ");
                        $result->execute();
                        for ($i = 0; $row = $result->fetch(); $i++) {
                        ?>
                            <tr class="record">
                                <td><?php echo $row['invoice']; ?></td>
                                <td><?php echo $row['tgl_pembelian']; ?></td>
                                <td><?php echo $row['nama_pelanggan']; ?></td>
                                <td><?php echo "Rp. " . number_format($row["total_harga"], 0); ?></td>
                                <td>
                                    <a href="#" id="<?php echo $row['invoice']; ?>" class="delbutton" title="Click to Delete the product">
                                        <button class="btn btn-danger">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</body>
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
            if (confirm("Sure you want to delete this uptgl_pembelian? There is NO undo!")) {
                $.ajax({
                    type: "GET",
                    url: "deletesales.php",
                    data: info,
                    success: function() {

                    }
                });
                $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                    .animate({ opacity: "hide" }, "slow");
            }
            return false;
        });
    });
</script>
</html>