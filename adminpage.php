<?php

include_once("config.php");
session_start();
if (!isset($_SESSION["adminloggedin"]) && !isset($_SESSION["superadminloggedin"])) {
    echo "<script>
        alert('Silahkan log in terlebih dahulu!');
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
                        <a class="nav-link active" href="tambahuser.php">Tambah Pelanggan</a>
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
                        $batas = 10;
                        $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous = $halaman - 1;
                        $next = $halaman + 1;

                        $data = $conn->query("SELECT * FROM user");
                        $jumlah_data = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);
                        if (isset($_GET['cari']) && $_GET['cari'] != null) {
                            $cari = $_GET['cari'];
                            $sql = "SELECT * FROM `user` WHERE (`id`like'%$cari%') or (`username`like'%$cari%') limit $halaman_awal, $batas";
                            $data_user = $conn->query($sql);
                        } else {
                            $sql_user = "SELECT * FROM user limit $halaman_awal, $batas";
                            $data_user = $conn->query($sql_user);
                        }
                        $nomor = $halaman_awal + 1;
                        $no = 1;

                        while ($data = mysqli_fetch_assoc($data_user)) { ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $data['id']; ?></td>
                                <td><?= $data['username']; ?></td>
                                <td>
                                    <a href="tambahtransaksi.php?id=<?php echo $data['id'] ?>" class="btn btn-success mb-1 w-100">Tambah Transaksi</a>
                                    <a href="#"><button type="button" class="btn btn-secondary w-100 mb-1 btn_detail" data-bs-toggle="modal" data-bs-target="#detail_modal<?php echo $data['id'] ?>">
                                            Detail
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="detail_modal<?php echo $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-fullscreen-sm-down">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Detail Informasi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-4"><label for="">ID</label></div>
                                                                <div class="col-1"><label for="">:</label></div>
                                                                <div class="col-5"><?= $data['id']; ?></div>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-4"><label for="">Username</label></div>
                                                                <div class="col-1"><label for="">:</label></div>
                                                                <div class="col-5"><?= $data['username']; ?></div>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-4"><label for="">Pass</label></div>
                                                                <div class="col-1"><label for="">:</label></div>
                                                                <div class="col-5"><?= $data['pass']; ?></div>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-4"><label for="">No HP</label></div>
                                                                <div class="col-1"><label for="">:</label></div>
                                                                <div class="col-5"><?= $data['nohp']; ?></div>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-4"><label for="">Alamat</label></div>
                                                                <div class="col-1"><label for="">:</label></div>
                                                                <div class="col-5"><?= $data['alamat']; ?></div>
                                                            </div>
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-4"><label for="">Tgl Buat Akun</label></div>
                                                                <div class="col-1"><label for="">:</label></div>
                                                                <div class="col-5"><?= $data['created_at']; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                    if (isset($_SESSION["superadminloggedin"])) {

                                    ?>
                                        <a href='editakun.php?id=<?php echo $data['id'] ?>' class="btn btn-warning mb-1 text-white w-100">Edit</a>
                                        <a href='deleteakun.php?id=<?php echo $data['id'] ?>' class="btn btn-danger mb-1 w-100">Hapus</a>
                                    <?php
                                    } else {

                                    ?>

                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination flex-wrap justify-content-center mt-3">
                    <li class="page-item">
                        <a class="page-link" <?php if ($halaman > 1) {
                                                    echo "href='?halaman=$previous'";
                                                } ?>>Previous</a>
                    </li>
                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                    <?php } ?>
                    <li class="page-item"><a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                    echo "href='?halaman=$next'";
                                                                } ?>>Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>