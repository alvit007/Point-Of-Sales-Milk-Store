<?php

$hostname = "localhost";
$userDatabase = "root";
$passwordUser = "";
$databaseName = "if0_34583391_milkybaby.sql";

$koneksi = mysqli_connect($hostname, $userDatabase, $passwordUser, $databaseName) or die (mysqli_error($koneksi));

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

?>