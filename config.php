<?php

$db_host = "localhost";
$db_user = "citanant_admin";
$db_pass = "citaadmin12345";
$db_name = "citanant_merthanaya";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    echo "Koneksi Gagal";
    die();
}
