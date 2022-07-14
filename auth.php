<?php

session_start();

require_once "config.php";

if (empty($_POST['nohp']) && empty($_POST['pass']))  echo "<script>alert('Login Gagal No HP / Password Masih Kosong');window.location.href = 'index.php';</script>";

$user_name = $_POST['username'];
$user_pass = $_POST['pass'];

$user_sql = "SELECT * FROM user WHERE username = '$user_name'";

$user_query = $conn->query($user_sql)->fetch_assoc();

if (isset($user_query)) {
    if ($user_query['pass'] == $user_pass) {
        if ($user_query['username'] == 'superadmin') {
            $_SESSION["superadminloggedin"] = $user_query;
            echo "<script>
            alert('Login Sukses');
            window.location.href = 'adminpage.php';
            </script>";
        } elseif (($user_query['username'] == 'admin')) {
            $_SESSION["adminloggedin"] = $user_query;
            echo "<script>
            alert('Login Sukses');
            window.location.href = 'adminpage.php';
            </script>";
        } else {
            $_SESSION["userloggedin"] = $user_query;
            echo "<script>
            alert('Login Sukses');
            window.location.href = 'userpage.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Password salah');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Nohp salah / tidak ditemukan');
        window.location.href = 'index.php';
    </script>";
}
