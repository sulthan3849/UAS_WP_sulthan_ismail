<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Dealer Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.css">
</head>
<body style="background-color:#d1e6d4">
    <?php include_once("navbar.php"); ?>

    <div class="container">
        <div class="row my-5">
            <div class="col-8 m-auto">
                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-header bg-success text-white">
                        <b>APLIKASI SHOWROOM & DEALER MANAGEMENT SYSTEM</b>
                    </div>
                    <div class="card-body">
                        <h2>Selamat Datang, <?= $_SESSION['username']; ?>!</h2>
                        <p>Silahkan gunakan menu navigasi untuk mengelola data kendaraan showroom Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/all.js"></script>
</body>
</html>
