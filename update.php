<?php
$pageTitle = "Update";
include_once 'models/UserModel.php';
include_once 'includes/header.php';

session_start();

if (!isset($_SESSION['id'])) {
    header("location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    if (update_user($userId, $name, $email, $password, $address)) {
        echo "<div class='alert alert-success text-center' role='alert'>Profile updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>Failed to update profile.</div>";
    }
} else {
    // Display user details in form
    $userId = $_SESSION['id'];
    $user = get_user_by_id($userId);

    if ($user) {
        $name = htmlspecialchars($user['name']);
        $password = htmlspecialchars($user['password']);
        $email = htmlspecialchars($user['email']);
        $address = htmlspecialchars($user['address']);
    } else {
        echo "<div class='alert alert-warning text-center' role='alert'>User not found.</div>";
        exit();
    }
}
?>
<style>
    body {
        background: #10465a;
        font-family: 'Arial', sans-serif;
        color: #fff;
    }
    .form-container {
        max-width: 700px;
        margin: 50px auto;
        padding: 40px;
        border-radius: 8px;
        background: rgba(13, 31, 53, 0.8);
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
    }
    .form-container h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }
    .form-container .form-label {
        font-weight: 600;
    }
    .form-container .form-control {
        border-radius: 0.375rem;
    }
    .form-container .btn {
        border-radius: 0.375rem;
        font-weight: 600;
    }
    .btn{
        background-color: #6c8388;
        border-color: #6c8388;

    }
    .btn:hover {
        background-color: #4d5d61;
        border-color: #4d5d61;
    }
    }
</style>
<div class="container form-container">
    <h2 class="text-center">Update Profile</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" value="<?php echo $password; ?>" required>
            <p class="form-text" style="color: white">Leave blank to keep current password.</p class="form-text">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="address" class="form-control" value="<?php echo $address; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</div>



