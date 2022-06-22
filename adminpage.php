<?php

include_once("config.php");
session_start();
if (!isset($_SESSION["adminloggedin"])) {
    echo "<script>
        alert('Silahkan log in sebagai admin terlebih dahulu!');
        window.location.href = 'index.php';
    </script>";
}

$sql = 'SELECT * FROM user WHERE id > 1';
$data_user = $conn->query($sql);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/stylesheet/style.css">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Merthanaya</title>
</head>

<body>
    <!-- navigation bar area -->
    <nav class="navbar navbar-expand-lg navbar-light bg-warning bg-gradient">
        <div class="container-fluid">
            <div class="left-nav">
                <a class="navbar-brand" href="#"><img src="src/img/logo.png" height="50" width="150" alt="Logo Merthanaya"></a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tambahuser.php">Tambah User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="tambahtrx.php">List Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="logoutproses.php">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- content start here -->
    <div class="container">
        <div id="data-pelanggan">
            <a href="tambahuser.php" class="btn btn-primary" style="width: 100%;">Tambah Pelanggan Baru</a>
            <hr>
            <h2>Data Pelanggan</h2>
            <div class="table-responsive">
                <table class="table mt-2">
                    <form method="get" action="adminpage.php">
                        <div class="row">
                            <div class="col-8">
                                <input class="form-control" style="width: 100%;" type="search" name="cari" placeholder="Masukan No ID/Username Pelanggan" aria-label="Search">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-outline-success" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['cari']) && $_GET['cari'] != null) {
                            $cari = $_GET['cari'];
                            $sql = "SELECT * FROM `user` WHERE (`id`like'%$cari%') or (`username`like'%$cari%')";
                            $data_user = $conn->query($sql);
                        } else {
                            $sql_user = "SELECT * FROM user";
                            $data_user = $conn->query($sql_user);
                        }
                        $no = 1;

                        while ($data = mysqli_fetch_assoc($data_user)) { ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $data['id']; ?></td>
                                <td><?= $data['username']; ?></td>
                                <td>
                                    <a href="tambahtransaksi.php?id=<?php echo $data['id'] ?>" class="btn btn-success mb-1 w-100">Tambah Transaksi</a>
                                    <a href="#"><button type="button" class="btn btn-primary w-100 mb-1 btn_detail" data-bs-toggle="modal" data-bs-target="#detail_modal" data-id="'.$data['id'].'">
                                            Detail
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="detail_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen-sm-down">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Detail Informasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= $data['username']; ?>
                                                        <?= $data['pass']; ?>
                                                        <?= $data['nohp']; ?>
                                                        <?= $data['alamat']; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Understood</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="btn btn-warning mb-1 text-white w-100">Edit</a>
                                    <a href="#" class="btn btn-danger mb-1 w-100">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $('.btn_detail').click(function() {
            var id = $(this).attr('data-id');
            $('#detail-modal').find('.modal-body').html(id);
        });
    </script>
</body>

</html>