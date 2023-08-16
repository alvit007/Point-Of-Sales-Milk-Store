<?php
session_start();
include('../connect.php');
$a = $_POST['merk'];
$b = $_FILES['images']['name'];  // Mengakses informasi file yang diunggah
$c = $_POST['expire'];
$d = $_POST['harga'];
$f = $_POST['qty'];
$g = $_POST['harga_modal'];
$h = $_POST['profit'];
$i = $_POST['nama'];
$j = $_POST['tanggal_datang'];
$k = $_POST['qty_terjual'];

// Periksa apakah file berhasil diunggah
if ($_FILES['images']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['images']['tmp_name'];
    move_uploaded_file($file_tmp, '../uploads/' . $b);  // Pindahkan file yang diunggah ke direktori tertentu
}

// query
$sql = "INSERT INTO table_barang (merk_barang, gambar_barang, tanggal_expire, harga_barang, qty, hargamodal_barang, profit, nama_barang, tanggal_datang, qty_terjual) VALUES (:a, :b, :c, :d, :f, :g, :h, :i, :j, :k)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a, ':b'=>$b, ':c'=>$c, ':d'=>$d, ':f'=>$f, ':g'=>$g, ':h'=>$h, ':i'=>$i, ':j'=>$j, ':k'=>$k));
header("location: products.php");
?>
