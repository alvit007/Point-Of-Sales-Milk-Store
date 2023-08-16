<!DOCTYPE html>
<html>

<head>
    <title> Admin - Dashboard </title>
    <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
    .sidebar-nav {
        padding: 9px 0;
    }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="lib/jquery.js" type="text/javascript"></script>
    <script src="src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('a[rel*=facebox]').facebox({
            loadingImage: 'src/loading.gif',
            closeImage: 'src/closelabel.png'
        })
    })
    </script>
    <?php
	require_once('auth.php');
?>
</head>

<body>
    <?php include('navfixed.php');?>
    <?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='admin') {
?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span2">
                <div class="well sidebar-nav">
                    <ul class="nav nav-list">
                        <li class="active"><a href="#"><i class="icon-dashboard icon-2x"></i> Dashboard </a></li>
                        <li><a href="products.php"><i class="icon-list-alt icon-2x"></i> Products</a> </li>
                        <li><a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i> Sales Report</a>
                        </li>
                    </ul>
                </div>
                <!--/.well -->
            </div>
            <!--/span-->
            <div class="span10">
                <div class="contentheader">
                    <i class="icon-dashboard"></i> Dashboard
                </div>
                <ul class="breadcrumb">
                    <li class="active">Dashboard</li>
                </ul>
                <font style=" font:bold 44px 'Calibri'; text-shadow:1px 1px 25px #000; color:#fff;">
                    <center>Admin Milky Baby</center>
                </font>
                <div id="mainmain">
                    <a href="products.php"><i class="icon-list-alt icon-2x"></i><br> Products</a>
                    <a href="salesreport.php?d1=0&d2=0"><i class="icon-bar-chart icon-2x"></i><br> Sales Report</a>
                    <a href="../index.php">
                        <font color="red"><i class="icon-off icon-2x"></i></font><br> Logout
                    </a>
                    <?php
}
?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>