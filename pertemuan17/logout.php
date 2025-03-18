<?php 

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id','',time() - 3600); // hapus cookie
setcookie('key','',time() - 3600);

header("location: login.php");
exit();
?>