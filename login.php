<?php
session_start();
include_once("function/koneksi.php");
include_once("function/helper.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($password)) {
        echo "<h2>Password tidak boleh kosong.</h2>";
    } else {
    
        $query = mysqli_query($koneksi, "SELECT * FROM account WHERE username ='$username' AND password_col ='$password'");
    
        if (mysqli_num_rows($query) > 0) {
            session_start();
            $_SESSION['username'] = $username;
            header("location:index.php");
            exit();
        } else {
     
            $error = "Username atau password salah.";
        }
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Panel</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    
    <h2 class="login-title"> Hallo Selamat Datang, Masukan Username & Password Anda </h2>

    <form action="" method="post">
            <div class="login-wrapper">
                <div class="username">
                    <h2> Username</h2>
                    <input type="text" value="" placeholder="masukan username anda" name="username">
                </div>
                <div class="password">
                    <h2> Passowrd </h2>
                    <input type="password" value="" placeholder="masukan password anda" name="password">
                </div>
            </div>

            <button type="submit" name="login" class="login-btn"> Login </button>

    </form>


</body>
</html>