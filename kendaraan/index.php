<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendaraan - Dealer Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/all.css">
</head>
<body style="background-color:#d1e6d4">
    <?php include_once("../navbar.php"); ?>

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-11 m-auto">
                <div class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                    <div class="card-header bg-success text-white">
                        <b>Data Kendaraan</b>
                        <a href="tambah.php" class="float-end btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i> Tambah Data</a>
                    </div>
                    <div class="card-body overflow-auto">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama Unit</th>
                                    <th scope="col">No Rangka</th>
                                    <th scope="col">Merk</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Tahun</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("../koneksi.php");
                                $qry = "SELECT kendaraan.*, merk.nama_merk, tipe_kendaraan.nama_tipe 
                                        FROM kendaraan 
                                        JOIN merk ON kendaraan.id_merk = merk.id_merk 
                                        JOIN tipe_kendaraan ON kendaraan.id_tipe = tipe_kendaraan.id_tipe
                                        ORDER BY kendaraan.id_kendaraan DESC";
                                $tampil = mysqli_query($koneksi, $qry);
                                $nomor = 1;
                                foreach($tampil as $data){
                                ?>
                                <tr>
                                    <th scope="row"><?=$nomor++?></th>
                                    <td>
                                        <?php if(!empty($data['foto_unit'])): ?>
                                            <img src="../img/<?=$data['foto_unit']?>" alt="Foto" width="80" class="img-thumbnail">
                                        <?php else: ?>
                                            <span class="text-muted">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?=$data['nama_unit']?></td>
                                    <td><?=$data['no_rangka']?></td>
                                    <td><?=$data['nama_merk']?></td>
                                    <td><?=$data['nama_tipe']?></td>
                                    <td><?=$data['tahun_produksi']?></td>
                                    <td>Rp <?=number_format($data['harga_jual'], 0, ',', '.')?></td>
                                    <td>
                                        <?php if($data['status_stok'] == 'Tersedia'): ?>
                                            <span class="badge bg-success">Tersedia</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Terjual</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="edit.php?id=<?=$data['id_kendaraan']?>" class="btn btn-info btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalhapus<?=$data['id_kendaraan']?>"><i class="fa-solid fa-trash"></i></button>

                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="modalhapus<?=$data['id_kendaraan']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Peringatan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">
                                                  Yakin data kendaraan <b><?=$data['nama_unit']?></b> ingin dihapus?
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a href="proseshapus.php?id=<?=$data['id_kendaraan']?>" class="btn btn-danger">Hapus</a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../js/all.js"></script>
</body>
</html>
