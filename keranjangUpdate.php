    <?php
    ob_start(); 
    session_start();
    include_once("function/koneksi.php");
    include_once("function/helper.php");

    var_dump($_POST);


    if (isset($_POST['dataCostumer'])) {
        $namaCs = $_POST['namaCostumer'];
        $nomorTelp = $_POST['nomorTelephone'];
        $tanggal = $_POST['tanggal'];
    
        if (!empty($_SESSION['costumer'])) {
            echo "<script>alert('Data pelanggan sudah tersimpan, lanjutkan isi barang, atau reset keranjang'); window.location.href='index.php';</script>";
        } else {
            $costumerId = uniqid();
            $queryCostumer = "SELECT * FROM m_customer WHERE kode ='$namaCs'";
            $result2 = mysqli_query($koneksi, $queryCostumer);
    
            if (mysqli_num_rows($result2) > 0) {
                $costumer = mysqli_fetch_assoc($result2);
                $found = false;
                foreach ($_SESSION['costumer'] as $key => $value) {
                    if ($value['namaCs'] === $namaCs) {
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $_SESSION['costumer'][] = $costumer;
                }
            } else {
                // Pelanggan tidak ditemukan di database
                $dataCostumer = [
                    'costumerId' => $costumerId,
                    'namaCs' => $namaCs,
                    'nomorTelp' => $nomorTelp,
                    'tanggal' => $tanggal
                ];
                $_SESSION['costumer'][] = $dataCostumer;
            }
        }
    } 


if (isset($_POST['tambahBarang'])) {
    $noTransaksi = mt_rand(100,999);
    $kodeBarang = $_POST['kodeBarang'];
    $qtyBarang = $_POST['qtyBarang'];
    $diskon = $_POST['diskon'];
    $ongkir = $_POST['ongkosKirim'];

    // Query untuk mengambil data barang dari database
    $query = "SELECT * FROM m_barang WHERE kode = '$kodeBarang'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $barang = mysqli_fetch_assoc($result);

        $found = false;
        foreach ($_SESSION['keranjang'] as $key => $value) {
            if ($value['codebarang'] === $kodeBarang) {
                // Item sudah ada di keranjang, tambahkan quantity
                $found = true;
                $_SESSION['keranjang'][$key]['qty'] += $qtyBarang;
                break;
            }
        }
        if (!$found) {
            // Item belum ada di keranjang, tambahkan item baru

            $harga = $barang['harga'];
            $namaBarang = $barang['nama'];
            $diskonRupiah = ($harga * $diskon / 100);
            $hargaDiskon = $harga - $diskonRupiah ;
            $totalPembayaran = $hargaDiskon * $qtyBarang ;
            $sum += $hargaDiskon * $qtyBarang ; 
            $sumDiskon += $diskonRupiah * $qtyBarang;      
            $sumBayar = $sum + $ongkir;
            $dataTransaksi = [
                'id' => mt_rand(100, 999),
                'noTransaksi' => $noTransaksi,
                'codebarang' => $kodeBarang,    
                'namaBarang' => $namaBarang,
                'harga' => $harga,
                'qty' => $qtyBarang,
                'diskon' => $diskon,
                'ongkir' => $ongkir,
                'diskonRupiah' => $diskonRupiah,
                'totalPembayaran' => $totalPembayaran,
                'totalKeseluruhan' => $sumBayar,
                'subtotal' => $hargaDiskon
            ];

            $_SESSION['keranjang'][] = $dataTransaksi;
        }

        header('Location: index.php');
        exit();
    } else {
        echo "Data barang dengan kode '$kodeBarang' tidak ditemukan.";
    }
}
?>

