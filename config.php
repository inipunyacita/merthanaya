<?php

$db_host = "localhost";
$db_user = "merthana_cita";
$db_pass = "merthanayacita12345";
$db_name = "merthana_db";

// $db_host = "localhost";
// $db_user = "root";
// $db_pass = "";
// $db_name = "db_merthanaya";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    echo "Koneksi Gagal";
    die();
}
