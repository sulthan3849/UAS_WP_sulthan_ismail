<?php 
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "db_dealer_nim";

    $koneksi = mysqli_connect($host, $username, $password, $db);
    
    if (!$koneksi) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
