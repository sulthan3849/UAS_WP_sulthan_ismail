<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['login'])) {
    header("Location: /UAS_sulthan_ismail/login.php");
    exit;
}
?>
<nav class="navbar navbar-expand-lg" style="background-color:#005e10" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/UAS_sulthan_ismail/index.php">Dealer Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/UAS_sulthan_ismail/index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/UAS_sulthan_ismail/kendaraan/index.php">Kendaraan</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-danger fw-bold" href="/UAS_sulthan_ismail/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
