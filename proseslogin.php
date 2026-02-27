<?php
session_start();
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $qry = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $cek = mysqli_query($koneksi, $qry);
    
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        echo "<script>alert('Username atau password salah!'); window.location='login.php';</script>";
    }
}
?>
