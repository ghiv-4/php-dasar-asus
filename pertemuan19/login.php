<?php 
session_start();
require 'functions.php';

// cek cookie login true atau bukan
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn,"SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}


if (isset($_SESSION["login"])){ // kalo udah login, jangan ke halaman login
    header("location: index.php");
    exit();
}


if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    // cek username ada ga di database, terus cek password
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if(mysqli_num_rows($result) === 1){

        // cek passowrd 
        $row = mysqli_fetch_assoc($result);
        if(password_verify( $password, $row["password"] )){

            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if(isset($_POST["remember"])){
                // buat cookie
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256',$row['username']), time()+60);
            }

            header("location: index.php");
            exit;
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
    <h1>LOGIN</h1>
    <?php if(isset($error)) : ?>
        <p style="color : red; font-style : italic;">username / password salah !</p>
<?php endif; ?>

    <form action="" method='post'>
        <ul>
            <li>
                <label for= 'username'> Username :</label>
                <input type='text' name='username' id='username' autofocus>
            </li>
            <li>
                <label for= 'password'> Password :</label>
                 <input type='password' name='password' id='password'>
            </li>
            <li>
                <input type='checkbox' name='remember' id='remember'>
                <label for= 'remember'> Remember me</label>
            </li>
            <li>
                <button type='submit' name='login'>Login</button>
            </li>
        </ul>

     </form>
     <p>Belum punya akun? 🤔</p>
     <a href="registrasi.php">daftar di sini !</a>
     
</body>
</html>