<?php
include_once '../includes/db.php';


function get_all_users() {
    $conn = connectToDB();
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];
    }
}


function get_user_orders($userId) {
    $conn = connectToDB();
    if ($conn) {
        $stmt = $conn->prepare("
            SELECT 
                o.id AS order_id, 
                p.name AS name, 
                p.price
            FROM 
                cart o
            JOIN 
                products p ON o.product_id = p.id
            WHERE 
                o.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];
    }
}


// Delete a user
function delete_user($userId) {
    $conn = connectToDB();
    if ($conn) {
        // First, delete all orders related to this user
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);

        // Then, delete the user
        $stmt = $conn->prepare("DELETE FROM user WHERE id = :user_id");
        $stmt->execute(['user_id' => $userId]);

        return $stmt->rowCount() > 0;
    } else {
        return false;
    }
}
