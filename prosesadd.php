<?php

include_once("config.php");
session_start();
if (!isset($_SESSION['adminloggedin'])) {
    echo "<script>
        alert('Silahkan log in sebagai admin terlebih dahulu!');
        window.location.href = 'index.php';
    </script>";
}

$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$alamat = $_POST['alamat'];
$pass = $_POST['pass'];

$sql = "INSERT INTO user (username,pass,nohp, alamat) VALUES ('$nama', '$pass', '$nohp', '$alamat')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('Data pelanggan berhasil ditambahkan');
            window.location.href = 'adminpage.php';
        </script>";
}
