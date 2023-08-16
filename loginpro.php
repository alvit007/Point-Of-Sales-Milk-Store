<?php
session_start();

if (isset($_POST['login'])) {
    include "koneksi.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi email dan password tidak boleh kosong
    if (empty($email) || empty($password)) {
        $_SESSION['danger'] = "Email dan password harus diisi";
        header("Location: login.php");
        exit();
    }

    $query = "SELECT * FROM table_pelanggan WHERE email = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['id_pelanggan'] = $row['id_pelanggan'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['jk'] = $row['jk'];
            $_SESSION['no_hp'] = $row['no_hp'];
            $_SESSION['alamat'] = $row['alamat'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['danger'] = "Email atau password salah";
            header("Location: login.php");
            exit();
        }
    } elseif ($email == "admin@gmail.com" && $password == "admin") {
        header("Location: admin/main/index.php");
    } 
    else {
        $_SESSION['danger'] = "Email atau password salah";
        header("Location: login.php");
        exit();
    }
}
?>