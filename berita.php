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
if (isset($_SESSION['superadminloggedin'])) {
  echo "<script>
        alert('Silahkan log out dari super admin terlebih dahulu!');
        window.location.href = 'adminpage.php';
    </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Berita under maintenance</h1>
</body>
</html>