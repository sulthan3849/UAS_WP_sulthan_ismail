<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

include("../koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_unit = $_POST['nama_unit'];
    $no_rangka = $_POST['no_rangka'];
    $id_merk = $_POST['id_merk'];
    $id_tipe = $_POST['id_tipe'];
    $tahun_produksi = $_POST['tahun_produksi'];
    $harga_jual = $_POST['harga_jual'];
    $status_stok = $_POST['status_stok'];

    // Validation
    if(empty($nama_unit) || empty($no_rangka)) {
        echo "<script>alert('Nama Unit dan Nomor Rangka tidak boleh kosong!'); window.history.back();</script>";
        exit;
    }

    if($harga_jual < 1000000) {
        echo "<script>alert('Harga Jual minimal Rp 1.000.000!'); window.history.back();</script>";
        exit;
    }

    // File Upload handling
    $foto_unit = $_FILES['foto_unit']['name'];
    $tmp_file = $_FILES['foto_unit']['tmp_name'];
    $file_size = $_FILES['foto_unit']['size'];
    $file_ext = strtolower(pathinfo($foto_unit, PATHINFO_EXTENSION));

    $allowed_extensions = array("jpg", "jpeg", "png");

    if(!in_array($file_ext, $allowed_extensions)){
        echo "<script>alert('Format file tidak diizinkan. Hanya JPG/JPEG/PNG!'); window.history.back();</script>";
        exit;
    }

    // Rename file to prevent duplicates
    $new_filename = time() . "_" . $foto_unit;
    $upload_dir = "../img/" . $new_filename;

    if(move_uploaded_file($tmp_file, $upload_dir)){
        $qry = "INSERT INTO kendaraan (id_merk, id_tipe, nama_unit, no_rangka, tahun_produksi, harga_jual, status_stok, foto_unit) 
                VALUES ('$id_merk', '$id_tipe', '$nama_unit', '$no_rangka', '$tahun_produksi', '$harga_jual', '$status_stok', '$new_filename')";
        
        $simpan = mysqli_query($koneksi, $qry);

        if($simpan){
            echo "<script>alert('Data berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data ke database!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload gambar!'); window.history.back();</script>";
    }
}
?>
