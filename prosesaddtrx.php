<?php

include_once("config.php");
session_start();
if (!isset($_SESSION["adminloggedin"]) && !isset($_SESSION["superadminloggedin"])) {
    echo "<script>
        alert('Silahkan log in terlebih dahulu!');
        window.location.href = 'index.php';
    </script>";
}

$id = $_POST['id'];
$jumlahtrx = $_POST['jumlahtrx'];

$sql = "INSERT INTO usertrx (userid,trx) VALUES ('$id', '$jumlahtrx')";
$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('Data transaksi pelanggan berhasil ditambahkan');
            window.location.href = 'adminpage.php';
        </script>";
}
