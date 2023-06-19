<?php
session_start();
 include_once("function/koneksi.php");
 include_once("function/helper.php");


if ($_SESSION['username']  == '' ) {
    header("location:login.php"); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Transaksi PT. Mitra Sinerji Teknologi </title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="index.css">
</head>
<body>


                                
    <div class="container-form">
            <div class="header-title">
                <h1 class="judul"> Barang PT. Mitra Sinerji Teknologi</h1>
                    <h3 class="sub-judul"> Technology </h3>
            </div>            

            
            <div class="daftar-transaksi">
                <form action="" method="post">
    <label for="cariDaftar" >
        <input type="text" name="cariDaftar" id="cariDaftar"class="cariPelanggan" placeholder="Masukan Nama Pelanggan">
    </label>
    </form>
    <div class="daftar-wrapper">
        <table>
            <tr>
                <th>No</th>
                <th>No Transaksi</th>
                <th>Tanggal</th>
                <th>Nama Customer</th>
                <th>Jumlah Barang</th>
                <th>Sub Total</th>
                <th>Diskon</th>
                <th>Ongkir</th>
                <th>Total</th>
            </tr>
            <?php
            $namaCari = isset($_POST['cariDaftar']) ? $_POST['cariDaftar'] : '';
            $query = "SELECT * FROM t_sales_det 
            INNER JOIN t_sales ON t_sales_det.sales_id = t_sales.kode
            INNER JOIN m_customer ON t_sales.kode = m_customer.kode
            INNER JOIN m_barang ON t_sales_det.barang_id = m_barang.kode
            WHERE m_customer.name_customer LIKE '%$namaCari%'
            ORDER BY t_sales.tgl DESC
            LIMIT 10";
        
            $dataPenjualan = mysqli_query($koneksi, $query);
            if (!$dataPenjualan) {
                die('Query Error: ' . mysqli_error($koneksi));}

            $no = 1;
            while ($dataPe = mysqli_fetch_assoc($dataPenjualan)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $dataPe['idTransaksi']; ?></td>
                    <td><?php echo $dataPe['tgl']; ?></td>
                    <td><?php echo $dataPe['name_customer']; ?></td>
                    <td><?php echo $dataPe['qty']; ?></td>
                    <td><?php echo Rupiah($dataPe['qty'] * $dataPe['harga']); ?></td>
                    <td><?php echo Rupiah($dataPe['diskon_nilai']); ?></td>
                    <td><?php echo Rupiah($dataPe['ongkir']); ?></td>
                    <td><?php echo Rupiah($dataPe['total']); ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>

<?php

// DEFINIKAN VARIABLE

$noTransaksi = "";
$costumerId = "";
$hargaDiskon = 0;
$diskonRupiah = 0;
$totalPembayaran = 0;
$sum = 0;
$sumDiskon = 0;
$sumBayar = 0;    
$ongkir = 0;
$qtyBarang =0;


    if (isset($_SESSION['keranjang'])) {
        foreach ($_SESSION['keranjang'] as $key => $value) {
            
        }
    }
    // Penjumlahan Barang sama

            if ($qtyBarang > 1) {
                $sum += $hargaDiskon * $qtyBarang;
                $sumDiskon += $diskonRupiah * $qtyBarang;
                $sumBayar = $sum + $ongkir;
            } else {
                $sum == $hargaDiskon;
                $sumDiskon += $diskonRupiah;
            }


?>

            <form action="keranjangUpdate.php" method="post" id="tambahPelanggan"  >

                    <div class="container-input-wrapper">
                            <div class="form-input-wrapper">
                            <div class="transaksi-input">
                            <h2> Transaksi </h2>
                            <ul>
                            <h4 class="transaksi-input-head"> No </h4>
                                <li>
                                <label for="noTransaksi">
                                    <input type="text" name="noTransaksi" id="noTransaksi" placeholder="Tidak perlu diisi" readonly>
                                </label>
                                </li>
                            </ul>

                            <ul>
                            <h4 class="Tanggal-input-head"> Tanggal </h4>
                            <li>
                                <label for="tanggal">   
                                    <input type="datetime-local" name="tanggal" id="tanggal" required >
                                </label>
                                    </li>
                                </ul>
                            </div> 
                    
                            <div class="costumer-input">
                                <h2>  Costumer </h2>
                            
                                <div class="pemilihan-costumer">
                                <h4 class="transaksi-input-head"> Kode </h4>
                                    <label for="Kode">
                                        <select name="costumer" id="costumerSelect" required>
                                    <!-- Looping data name pelanggan -->
                                        <?php  
                                         $customerNames = array();
                                         $customerData = mysqli_query($koneksi, "SELECT name_customer, kode, telp FROM m_customer");
                                         while ($dataCustomer = mysqli_fetch_assoc($customerData)) {
                                            $name = $dataCustomer['name_customer'];
            
                                            if (!in_array($name, $customerNames)) {
                                                $customerNames[] = $name;
                                ?>
                                        <option value="<?php echo $dataCustomer["kode"]; ?>" data-nama="<?php echo $dataCustomer['name_customer']; ?>" data-telp="<?php echo $dataCustomer['telp']; ?>" required><?php echo $dataCustomer['name_customer']; ?></option>
                                        <?php
                                            }
                                }
                                ?>
                                      </select>                           
                                    </label>
                                </div>
                                <ul>
                                    <h4 class="namaCostumer-input-head"> Nama </h4>
                                    <li>
                                        <label for="namaCostumer">   
                                            <input type="text" name="namaCostumer" id="namaCostumer" placeholder="Masukan nama anda" required >
                                        </label>
                                    </li>
                                </ul>

                                <ul>
                                    <h4 class="telp-input-head"> Telp </h4>
                                    <li>
                                        <label for="telp">   
                                            <input type="text" name="nomorTelephone" id="telp" placeholder=" Masukan nomor anda" required>
                                        </label>
                                    </li>
                                        </ul>
                                    </div>
                                </div>    
                                
                            
                <button type="submit" name="dataCostumer" class="prosesPesanan"> Simpan Costumer </button>
            
                                        <!-- SCRIPT JS COSTUMER SELECT -->
                    <script>
                        var namaCostumerInput = document.querySelector('#namaCostumer');
                    var telpInput = document.querySelector('#telp');
                    var costumerSelect = document.getElementById('costumerSelect');


                    costumerSelect.addEventListener('change', function() {
                    var selectedOption = this.options[this.selectedIndex];
                    namaCostumerInput.value = selectedOption.getAttribute('data-nama');
                    telpInput.value = selectedOption.getAttribute('data-telp');

                    });
                    </script>
                </form>

            <?php

                if (isset($_SESSION['costumer'])) {
                    foreach ($_SESSION['costumer'] as $key => $value) {
                ?>
                        <div class="greeting-costumer">
                            <h3> Hallo <?php echo $value['namaCs']?> Data anda berhasil disimpan!</h3>
                            <p> Data Anda Sudah Tersimpan </p>
                            <p> Lanjutkan dengan data barang</p>
                        </div>
                <?php
                    }
                }
                ?>


   
    <div class="table-keranjang">
    <div class="button-resert">
    <div  class="btn-cancel-keranjang"><a href="resetKeranjang.php" onclick="return confirm('Yakin mereset seluruh keranjang?')"> Reset Keranjang   </a></div>
    <div class="btn-tambah-barang"><a href="DataCS&Barang.php"> Tambah Barang Baru </a></div>

    </div>
    
        <div class="detail-pesanan-wrapper">
            
                    <h2>Detail Pesanan</h2>
               
                <form action="keranjangUpdate.php" method="POST"value="submit">   
                            <label for="kodeBarang"> 
                            <select name="kodeBarang" id="kodeBarang" required>
                            <option value="">  Masukan Barang </option>
                            <?php
                            // Query untuk mengambil data kode barang dari database
                            $ambilDataBarang = mysqli_query($koneksi, "SELECT * FROM m_barang" );
                            // Looping untuk menampilkan opsi kode barang
                            while ($dataBarang = mysqli_fetch_assoc($ambilDataBarang)) {
                            ?>
                            <option value="<?php echo $dataBarang['kode']?>" ><?php echo $dataBarang['nama']; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                            </label>
                            <label for="qtyBarang">
                            <input type="number" name='qtyBarang' min="1" placeholder="masukan qty barang" value="" required>
                            </label>
                            <button type="submit" name="tambahBarang" class="tambahBarang"> Tambah </button>
                          
            </div>

            <div class="ongkirdiskon-wrap">
                                <div class="ongkirWrapper">
                                    <p> Lokasi anda </p>
                                    <select name="ongkosKirim" id="ongkirOption" class="ongkirOption">
                                    <option value="0" selected>-- Pilih Lokasi --</option>
                                        <option value="9000"> Bandung </option>
                                        <option value="6000"> Jakarta </option>
                                        <option value="14000"> Surabaya </option>
                                        <option value="13000"> Malang </option>
                                        <option value="11000"> Yogyakarta </option>
                                    </select>
                                    <p id="biayaTampil"></p>
                                </div>

                                
                                <div class="diskonWrapper">
                                    <p> Promo Diskon Potongan </p>
                                    <select name="diskon" id="diskonOption">
                                    <option value="0" selected>-- Pilih Diskon --</option>
                                        <option value="15"> SpecialEdtion </option>
                                        <option value="10"> RamadhanBerkah </option>
                                        <option value="30"> idulAdha </option>
                                        <option value="80">GratisOngkir </option>
                                    </select>
                                    <p id="tampilDiskon"></p>
                            </div>
                    </div>
            
            <div class="table-barang">
                    <table>
                        <tr>
                            <th rowspan="2"> No</th>
                            <th rowspan="2"> Kode Barang </th>
                            <th rowspan="2"> Nama Barang  </th>
                            <th rowspan="2"> Qty </th>
                            <th rowspan="2"> Harga Bandrol</th>
                            <th colspan="2"> Diskon </th>
                            <th rowspan="2" > Harga Diskon </th>
                            <th rowspan="2" > Total </th>
                            <th rowspan="2" colspan="2"> Action </th>
                        </tr>

                        <tr>
                            <th class="tagHead-list"> %  </th>
                            <th class="tagHead-list"> (Rp) </th>
                         </tr>

                        <?php
                        // Mengecek apakah keranjang sudah ada sebelumnya
                        if (isset($_SESSION['keranjang'])) {
                            foreach ($_SESSION['keranjang'] as $key => $value) {
                                $harga = $value['harga'];
                                $codebarang = $value['codebarang'];
                                $ongkir = $value['ongkir'];    
                                $qtyBarang = intval($value['qty']); 
                                $diskonRupiah = ($harga * $value['diskon'] / 100) ;
                                $hargaDiskon = $harga - $diskonRupiah ;
                                $totalPembayaran = $hargaDiskon * $qtyBarang ;
                                $sum += $hargaDiskon * $qtyBarang ; 
                                $sumDiskon += $diskonRupiah * $qtyBarang;      
                                $sumBayar = $sum + $ongkir;
                                // print_r($sumDiskon)   
                                $no = 0;
                           
                        ?>
                                <tr>
                                    <td> <?php $no ++ ?> </td>
                                    <td><?php echo $value['codebarang'] ?></td>
                                    <td><?php echo $value['namaBarang'] ?></td>
                                    <td><?php echo $value['qty']?></td>
                                    <td name='harga'> <?php echo rupiah($harga) ?></td>
                                    <td><?php echo $value['diskon'] ?> %</td>
                                    <td><?php echo Rupiah($diskonRupiah)?></td>
                                    <td name="subtotal"><?php echo rupiah($hargaDiskon) ?></td>
                                    <td id="totalSetelahDiskon"><?php echo rupiah($totalPembayaran) ?></td>
                                    <td class="icon-hapus">
                                        <a href="hapusKeranjang.php?id=<?php echo $value['id']; ?>"> <i class='bx bx-x'></i> </a>
                                    </td>
                            
                                </tr>
                                <input type="hidden" name="key[]" value="<?php echo $key ?>">
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='10'>Keranjang kosong</td></tr>";
                        }
                        ?>
                </table>

                                <div class="total-wrapper">
                                    <h3> subtotal : <?php echo Rupiah($sum)?></h3>
                                    <h2> Diskon : <?php echo Rupiah($sumDiskon)?></h2>
                                    <h3> Ongkir : <?php echo Rupiah ($ongkir)  ?></h3>
                                    <h3> Total Bayar : <?php echo Rupiah($sumBayar)?></h3>
                                </div>

                <?php
                    if (!empty($ongkir) && !empty($diskon)) : ?>
                    <p>Ongkir Anda adalah <?php echo $ongkir; ?></p>
                    <p><?php echo $diskon; ?> Diskon Anda</p>
                <?php endif; ?>
            </form>
        </div>

        
        <div class="button-post">
            <form action="proses_pesanan.php" method="post">
            <button type="submit" name="prosesPesanan" class="prosesPesanan" onclick="return confirmation();"> Kirim Pesanan </button>
                </div>
            </form>
        </div>
    </div>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="edit.js"></script>
</body>
</html>