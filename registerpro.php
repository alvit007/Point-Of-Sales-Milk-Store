<?php
    session_start();

    if (isset($_POST['register'])) {
        include "koneksi.php";

        $nama           = $_POST['nama'];
        $email          = $_POST['email'];
        $jk             = $_POST['jk'];
        $no_hp          = $_POST['no_hp'];
        $alamat         = $_POST['alamat'];

        $password       = $_POST['password'];
        $conpassword    = $_POST['conpassword'];

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['danger'] = "Format email tidak valid";
            header("Location: register.php");
            exit();
        }

        $query = "SELECT email FROM table_pelanggan WHERE email = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $_SESSION['danger'] = "E-mail sudah digunakan";
            header("Location: register.php");
            exit();
        }

        // Hashing password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($password !== $conpassword) {
            $_SESSION['danger'] = "Password and Confirm Password tidak cocok";
            header("Location: register.php");
            exit();
        }

        $query = "INSERT INTO table_pelanggan(nama, email, jk, no_hp, alamat, password) 
                  VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "ssssss", $nama, $email, $jk, $no_hp, $alamat, $hashedPassword);
        mysqli_stmt_execute($stmt);

        $_SESSION['email'] = $email; 
        $_SESSION['nama'] = $nama;
        $_SESSION['no_hp'] = $no_hp;
        $_SESSION['alamat'] = $alamat;

        header("Location: login.php");
        exit();
    }
?>