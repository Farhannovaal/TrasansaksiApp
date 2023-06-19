<?php
session_start();


$id = $_GET['id'];
$keranjang = $_SESSION['keranjang'];


// jalankan fungsi untuk mengambil data ID spesifik
$deleteID = array_filter($keranjang, function ($var) use ($id){
    return ($var['id'] == $id);
});

// print_r($deleteID);
foreach ($deleteID as $key => $value){
    unset($_SESSION['keranjang'][$key]);
}

$_SESSION['keranjang'] = array_values($_SESSION['keranjang']);

header('Location:index.php')

?>