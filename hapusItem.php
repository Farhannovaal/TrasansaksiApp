<?php
session_start();

$id = $_GET['id'];
$keranjang = $_SESSION['keranjang'];
foreach ($keranjang as $key => $item) {
    if ($item['id'] == $id) {
        unset($_SESSION['keranjang'][$key]);
        break;
    }
}
header('Location: index.php');
?>
