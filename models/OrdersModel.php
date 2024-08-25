<?php
include_once '../includes/db.php';




function get_cart_items($userId) {
    $conn = connectToDB();
    if ($conn) {
        $stmt = $conn->prepare("SELECT c.id AS cart_id, p.id AS product_id, p.name, p.price, p.image 
                                FROM cart c
                                JOIN products p ON c.product_id = p.id
                                WHERE c.user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];
    }
}


function add_to_cart($userId, $productId) {
    $conn = connectToDB();
    if ($conn) {
        // Check if the item is already in the cart
        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        if ($stmt->rowCount() == 0) {
            // Item is not in the cart, add it
            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id) VALUES (:user_id, :product_id)");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
            return true;
        } else {
            // Item is already in the cart
            return false;
        }
    } else {
        return false;
    }
}


function remove_from_cart($cartId) {
    $conn = connectToDB();
    if ($conn) {
        $stmt = $conn->prepare("DELETE FROM cart WHERE id = :cart_id");
        $stmt->execute(['cart_id' => $cartId]);
        return $stmt->rowCount() > 0;
    } else {
        return false;
    }
}

function clear_cart($userId) {
    $conn = connectToDB();
    if ($conn) {
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->rowCount() > 0;
    } else {
        return false;
    }
}


function count_cart_items($userId) {
    $conn = connectToDB();
    if ($conn) {
        $stmt = $conn->prepare("SELECT COUNT(*) AS item_count FROM cart WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['item_count'];
    } else {
        return 0;
    }
}


