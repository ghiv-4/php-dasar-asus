<?php 
session_start();

if( !isset($_SESSION["login"]) ) { // kalo user belum login, maka lakukan :
    header("location: login.php"); // tendang ke login.php
    exit();
}

require 'functions.php'; // memanggil file functions

// pagination
// konfigurasi
$jumlahDataPerHalaman = 3;
$result = mysqli_query( $conn,"SELECT * FROM aktris"); // nilainya array
$jumlahData = count(query("SELECT * FROM aktris")); // hitung ada berapa data
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman); // ceil membulatkan ke atas
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1; // sama aja kek if else
// halamanAktif = 2, awal halaman = 3
// halamanAktif = 3, awal halaman = 6
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$aktris = query("SELECT * FROM aktris LIMIT $awalData, $jumlahDataPerHalaman"); // biar tabel urut berdasarkan id terbesar, tampilkan/batasi data ke a dan b

// tombil cari ditekan
if(isset($_POST["cari"])) {
    $aktris = cari($_POST["keyword"]); // ambil 'keyword' yg diinputkan user
}
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>

    <style>
        table{
            border-collapse: collapse;
            border: 1px black solid;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }
        td img {
        width: 100px;
        height: 150px;
        object-fit: cover;
        display: block;
        border-radius: 5px;
        }
    </style>
    
</head>
<body>

        <a href="logout.php">Logout</a>

    <h1>Daftar Aktris</h1>
        <a href="tambah.php">Tambah data aktris</a>
        <br> <br>

        <form action="" method='POST'>
        <input type="text" name='keyword' size='33' autofocus placeholder='cari di sini...🧐' autocomplete='off'>
        <button type='submit' name='cari'>Cari!</button>
        </form>
        <br><br>
        
        <!-- navigasi halaman -->
        <?php if($halamanAktif > 1) : ?>
        <a href="?halaman=<?= $halamanAktif - 1;?> ">◀</a> <!-- perhatikan spasi2 nya!!! -->
        <?php endif; ?>

        <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if($i == $halamanAktif) : ?>
                 <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color:green"><?= $i; ?></a>
            <?php else : ?>
                <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
            <?php endif ; ?>
        <?php endfor; ?> 
        
        <?php if($halamanAktif < $jumlahHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1;?>">▶</a>
        <?php endif; ?>

        <br><br>

    <table  cellpadding ="10" cellspacing="1" >
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Ukuran Bra</th>
            <th>Tinggi Badan </th>
            <th>Debut</th>
        </tr>
        <?php $i=1; ?> 
        <?php foreach ($aktris as $row) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id= <?= $row["id"]; ?>">ubah</a> <!-- mengubah data aktris berdasarkan id -->
                <a href="hapus.php?id= <?= $row["id"]; ?>" onclick="return confirm('yakin nih ?');" > hapus </a>  <!-- menghapus data aktris berdasarkan id -->
            </td>
            <td><img src="img/<?= $row["gambar"]; ?>" alt=""></td>
            <td><?= $row["nama"]; ?> </td>
            <td><?= $row["tanggal lahir"]; ?></td>
            <td><?= $row["ukuran bra"]; ?></td>
            <td><?= $row["tinggi badan"]; ?></td>
            <td><?= $row["debut"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>

    </table>
</body>
</html>