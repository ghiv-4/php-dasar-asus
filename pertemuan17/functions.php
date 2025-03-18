<?php 
// koneksi ke database
$conn = mysqli_connect("localhost","root","","phpdasar");

function query($query){
    global $conn; // biar $conn bisa dibaca sama function
    $result = mysqli_query($conn , $query);
    $rows =[]; // buat wadah kosong untuk menyimpan data-data
    while($row = mysqli_fetch_assoc($result)){
        $rows[]=$row;
    }
    return $rows;
}

// BUAT FUNCTION TAMBAH
function tambah($data) {
    global $conn;
    $nama = htmlspecialchars($data["nama"]) ;  // htmlspecialchars biar user gabisa jalankan elemen html
    $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]) ;
    $ukuran_bra = htmlspecialchars($data["ukuran_bra"]);
    $tinggi_badan = htmlspecialchars($data["tinggi_badan"]);
    $debut = htmlspecialchars($data["debut"]);
    // upload gambar
    $gambar = upload();
    if(!$gambar){
        return false;
    }

  // query insert data (buat masukin ke tabel aktris)
  $query= "INSERT INTO aktris VALUES
  ('', '$nama', '$tanggal_lahir','$ukuran_bra','$tinggi_badan', '$debut','$gambar')";
    mysqli_query($conn,$query);

    // Mengembalikan jumlah baris yang terpengaruh (1 jika sukses, -1 jika gagal)
    return mysqli_affected_rows($conn); 
}

// BUAT FUNCTION UPLOAD
function upload (){
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error==4){
        echo "<script> alert('pilih gambar dulu !');</script>";
        return false;
    }
    // cek apakah yg diupload gambar
    $ekstensiValid = ['jpg', 'jpeg', 'png'];
    $ekstensi = explode ('.', $namaFile);
    $ekstensi = strtolower (end($ekstensi));
    if( !in_array($ekstensi, $ekstensiValid)) {
        echo "<script> alert('yang anda masukkan BUKAN gambar !');</script>";
        return false;
    }
    // cek ukuran file
    if( $ukuranFile > 1000000) {
        echo "<script> alert('ukuran gambar terlalu besar !');</script>";
        return false;
    }
    // jika gambar lolos seleksi
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .=  $ekstensi; 
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    return $namaFileBaru;
}

// BUAT FUNCTION HAPUS
function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM aktris WHERE id = $id");

    return mysqli_affected_rows($conn);

}

// BUAT FUNCTION UBAH
function ubah($data) {
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]) ;  // htmlspecialchars biar user gabisa jalankan elemen html
    $tanggal_lahir = htmlspecialchars($data["tanggal_lahir"]) ;
    $ukuran_bra = htmlspecialchars($data["ukuran_bra"]);
    $tinggi_badan = htmlspecialchars($data["tinggi_badan"]);
    $debut = htmlspecialchars($data["debut"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);
    // cek apakah user pilih gambar/tidak
    if($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
  // query insert data (buat masukin ke tabel aktris)
  $query= "UPDATE aktris SET 
            nama = '$nama',
            `tanggal lahir` = '$tanggal_lahir', -- kalo di kolom dua kata, pake tanda ``
            `ukuran bra` = '$ukuran_bra',
            `tinggi badan` = '$tinggi_badan',
            debut = '$debut',
            gambar = '$gambar'
            WHERE id = $id
            ";
    mysqli_query($conn,$query);

    // Mengembalikan jumlah baris yang terpengaruh (1 jika sukses, -1 jika gagal)
    return mysqli_affected_rows($conn); 
}

// BUAT FUNCTION CARI
function cari($keyword){
    $query = "SELECT * FROM aktris 
    WHERE
    nama LIKE '%$keyword%' OR 
    `tanggal lahir` LIKE '%$keyword%' OR
    bra LIKE '%$keyword%' OR
    `tinggi badan` LIKE '%$keyword%' or
    debut LIKE '%$keyword%'
    ";
    return query($query);
}

// BUAT FUNCTION REGISTRASI
function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);

    // cek username udah ada belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('username sudah terdaftar !')    
        </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert ('password tidak sesuai')
            </script>
        ";
        return false;
    } 
    // enkripsi passowrd nya
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$username', '$password')");
    return mysqli_affected_rows($conn);

}


?>
