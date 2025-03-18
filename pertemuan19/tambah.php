<?php 
session_start();

if( !isset($_SESSION["login"]) ) { // kalo user belum login, maka lakukan :
    header("location: login.php"); // tendang ke login.php
    exit();
}

require 'functions.php';

if(isset($_POST["submit"])) { // jika tombol submit pernah dipencet, maka jalankan :

if( tambah($_POST)>0) { //   cek apakah data berhasil ditambah atau tidak
    echo "
    <script>
    alert('data BERHASIL ditambahkan !');
    document.location.href = 'index.php';
    </script>
    ";
} else{
    echo "
    <script>
    alert('data GAGAL ditambahkan !');
    document.location.href = 'index.php';
    </script>
    ";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Aktris</title>
</head>
<body>
    <h1>Tambah Data Aktris</h1>

    <form action="" method="post" enctype='multipart/form-data'>
        <ul>
            <li>
                <label for= 'nama'> Nama :</label>
                 <input type='text' name='nama' id='nama' required autofocus>
            </li>
            <li>
                <label for= 'tanggal lahir'> Tanggal Lahir :</label>
                 <input type='date' name='tanggal lahir' id='tanggal lahir'>
            </li>
            <li>
                <label for= 'ukuran bra'> Ukuran Bra :</label>
                 <input type='text' name='ukuran bra' id='ukuran bra'>
            </li>
            <li>
                <label for= 'tinggi badan'> Tinggi Badan :</label>
                 <input type='text' name='tinggi badan' id='tinggi badan'>
            </li>
            <li>
                <label for= 'debut'> Debut :</label>
                 <input type='text' name='debut' id='debut'>
            </li>
            <label for= 'gambar'> Gambar :</label>
             <input type='file' name='gambar' id='gambar'>
            <li>
                <button type="submit" name="submit">Tambah data !</button>
            </li>
        </ul>
    </form>
    
</body>
</html>

<!-- UPLOAD -->
 <!-- 
 1. ubah tipe input di gambar
 2. tambah enctype habis method
   -->