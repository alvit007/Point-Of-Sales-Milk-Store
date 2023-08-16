<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM table_barang WHERE id_barang= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditproduct.php" method="post" enctype="multipart/form-data">
<center><h4><i class="icon-edit icon-large"></i> Edit Product</h4></center>
<hr>
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />
<span>Brand Name : </span><input type="text" style="width:265px; height:30px;"  name="merk" value="<?php echo $row['merk_barang']; ?>" Required/><br>
<span>Generic Name : </span><input type="text" style="width:265px; height:30px;"  name="nama" value="<?php echo $row['nama_barang']; ?>" /><br>
<span>Image : </span><input type="file" name="images" style="width:265px; height:50px;" value="<?php echo $gambar_barang; ?>"><br><br>
<span>Current Image : </span><input type="text" style="width:265px; height:30px;" value="<?php echo $row['gambar_barang']; ?>" readonly><br>
<span>Date Arrival: </span><input type	="date" style="width:265px; height:30px;" name="tanggal_datang" value="<?php echo $row['tanggal_datang']; ?>" /><br>
<span>Expiry Date : </span><input type	="date" style="width:265px; height:30px;" name="expire" value="<?php echo $row['tanggal_expire']; ?>" /><br>
<span>Selling Price : </span><input type="text" style="width:265px; height:30px;" id="txt1" name="harga" value="<?php echo $row['harga_barang']; ?>" onkeyup="sum();" Required/><br>
<span>Original Price : </span><input type="text" style="width:265px; height:30px;" id="txt2" name="harga_modal" value="<?php echo $row['hargamodal_barang']; ?>" onkeyup="sum();" Required/><br>
<span>QTY Left: </span><input type="number" style="width:265px; height:30px;" min="0" name="qty" value="<?php echo $row['qty']; ?>" /><br>
<span>Quantity: </span><input type="number" style="width:265px; height:30px;" min="0" name="qty_terjual" value="<?php echo $row['qty_terjual']; ?>" /><br>

<div style="float:right; margin-right:10px;">

<button class="btn btn-success btn-block btn-large" style="width:267px;"><i class="icon icon-save icon-large"></i> Save Changes</button>
</div>
</div>
</form>
<?php
}
?>