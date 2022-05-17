<?php

include_once("config.php");
session_start();
if (!isset($_SESSION["adminloggedin"])) {
    echo "<script>
        alert('Silahkan log in sebagai admin terlebih dahulu!');
        window.location.href = 'index.php';
    </script>";
}

$sql = 'SELECT * FROM user INNER JOIN usertrx ON user.id = usertrx.userid';
$data_user = $conn->query($sql);

$sql2 = 'SELECT SUM(trx) as total from usertrx';
$data_summing = $conn->query($sql2);
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
                        <a class="nav-link active" href="tambahtrx.php">Tambah Transaksi</a>
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
            <h2>Data Transaksi</h2>
            <div class="table-responsive">
                <table class="table mt-2">
                    <form>
                        <div class="row">
                            <div class="col-8">
                                <input class="form-control" style="width: 100%;" type="search" placeholder="Search" aria-label="Search">
                            </div>
                            <div class="col-4">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Belanja</th>
                            <th scope="col">Total</th>
                            <th scope="col">Tanggal/Jam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($data_user)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $data['username'] ?></td>
                                <td><?= $data['trx'] ?></td>
                                <td><?= $data['total'] ?></td>
                                <td><?= $data['trxdate'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <h3>Total : <?= $data_summing ?></h3>
                </table>
            </div>
        </div>
    </div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>