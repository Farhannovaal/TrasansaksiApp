<?php
session_start();
include_once("function/koneksi.php");
include_once("function/helper.php");

if (isset($_POST['prosesPesanan'])) {

    if (isset($_SESSION['costumer'])) {
        foreach ($_SESSION['costumer'] as $key => $value) {
            $costumerId = $value['costumerId'];
            $namaCostumer = $value['namaCs'];
            $nomorTelp = $value['nomorTelp'];
            $tanggalTransaksi = $value['tanggal'];
            // // var_dump($_SESSION['costumer']);
        }    
    }
    if (isset($_SESSION['keranjang'])) {
        foreach ($_SESSION['keranjang'] as $key => $value) {
            $codeBarang = $value['codebarang'];
            $harga = $value['harga'];
            $noTransaksi = $value['noTransaksi'];
            $qtyCostumer = $value['qty'];
            $diskon = $value['diskon'];
            $ongkir = $value['ongkir'];
            $subTotal = $value['subtotal'];
            $totalPembayaran = $value['totalPembayaran'];
            $totalKeseluruhan = $value['totalKeseluruhan'];
            $noTransaksi =  $value['noTransaksi'];
            $diskonRupiah = $value['diskonRupiah'];
            $dataCostumer = $_SESSION['costumer']; // Ambil data costumer dari $_SESSION sebelum perulangan foreach
    
            // Query SQL untuk menyimpan data transaksi
            $queryTransaksi = mysqli_query($koneksi, "INSERT INTO t_sales(kode,tgl,cust_id,subtotal,diskon,ongkir,total_bayar) VALUES ('$noTransaksi','$tanggalTransaksi','$costumerId','$subTotal' ,'$diskon','$ongkir','$totalPembayaran')");
            if ($queryTransaksi) {
                echo "Data Transaksi Berhasil Disimpan";
            } else {
                echo "Data Transaksi Gagal Disimpan";
            }
    
            // Query SQL untuk menyimpan data detail transaksi
            $queryDetail = mysqli_query($koneksi, "INSERT INTO t_sales_det(sales_id,barang_id,harga_bandrol,qty,diskon_pct,diskon_nilai,harga_diskon,total) VALUES ('$noTransaksi','$codeBarang','$harga','$qtyCostumer','$diskon','$diskonRupiah','$subTotal','$totalKeseluruhan')");
            if ($queryDetail) {
                echo "Data Detail Berhasil Disimpan";
            } else {
                echo "Gagal menyimpan Data Detail";
            }
    
            // Query SQL untuk menyimpan data costumer
            $queryCostumer = mysqli_query($koneksi, "INSERT INTO m_customer (kode,name_customer,telp) VALUES ('$noTransaksi','$namaCostumer','$nomorTelp')");
            if ($queryCostumer) {
                echo "Data Costumer Berhasil Disimpan";
            } else {
                echo "Gagal menyimpan Data Costumer";
            }
        }
    
        // Mengosongkan data costumer dan keranjang setelah penyimpanan berhasil
        $_SESSION['costumer'] = array();
        $_SESSION['keranjang'] = array();
    
        echo "<script>alert('Data anda berhasil disimpan'); window.location.href='index.php';</script>";
        header("Location: index.php");
        exit();
    }
    

}







    // TAMBAH BARANG QUERY
    
    if(isset($_POST["btn-kirim-barang"])){
      
        $kodeBarangTransaksi = mt_rand(100,999);
        $namaBarang = $_POST['namaBarang'];
        $hargaBarang = $_POST['hargaBarang'];
    
    if (empty($kodeBarangTransaksi) || empty($namaBarang) || empty ($hargaBarang))  {
        $error = "Data tidak boleh ada yang kosong";
    } else{
        $queryTambah = mysqli_query($koneksi, "INSERT INTO m_barang (kode,nama,harga) VALUES ('$kodeBarangTransaksi',    '$namaBarang','$hargaBarang') ");
            if ($queryTambah){
                echo "Data yang anda masukan berhasil";
                header("Location:index.php");
              
            } else {
                $error = "Data yang anda masukan tidak tepat";
            } 
    }
    }
    if (!empty($error)) {
    echo "<h2>Gagal: $error</h2>";  
    }

?>

