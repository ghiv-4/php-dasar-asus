<?php 
session_start();

if (isset($_SESSION["login"])){ // kalo udah login, jangan ke halaman login
    header("location: index.php");
    exit();
}

require 'functions.php';

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
                <label for= 'username'> username :</label>
                <input type='text' name='username' id='username' autofocus>
            </li>
            <li>
                <label for= 'password'> password :</label>
                 <input type='password' name='password' id='password'>
            </li>
            <li>
                <button type='submit' name='login'>Login</button>
            </li>
        </ul>

     </form>
     
</body>
</html>