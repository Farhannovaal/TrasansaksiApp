<?php
session_start();


include_once("function/koneksi.php");
include_once("function/helper.php");

?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="index.css">
            <title> Input Data </title>
        </head>
        <body>      
                     
                <div class="tambah-barang-container"> 
                    <form action="proses_pesanan.php" method="POST"> 
                            <div class="tambah-barang-wrapper">
                                <h2> Masukan Barang Baru </h2>
                                <ul>
                                    <h4 class="Tanggal-input-head"> kode Barang </h4>
                                    <li>
                                        <label for="kodeBarang">   
                                            <input type="text" name="kodeBarang" id="kodeBarang" placeholder="Tidak perlu (auto)" style="text-align:center" readonly>
                                        </label>
                                    </li>
                                </ul>

                                <ul>
                                    <h4 class="Tanggal-input-head"> Nama Barang </h4>
                                    <li>
                                        <label for="NamaBarang">   
                                            <input type="text" name="namaBarang" id="namaBarang">
                                        </label>
                                    </li>
                                </ul>
                            
                                <ul>
                                    <h4 class="Tanggal-input-head"> Harga Barang </h4>
                                    <li>
                                        <label for="HargaBarang">   
                                            <input type="text" name="hargaBarang" id="hargaBarang">
                                        </label>
                                    </li>
                                </ul>
                                <div class="btn-tambah-barang-baru-wrapper">
                                <button type="submit" class="btn-kirim-barang" name="btn-kirim-barang"> Kirim </button>
                                <a href="index.php"><div class="cancel-tambah">Cancel</div></a>
                            </div>
                    </form>     
             </div>
                
                </div>
            
                
            
     </body>
</html>
