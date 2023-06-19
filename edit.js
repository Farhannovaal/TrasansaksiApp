var toggleTambah = document.querySelector('.tambah-barang');
var menuBarang = document.querySelector('.tambah-barang-container');

toggleTambah.addEventListener('click', function(){
    if(menuBarang.classList.contains('active')){
        menuBarang.classList.remove('active');
        console.log('Menu Barang Deactive');
    }else{
        menuBarang.classList.add('active');
          console.log('Menu Barang Active');
    }

});



// AUTO DATE

function formatTime(date) {
  var month = date.getMonth() + 1;
  var day = date.getDate();
  var year = date.getFullYear();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'PM' : 'AM';


  hours = hours % 12;
  hours = hours ? hours : 12;


  month = month < 10 ? '0' + month : month;
  day = day < 10 ? '0' + day : day;
  hours = hours < 10 ? '0' + hours : hours;
  minutes = minutes < 10 ? '0' + minutes : minutes;
  return month + '/' + day + '/' + year + ' ' + hours + ':' + minutes + ' ' + ampm;
}

function setCurrentTime() {
  var currentTime = new Date();
  var formattedTime = formatTime(currentTime);
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
  


  function confirmation(){
    return confirm("Apakah anda sudah yakin?");
  }