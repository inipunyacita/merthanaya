<?php

session_start();
if (isset($_SESSION['userloggedin'])) {
    unset($_SESSION['userloggedin']);
    header('Location: index.php');
    exit;
} elseif (isset($_SESSION["superadminloggedin"])) {
    unset($_SESSION['superadminloggedin']);
    header('Location: index.php');
    exit;
} else {
    unset($_SESSION['adminloggedin']);
    header('Location: index.php');
    exit;
}
