<?php 
session_start();

if( !isset($_SESSION["login"]) ) { // kalo user belum login, maka lakukan :
    header("location: login.php"); // tendang ke login.php
    exit();
}

require 'functions.php';
// tangkap dulu id yang ada di index.php nya
$id = $_GET["id"];

// buat logika hapus
if (hapus ($id)>0) {
    echo "
        <script>
            alert('data BERHASIL dihapus !');
            document.location.href = 'index.php';
        </script>
    ";
} else {
    echo "
    <script>
        alert('data GAGAL dihapus !');
        document.location.href = 'index.php';
    </script>
    ";
}

?>