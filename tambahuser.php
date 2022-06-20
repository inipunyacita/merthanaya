<?php

include_once("config.php");
session_start();
if (!isset($_SESSION["adminloggedin"])) {
    echo "<script>
        alert('Silahkan log in sebagai admin terlebih dahulu!');
        window.location.href = 'index.php';
    </script>";
}

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
                        <a class="nav-link active" aria-current="page" href="adminpage.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Tambah User</a>
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
        <div id="tambah-pelanggan">
            <h2>Pelanggan Baru</h2>
            <form method="post" action="prosesadd.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Nama :</label>
                    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" autocomplete="off" required>
                    <div id="emailHelp" class="form-text">Masukan nama pelanggan</div>
                </div>
                <div class="mb-3">
                    <label for="nohp" class="form-label">No HP :</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" aria-describedby="emailHelp" autocomplete="off">
                    <div id="emailHelp" class="form-text">Masukan no hp pelanggan</div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat :</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" aria-describedby="emailHelp" autocomplete="off">
                    <div id="emailHelp" class="form-text">Masukan alamat pelanggan</div>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Password</label>
                    <input type="password" class="form-control" id="pass" name="pass" autocomplete="off">
                    <div id="emailHelp" class="form-text">Masukan password untuk akun pelanggan</div>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                <a href="adminpage.php" class="btn btn-warning" style="width: 100%;">Kembali</a>
            </form>
        </div>
    </div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>