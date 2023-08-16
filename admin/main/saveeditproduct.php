<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['merk'];
$z = $_POST['nama'];
$b = $_FILES['images']['name'];  // Mengakses informasi file yang diunggah
$c = $_POST['expire'];
$d = $_POST['harga'];
$f = $_POST['qty'];
$g = $_POST['harga_modal'];
$h = $_POST['profit'];
$i = $_POST['tanggal_datang'];
$j = $_POST['qty_terjual'];

// Periksa apakah file berhasil diunggah
if ($_FILES['images']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['images']['tmp_name'];
    move_uploaded_file($file_tmp, '../uploads/' . $b);  // Pindahkan file yang diunggah ke direktori tertentu
}

// query
$sql = "UPDATE table_barang 
        SET merk_barang=?, nama_barang=?, gambar_barang=?, tanggal_expire=?, harga_barang=?, qty=?, hargamodal_barang=?, profit=?, tanggal_datang=?, qty_terjual=?
		WHERE id_barang=?";
$q = $db->prepare($sql);
$q->execute(array($a, $z, $b, $c, $d, $f, $g, $h, $i, $j, $id));
header("location: products.php");


?>