<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include("../koneksi.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get image filename to delete it from folder
    $qry_foto = "SELECT foto_unit FROM kendaraan WHERE id_kendaraan = '$id'";
    $res_foto = mysqli_query($koneksi, $qry_foto);
    $data_foto = mysqli_fetch_assoc($res_foto);
    
    if ($data_foto && !empty($data_foto['foto_unit'])) {
        $file_path = "../img/" . $data_foto['foto_unit'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    $qry = "DELETE FROM kendaraan WHERE id_kendaraan = '$id'";
    $hapus = mysqli_query($koneksi, $qry);

    if ($hapus) {
        echo "<script>alert('Data berhasil dihapus'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data'); window.location='index.php';</script>";
    }
} else {
    header("Location: index.php");
}
?>
