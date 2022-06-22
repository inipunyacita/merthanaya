<?php

include_once("config.php");

session_start();

$sql = "SELECT * FROM user";
$data_user = $conn->query($sql);

if (isset($_SESSION['userloggedin'])) {
  echo "<script>
        alert('Silahkan log out dari user terlebih dahulu!');
        window.location.href = 'userpage.php';
    </script>";
}
if (isset($_SESSION['adminloggedin'])) {
  echo "<script>
        alert('Silahkan log out dari admin terlebih dahulu!');
        window.location.href = 'adminpage.php';
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
            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Informasi</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a href="#" class="dropdown-item">Berita</a></li>
              <li><a href="#" class="dropdown-item">Event</a></li>
              <li><a href="#" class="dropdown-item">Promo</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active">Kontak Kami</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- content start here -->
  <div class="container">
    <div class="login-area shadow-lg p-3 mb-5 bg-body rounded">
      <form action="auth.php" method="post">
        <div class="mb-3">
          <label for="texthp" class="form-label">Kasir :</label>
          <input type="text" name="nohp" class="form-control" id="nohp" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">Masukan admin</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password :</label>
          <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
          <div id="emailHelp" class="form-text">Masukan admind</div>
        </div>
        <button type="submit" class="btn btn-secondary">Masuk</button>
      </form>
    </div>
  </div>
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>