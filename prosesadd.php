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
$total = $_POST['total'];
$pass = $_POST['pass'];

$sql = "INSERT INTO user(`username`, `password`, `total`, `nohp`, `alamat`) VALUES ('$nama', '$pass', '$total', '$nohp', '$alamat')";
$query = $conn->query($sql);

if ($query) {
    echo "<script>
            alert('Data pelanggan berhasil ditambahkan');
            window.location.href = 'adminpage.php';
        </script>";
}
