
// AUTO DATE

function setCurrentTime() {
  var currentTime = new Date();
  var formattedTime = currentTime.toLocaleString('en-US', {
    hour: 'numeric',
    minute: 'numeric',
    hour12: true
  });
  document.getElementById('tanggal').value = formattedTime;
}

window.onload = setCurrentTime;

// 



// ONGKIR SCRIPT 
function pemilihanLokasi() {
    var ongkir = {
        Bandung: 9000,
        Jakarta: 6000,
        Surabaya: 14000,
        Malang : 1300,
        Yogyakarta : 11000
    };

    var selectOption = document.getElementById('ongkirOption');
    var tampilOption = document.getElementById('biayaTampil');

    
    selectOption.addEventListener('change', function() {
        var selectedCity = this.options[this.selectedIndex].text;
        var biayaOngkir = parseInt(this.value, 10);
    
        // Tampilkan Biaya
        if (!isNaN(biayaOngkir)) {
            tampilOption.textContent = 'Biaya ongkir untuk ' + selectedCity + ' adalah ' + biayaOngkir;
        } else {
            tampilOption.textContent = 'Biaya ongkir tidak tersedia untuk ' + selectedCity;
        }
    });
    
    
    
}

pemilihanLokasi();

//


function pemilihaDiskon(){

    var diskon ={

        SpecialEdtion : 15,
        RamadhanBerkah: 10,
        idulAdha : 30,
        GratisOngkir : 80,
    }

    var diskonOption = document.getElementById('diskonOption');
    var tampilDiskon = document.getElementById('tampilDiskon');


    diskonOption.addEventListener('change', function() {
        var selectedDiskon = this.options[this.selectedIndex].text;
        var potonganDiskon = parseInt(this.value, 10);
    
        // Tampilkan Biaya
        if (!isNaN(potonganDiskon)) {
            tampilDiskon.textContent = 'potongan  Diskon untuk ' + selectedDiskon + ' adalah ' + potonganDiskon +'%';
        } else {
            tampilDiskon.textContent = 'Potongan diskon tidak tersedia untuk ' + selectedDiskon +'%';
        }
    });

}

pemilihaDiskon();

function validateForm() {
    var tanggal = document.getElementById("tanggal").value;
    var costumer = document.getElementById("costumerSelect").value;
    var namaCostumer = document.getElementById("namaCostumer").value;
    var nomorTelephone = document.getElementById("telp").value;
  
    // Cek apakah ada kolom yang kosong pada form tambahPelanggan
    if (tanggal === "" || costumer === "" || namaCostumer === "" || nomorTelephone === "") {
      alert("Harap lengkapi semua kolom pada form tambahPelanggan!");
      return false;
    }
  }
  