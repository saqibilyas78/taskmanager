<?php
session_start();
include_once '../controllers/Login.php';

$admin_user = $_POST['user_name'];
$admin_pass = $_POST['user_pass'];

$login = new Login();

$auth = $login->authenticate($admin_user, $admin_pass);

if ($auth) {
    header("Location: ../dashboard.php");
} else {
    header("Location: ../index.php?auth=false");
}
