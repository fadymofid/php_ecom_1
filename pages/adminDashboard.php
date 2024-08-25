<?php
$pageTitle = "Admin Dashboard";
include_once '../includes/header.php';

session_start();
include_once '../includes/header.php';
include('../models/AdminModel.php');
include('../models/OrdersModel.php');


$users = get_all_users();

echo '<div class="container">';
echo '<h1 class="text-center">Admin Dashboard</h1>';

if (!empty($users)) {
    echo '<div class="form-container">';
    echo '<table class="table table-striped">';
    echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Address</th><th>Actions</th></tr></thead><tbody>';
    foreach ($users as $user) {
        if ($user['type'] == "client") {
            echo '<tr>';
            echo '<td>' . $user['id'] . '</td>';
            echo '<td>' . $user['name'] . '</td>';
            echo '<td>' . $user['email'] . '</td>';
            echo '<td>' . $user['address'] . '</td>';
            echo '<td>';
            echo '<a href="adminDashboard.php?view_orders=' . $user['id'] . '" class="btn btn-info">View Orders</a> ';
            echo '<a href="adminDashboard.php?delete_user=' . $user['id'] . '" class="btn btn-warning">Delete</a>';
            echo '</td>';
            echo '</tr>';
        }
    }
    echo '</tbody></table>';
    echo '</div>';
} else {
    echo '<p class="text-center">No users found</p>';
}

// Handle delete request
if (isset($_GET['delete_user'])) {
    $userId = intval($_GET['delete_user']);
    if (delete_user($userId)) {
        echo '<p class="text-center">User deleted successfully.</p>';
        header("Refresh:0");
    }
}

if (isset($_GET['view_orders'])) {
    $userId = intval($_GET['view_orders']);
    $orders = get_user_orders($userId);

    echo '<div class="form-container">';
    echo '<h2 class="text-center">Orders for User ID '.$userId.'</h2>';

    if (!empty($orders)) {
        echo '<table class="table table-striped">';
        echo '<thead><tr><th>Product Name</th><th>Price</th></tr></thead><tbody>';
        foreach ($orders as $order) {
            echo '<tr>';
            echo '<td>'.$order['name'].'</td>';
            echo '<td>'.$order['price'].'</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p class="text-center">No orders found for this user.</p>';
    }
    echo '</div>';
}

include('../includes/footer.php');
?>
