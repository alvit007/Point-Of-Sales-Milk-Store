<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveproduct.php" method="post" enctype="multipart/form-data">
  <center><h4><i class="icon-plus-sign icon-large"></i> Add Product</h4></center>
  <hr>
  <div id="ac">
    <span>Brand Name : </span><input type="text" style="width:265px; height:30px;" name="merk" ><br>
    <span>Generic Name : </span><input type="text" style="width:265px; height:30px;" name="nama" Required/><br>
    <span>Image : </span><input type="file" name="images" style="width:265px; height:50px;"><br><br>
    <span>Date Arrival: </span><input type="date" style="width:265px; height:30px;" name="tanggal_datang" /><br>
    <span>Expiry Date : </span><input type="date" value="<?php echo date ('M-d-Y'); ?>" style="width:265px; height:30px;" name="expire" /><br>
    <span>Selling Price : </span><input type="text" id="txt1" style="width:265px; height:30px;" name="harga" onkeyup="sum();" Required><br>
    <span>Original Price : </span><input type="text" id="txt2" style="width:265px; height:30px;" name="harga_modal" onkeyup="sum();" Required><br>
    
    </select><br>
    <span>Quantity : </span><input type="number" style="width:265px; height:30px;" min="0" id="txt11" onkeyup="sum();" name="qty" Required ><br>
    <span></span><input type="hidden" style="width:265px; height:30px;" id="txt22" name="qty_terjual" Required ><br>
    <div style="float:right; margin-right:10px;">
	<button class="btn btn-success btn-block btn-large" style="width:267px; margin-top: 10px;"><i class="icon icon-save icon-large"></i> Save</button>
    </div>
  </div>
</form>
