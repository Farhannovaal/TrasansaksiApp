<?php
session_start();

$id = $_GET['id'];
$keranjang = $_SESSION['keranjang'];
var_dump($_SESSION['keranjang']);


foreach ($keranjang as $key => $item) {
    if ($item['id'] == $id) {
        if ($item['qty'] <= 1) {
             echo "<script>
                if (confirm('Apakah Anda ingin menghapus semua item?')) {
                    window.location.href = 'hapusItem.php?id=" . $id . "';
                } else {
                    // Tindakan jika pengguna memilih tidak menghapus semua item
                    // Misalnya, arahkan ke halaman lain atau tampilkan pesan
                }
              </script>";
            unset($_SESSION['keranjang'][$key]);
        } else {
            $_SESSION['keranjang'][$key]['qty']--;
            header('Location: index.php');
        }
        break;
    }
}

$_SESSION['keranjang'] = array_values($_SESSION['keranjang']);

?>
