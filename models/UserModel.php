<?php
include_once 'includes/db.php';

function get_users($sortOrder = 'ASC') {
    $conn = connectToDB();
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM user ORDER BY id $sortOrder");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];
    }
}
function search_users($searchTerm) {
    $conn = connectToDB();
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM user WHERE Name LIKE :searchTerm");
        $stmt->execute(['searchTerm' => $searchTerm . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return [];
    }
}
function login($email, $password) {
    $conn = connectToDB();
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email AND password = :password");
    $stmt->execute(['email' => $email, 'password' => $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}


function register($name, $email, $password, $address,$type) {
    $conn = connectToDB();

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = :email OR name = :name");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':name', $name);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        return false;
    } else {

        $sql = "INSERT INTO user (name, email, password, address, type) VALUES (:name, :email, :password, :address, :type)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':type', $type);
        $stmt->execute();

        return true;
    }
}
function update_user($id, $name, $email, $password, $address)
{
    $conn = connectToDB();
    if ($conn) {
        $stmt = $conn->prepare("UPDATE user SET name = :name, email = :email, password = :password, address = :address WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'address' => $address,
        ]);
        return true;
    } else {
        return false;
    }
}
    function get_user_by_id($id) {
        $conn = connectToDB();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM user WHERE id = :id");
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

?>