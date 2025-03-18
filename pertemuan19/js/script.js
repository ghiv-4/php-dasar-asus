// tangkap elemen2 tadi dengan DOM
const keyword = document.getElementById('keyword'); 
const tombolCari = document.getElementById('tombol-cari');
const container = document.getElementById('container');

// tambahkan event ketika keyword ditulis
keyword.addEventListener('keyup', function () {
   
    // buat objek ajax
    const ajax = new XMLHttpRequest()

    // cek kesiapan ajax
    ajax.onreadystatechange = function () { 
        if(ajax.readyState == 4 && ajax.status == 200) {
           container.innerHTML = ajax.responseText;
        }
    }

    // eksekusi ajax
    ajax.open('GET', 'ajax/aktris.php?keyword=' + keyword.value, true);
    ajax.send();

});