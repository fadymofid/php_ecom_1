<?php
$pageTitle = "Login";
include_once('includes/header.php');

session_start();
include_once('models/UserModel.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data_check = login($_POST['email'], $_POST['password']);
    if (is_array($data_check)) {
        $_SESSION['id'] = $data_check['id'];
        $_SESSION['email'] = $data_check['email'];
        $_SESSION['name'] = $data_check['name'];
        $_SESSION['type'] = $data_check['type'];

        if ($data_check['type'] == 'admin') {
            header('Location: pages/adminDashboard.php');
        } else {
            header('Location: pages/products.php');
        }
        exit();
    } else {
        $error_message = "Invalid email or password.";
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
        .btn{
            background-color: #6c8388;
            border-color: #6c8388;

        }
        .btn:hover {
            background-color: #4d5d61;
            border-color: #4d5d61;
        }
    }
    .background-icon {
        position: fixed;
        top: 15%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: -1;
        opacity: 90%;
    }

    .icon {
        width:100px;

    }
</style>

<div class="background-icon">

    <img src="images/store.png" alt="Background Icon" class="icon">

</div>
<div class="justify-content-center items-center" style="margin-top: 180px">
<div class="form-container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mb-4 text-center">Login</h2>
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <p class="mt-3">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</div>
<?php
include_once('includes/footer.php');
?>
