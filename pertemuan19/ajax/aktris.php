<?php
require '../functions.php';
$keyword = $_GET['keyword'];

$query = "SELECT * FROM aktris 
    WHERE
    nama LIKE '%$keyword%' OR 
    `tanggal lahir` LIKE '%$keyword%' OR
    `ukuran bra` LIKE '%$keyword%' OR
    `tinggi badan` LIKE '%$keyword%' or
    debut LIKE '%$keyword%'
    ";
$aktris = query($query);


?>

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