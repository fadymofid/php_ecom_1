<?php
$pageTitle = "products";
include_once '../includes/header.php';

session_start();

if (!isset($_SESSION['id'])) {
    header("location: ../login.php");
    exit();
}

include_once('../includes/db.php');
include('../models/ProductModel.php');
include('../models/OrdersModel.php');  // Include the CartModel

$sortOrder = isset($_POST['sort']) ? $_POST['sort'] : 'ASC';
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

if ($searchTerm) {
    $data = search_products($searchTerm);
} else {
    $data = get_products($sortOrder);
}

// Handle Add to Cart
if (isset($_GET['add'])) {
    $productId = $_GET['add'];
    $userId = $_SESSION['id'];

    if (add_to_cart($userId, $productId)) {
        header("Location: products.php");
    } else {
        echo "<script>alert('Product is already in your cart.');</script>";
    }
}

?>
<div class="background-icon">

    <img src="../images/shop.png" alt="Background Icon" class="icon">

</div>
<div class="background-icon2">

    <img src="../images/shop.png" alt="Background Icon" class="icon2">

</div>
<div class="container mt-4">
    <a href="../update.php" class="profile-icon">
        <i class="fas fa-user-edit"></i>
    </a>
</div>

<div class="search">
    <form method="POST" action="">
        <input type="text" name="search" value="<?php echo $searchTerm; ?>" placeholder="Search by name">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<div class="container mt-4">
    <div class="row">
        <?php if (!empty($data)) : ?>
            <?php foreach ($data as $product) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p class="card-text">$<?php echo htmlspecialchars($product['price']); ?></p>
                            <a href="products.php?add=<?php echo htmlspecialchars($product['id']); ?>" class="order_btn btn btn-primary">Order</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>
</div>

<div style="position: fixed; top: 10px; right: 10px;">
    <a href="Orders.php" class="btn btn-warning">
            <i class="bi bi-basket2"></i>

        (<?php echo count_cart_items($_SESSION['id']); ?>)</a>
</div>
<?php
    include_once ('../includes/footer.php');
    ?>
