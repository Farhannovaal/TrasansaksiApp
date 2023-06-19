<?php
    define("BASE_URL", "http://localhost:8080/TrasaksiSinerji/");


function rupiah($angka) {
  if (is_numeric($angka)) {
    return 'Rp. ' .  number_format($angka, 0, ',', '.');
  } else {
    return $angka;
  }
}
