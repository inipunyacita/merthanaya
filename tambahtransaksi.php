<?php

include_once("config.php");
session_start();
if (!isset($_SESSION["adminloggedin"]) && !isset($_SESSION["superadminloggedin"])) {
    echo "<script>
        alert('Silahkan log in terlebih dahulu!');
        window.location.href = 'index.php';
    </script>";
}
$id = $_GET['id'];
$sql = "SELECT * FROM user WHERE id =" . $id;
$data = $conn->query($sql);

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
        <div id="tambah-pelanggan">
            <h2>Transaksi Baru</h2>
            <form method="post" action="prosesaddtrx.php">
                <?php
                while ($row = mysqli_fetch_array($data)) {
                ?>
                    <input type="hidden" name="id" id="id" value="<?php echo $row['id'] ?>">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID User :</label>
                        <input type="text" class="form-control" id="id" name="id" aria-describedby="idHelp" autocomplete="off" value="<?php echo $row['id'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nama :</label>
                        <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp" autocomplete="off" value="<?php echo $row['username'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="jumlahtrx" class="form-label">Jumlah Transaksi :</label>
                        <input type="numeric" class="form-control" id="jumlatrx" name="jumlahtrx" aria-describedby="jumlahHelp" autocomplete="off">
                        <div id="jumlahHelp" class="form-text">Masukan jumlah transaksi pelanggan</div>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                <a href="adminpage.php" class="btn btn-warning" style="width: 100%;">Kembali</a>
            </form>
        </div>
    </div>
    <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>