<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<input type="password" id="passwordField">
<input type="checkbox" onclick="togglePassword()"> Tampilkan Password

<script>
    function togglePassword() {
        var password = document.getElementById("passwordField");
        password.type = (password.type === "password") ? "text" : "password";
    }
</script>

</body>
</html>