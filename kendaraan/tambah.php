<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan - Dealer Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.css">
</head>
<body style="background-color:#d1e6d4">
    <?php include_once("../navbar.php"); ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-8 m-auto">
                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-header bg-primary text-white">
                        <b>Tambah Data Kendaraan</b>
                        <a href="index.php" class="float-end btn btn-secondary btn-sm"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="prosestambah.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="mb-3">
                                <label for="nama_unit" class="form-label">Nama Unit</label>
                                <input type="text" class="form-control" id="nama_unit" name="nama_unit" required>
                            </div>

                            <div class="mb-3">
                                <label for="no_rangka" class="form-label">No Rangka</label>
                                <input type="text" class="form-control" id="no_rangka" name="no_rangka" required>
                            </div>

                            <div class="mb-3">
                                <label for="id_merk" class="form-label">Merk</label>
                                <select class="form-select" id="id_merk" name="id_merk" required>
                                    <option value="" disabled selected>Pilih Merk...</option>
                                    <?php
                                    $qry_merk = mysqli_query($koneksi, "SELECT * FROM merk");
                                    while($d_merk = mysqli_fetch_array($qry_merk)){
                                        echo "<option value='{$d_merk['id_merk']}'>{$d_merk['nama_merk']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="id_tipe" class="form-label">Tipe Kendaraan</label>
                                <select class="form-select" id="id_tipe" name="id_tipe" required>
                                    <option value="" disabled selected>Pilih Tipe...</option>
                                    <?php
                                    $qry_tipe = mysqli_query($koneksi, "SELECT * FROM tipe_kendaraan");
                                    while($d_tipe = mysqli_fetch_array($qry_tipe)){
                                        echo "<option value='{$d_tipe['id_tipe']}'>{$d_tipe['nama_tipe']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tahun_produksi" class="form-label">Tahun Produksi</label>
                                <input type="number" class="form-control" id="tahun_produksi" name="tahun_produksi" required>
                            </div>

                            <div class="mb-3">
                                <label for="harga_jual" class="form-label">Harga Jual</label>
                                <input type="number" class="form-control" id="harga_jual" name="harga_jual" min="1000000" required>
                                <div class="form-text text-danger">*Minimal Harga Rp 1.000.000</div>
                            </div>

                            <div class="mb-3">
                                <label for="status_stok" class="form-label">Status Stok</label>
                                <select class="form-select" id="status_stok" name="status_stok" required>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Terjual">Terjual</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="foto_unit" class="form-label">Foto Kendaraan (JPG/PNG)</label>
                                <input class="form-control" type="file" id="foto_unit" name="foto_unit" accept=".jpg, .jpeg, .png" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/all.js"></script>
</body>
</html>
