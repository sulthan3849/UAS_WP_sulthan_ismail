<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include("../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kendaraan = $_POST['id_kendaraan'];
    $nama_unit = $_POST['nama_unit'];
    $no_rangka = $_POST['no_rangka'];
    $id_merk = $_POST['id_merk'];
    $id_tipe = $_POST['id_tipe'];
    $tahun_produksi = $_POST['tahun_produksi'];
    $harga_jual = $_POST['harga_jual'];
    $status_stok = $_POST['status_stok'];
    $foto_lama = $_POST['foto_lama'];

    // Validation
    if(empty($nama_unit) || empty($no_rangka)) {
        echo "<script>alert('Nama Unit dan Nomor Rangka tidak boleh kosong!'); window.history.back();</script>";
        exit;
    }

    if($harga_jual < 1000000) {
        echo "<script>alert('Harga Jual minimal Rp 1.000.000!'); window.history.back();</script>";
        exit;
    }

    $foto_unit = $_FILES['foto_unit']['name'];
    $nama_file_baru = $foto_lama; // Default to old file if no new file is uploaded

    // If a new file is uploaded
    if (!empty($foto_unit)) {
        $tmp_file = $_FILES['foto_unit']['tmp_name'];
        $file_size = $_FILES['foto_unit']['size'];
        $file_ext = strtolower(pathinfo($foto_unit, PATHINFO_EXTENSION));

        $allowed_extensions = array("jpg", "jpeg", "png");

        if(!in_array($file_ext, $allowed_extensions)){
            echo "<script>alert('Format file tidak diizinkan. Hanya JPG/JPEG/PNG!'); window.history.back();</script>";
            exit;
        }

        $nama_file_baru = time() . "_" . $foto_unit;
        $upload_dir = "../img/" . $nama_file_baru;

        if (move_uploaded_file($tmp_file, $upload_dir)) {
            // Delete old file if exists
            if (!empty($foto_lama) && file_exists("../img/" . $foto_lama)) {
                unlink("../img/" . $foto_lama);
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar!'); window.history.back();</script>";
            exit;
        }
    }

    $qry = "UPDATE kendaraan SET 
                id_merk = '$id_merk',
                id_tipe = '$id_tipe',
                nama_unit = '$nama_unit',
                no_rangka = '$no_rangka',
                tahun_produksi = '$tahun_produksi',
                harga_jual = '$harga_jual',
                status_stok = '$status_stok',
                foto_unit = '$nama_file_baru'
            WHERE id_kendaraan = '$id_kendaraan'";

    $update = mysqli_query($koneksi, $qry);

    if($update){
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data ke database!'); window.history.back();</script>";
    }
}
?>
