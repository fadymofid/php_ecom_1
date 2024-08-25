<?php
include_once 'includes/header.php';
session_start();

if (isset($_SESSION['id'])) {
    if ($_SESSION['type'] == 'client') {
        header('Location: pages/products.php');
    } elseif ($_SESSION['type'] == 'admin') {
        header('Location: admin_dashboard.php');
    }
    exit();
}
header('Location: login.php');
exit();
?>
