<?php 
session_start();

if( !isset($_SESSION["login"]) ) { // kalo user belum login, maka lakukan :
    header("location: login.php"); // tendang ke login.php
    exit();
}

require 'functions.php';

$id = $_GET["id"]; // ambil data di URL 

$akt = query("SELECT * FROM  aktris WHERE id = $id")[0]; // buat variabel $akt, isinya : query dari tabel aktris berdasarkan id masing-masing data


if(isset($_POST["submit"])) { // jika tombol submit  dipencet, maka jalankan :

if( ubah($_POST)>0) { //   cek apakah data berhasil diubah atau tidak
    echo "
    <script>
    alert('data BERHASIL diubah !');
    document.location.href = 'index.php';
    </script>
    ";
} else{
    echo "
    <script>
    alert('data GAGAL diubah !');
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
    <title>Ubah Data Aktris</title>
</head>
<body>
    <h1>Ubah Data Aktris</h1>

    <form action="" method="post" enctype='multipart/form-data'>
    <input type="hidden" name="id" value= "<?= $akt["id"]; ?>">
    <input type="hidden" name="gambarLama" value= "<?= $akt["gambar"]; ?>">
        <ul>
            <li>
                <label for= 'nama'> Nama :</label>
                 <input type='text' name='nama' id='nama' autofocus required value= "<?= $akt["nama"]; ?>"> <!-- buat isian masing-masing field  -->
            </li>
            <li>
                <label for= 'tanggal lahir'> Tanggal Lahir :</label>
                 <input type='date' name='tanggal lahir' id='tanggal lahir' required value= "<?= $akt["tanggal lahir"]; ?>">
            </li>
            <li>
                <label for= 'ukuran bra'> Ukuran Bra :</label>
                 <input type='text' name='ukuran bra' id='ukuran bra' required value= "<?= $akt["ukuran bra"]; ?>">
            </li>
            <li>
                <label for= 'tinggi badan'> Tinggi Badan :</label>
                 <input type='text' name='tinggi badan' id='tinggi badan' value= "<?= $akt["tinggi badan"]; ?>">
            </li>
            <li>
                <label for= 'debut'> Debut :</label>
                 <input type='text' name='debut' id='debut' value= "<?= $akt["debut"]; ?>"> <br>
            </li>
            <label for= 'gambar'> Gambar :</label>
            <img src="img/<?= $akt['gambar']; ?>" width='40'> <br>
             <input type='file' name='gambar' id='gambar'> <br>
            <li>
                <button type="submit" name="submit">Ubah data !</button>
            </li>
        </ul>
    </form>
    
</body>
</html>