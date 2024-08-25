<?php
$pageTitle = "orders";
include_once '../includes/header.php';

session_start();

if (!isset($_SESSION['id'])) {
    header("location: ../login.php");
    exit();
}

include_once('../models/OrdersModel.php');

$userId = $_SESSION['id'];

if (isset($_GET['remove'])) {
    $cartId = $_GET['remove'];

    if (remove_from_cart($cartId)) {
        header("Location: Orders.php");
        exit();
    } else {
        $error_message = "Failed to remove item from the cart.";
    }
}

$cartItems = get_cart_items($userId);
?>
<style>
    .background-icon {
        position: fixed;
        top: 76%;
        left: 23%;
        transform: translate(-50%, -50%);
        z-index: -1;
        opacity: 60%;
    }

    .icon {
        width:400px;
        height: 400px;

    }
    .background-icon2 {
        position: fixed;
        top: 39%;
        right: -15%;
        transform: translate(-50%, -50%);
        z-index: -1;
        opacity: 60%;
    }

    .icon2 {
        width: 576px;
        height: 627px;

    }

</style>
<div class="background-icon">

    <img src="../images/shop.png" alt="Background Icon" class="icon">

</div>
<div class="background-icon2">

    <img src="../images/shop.png" alt="Background Icon" class="icon2">

</div>
<div class="container mt-4">
    <h2>Your Orders</h2>

    <?php if (!empty($cartItems)) : ?>
        <div class="row">
            <?php foreach ($cartItems as $item) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p class="card-text">$<?php echo htmlspecialchars($item['price']); ?></p>
                            <a href="Orders.php?remove=<?php echo htmlspecialchars($item['cart_id']); ?>" class="btn btn-danger">Remove</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            Your order list empty.
        </div>
    <?php endif; ?>
</div>

<?php
include('../includes/footer.php');
?>
