<?php
$pageTitle = "register";
session_start();

include_once('models/UserModel.php');
include_once ('includes/header.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    $user = register($name, $email, $password, $address, $type);

    echo '<div class="alert alert-success">Registration successful.</div>';
    header("Refresh: 2; url=login.php");
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

<div class="form-container">
    <h2 class="text-center mb-4">Register</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Address" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Register as:</label>
            <select id="type" name="type" class="form-select" required>
                <option value="client">Client</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary w-100">Register</button>
    </form>
</div>
<?php
include_once('includes/footer.php');


