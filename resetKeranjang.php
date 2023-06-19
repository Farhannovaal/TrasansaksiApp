<?php
session_start();
$_SESSION['keranjang'] = [];
$_SESSION['costumer'] = [];
header('Location: index.php');
?>