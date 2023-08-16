<?php

session_start();
include "koneksi.php";

function calculateTotalPrice($cartItems) {
    $totalPrice = 0;
    foreach ($cartItems as $item) {
        $price = $item['price'];
        $qty = $item['qty'];
        $totalPrice += $price * $qty;
    }
    return $totalPrice;
}

    // Pastikan ada item di keranjang belanja
    if (!empty($_SESSION['cart_item'])) {
        // Mendapatkan data pengguna dari tabel_pelanggan berdasarkan email
    $query_pelanggan = mysqli_query($koneksi, "SELECT * FROM table_pelanggan WHERE email = '".$_SESSION['email']."'");
    if ($query_pelanggan && mysqli_num_rows($query_pelanggan) > 0) {
        $result_pelanggan = mysqli_fetch_assoc($query_pelanggan);
        $id_pelanggan = $result_pelanggan['id_pelanggan'];
        $nama = $result_pelanggan['nama'];
        $no_hp = $result_pelanggan['no_hp'];
        $alamat = $result_pelanggan['alamat'];
        
        $tgl_pembelian = date('Y-m-d'); // Mengasumsikan tanggal saat ini digunakan
        $total_harga = calculateTotalPrice($_SESSION['cart_item']); // Fungsi untuk menghitung total harga barang dalam keranjang

    // Membuat rekam pembelian baru dalam tabel_pembelian
    $sql = "INSERT INTO table_pembelian (id_pelanggan, nama_pelanggan, no_hp, alamat, tgl_pembelian, total_harga) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "issssd", $id_pelanggan, $nama, $no_hp, $alamat, $tgl_pembelian, $total_harga);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Mendapatkan ID order yang baru saja dibuat
        $invoice = mysqli_insert_id($koneksi);
        $_SESSION['invoice'] = $invoice;

        // Memasukkan detail barang ke dalam tabel order_details
        foreach ($_SESSION['cart_item'] as $item) {
            $id_barang = $item['id'];
            $gambar_barang = $item['img'];
            $merk_barang = $item['merk'];
            $nama_barang = $item['name'];
            $harga_barang = $item['price'];
            $qty = $item['qty'];
            $subtotal = $harga_barang * $qty;

            $sql = "INSERT INTO order_details (invoice, id_barang, gambar_barang, merk_barang, nama_barang, harga_barang, qty, subtotal) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $sql);
            mysqli_stmt_bind_param($stmt, "iisssdss", $invoice, $id_barang, $gambar_barang, $merk_barang, $nama_barang, $harga_barang, $qty, $subtotal);
            $result = mysqli_stmt_execute($stmt);
        }?>
// Mengosongkan keranjang belanja setelah order berhasil disimpan
<?php unset($_SESSION['cart_item']);

        // Redirect ke halaman sukses atau halaman lain yang diinginkan
        $_SESSION['invoice'] = $invoice;
        header('Location: order_success.php');
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan order.";
    }
} else {
    echo "Data pengguna tidak ditemukan.";
}
    }


?>