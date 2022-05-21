<?php

include_once("config.php");
session_start();
if (!isset($_SESSION['adminloggedin'])) {
    echo "<script>
        alert('Silahkan log in sebagai admin terlebih dahulu!');
        window.location.href = 'index.php';
    </script>";
}

$date = str_shuffle(date("mdyHis"));
$nama = $_POST['nama'];
$nohp = $_POST['nohp'];
$alamat = $_POST['alamat'];
$pass = $_POST['pass'];

$sql = "INSERT INTO user(`id`,`username`, `password`, `nohp`, `alamat`) VALUES ('$date','$nama', '$pass', '$nohp', '$alamat')";
$query = $conn->query($sql);

if ($query) {
    echo "<script>
            alert('Data pelanggan berhasil ditambahkan');
            window.location.href = 'adminpage.php';
        </script>";
}
