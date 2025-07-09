<?php
session_start();

$products = [
    1 => ["name" => "Mode Brown Zip Up Hoodie", "price" => 4500.00],
    2 => ["name" => "Vintage Green Corduroy Hood Jacket", "price" => 6600.00],
    3 => ["name" => "Vintage Blue Corduroy Hood Jacket", "price" => 7500.00],
    4 => ["name" => "Mode23 Black Zip Up Hoodie", "price" => 3500.00],
    5 => ["name" => "Charcoal hoodie", "price" => 5500.00],
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'add' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        if (isset($products[$id])) {
            if (!isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] = 1;
            } elseif (is_int($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]++;
            }
        }
    }
    elseif ($action === 'decrease' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        if (isset($_SESSION['cart'][$id])) {
            if ($_SESSION['cart'][$id] > 1) {
                $_SESSION['cart'][$id]--;
            } else {
                unset($_SESSION['cart'][$id]);
            }
        }
    }
    elseif ($action === 'remove' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }
    elseif ($action === 'clear') {
        unset($_SESSION['cart']);
    }

    $redirect = strtok($_SERVER["REQUEST_URI"], '?');
    header("Location: $redirect");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="style_cart.css">
</head>
<body>

    <h2>Your Cart</h2>
    <p class="credit">Promise Chaudhary | Roll No: 44</p>

    <?php if (!empty($_SESSION['cart'])): ?>
    <?php $total = 0; ?>
    <table class="cart-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['cart'] as $id => $qty): ?>
            <?php
            if (!isset($products[$id])) continue;
            $item = $products[$id];
            $sub_total = $item['price'] * $qty;
            $total += $sub_total;
            ?>
            <tr>
                <td data-label="Product Name"><?= htmlspecialchars($item['name']) ?></td>
                <td data-label="Price">Rs. <?= number_format($item['price'], 2) ?></td>
                <td data-label="Quantity"><?= $qty ?></td>
                <td data-label="Subtotal">Rs. <?= number_format($sub_total, 2) ?></td>
                <td data-label="Actions" class="actions">
                    <a href="?action=decrease&id=<?= $id ?>">−</a>
                    <a href="?action=add&id=<?= $id ?>">+</a>
                    <a href="?action=remove&id=<?= $id ?>" class="remove">Remove</a>
                </td>
            </tr>
        <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Total:</td>
                <td colspan="2">Rs. <?= number_format($total, 2) ?></td>
            </tr>
        </tbody>
    </table>

    <div class="actions">
        <a href="index.php">← Back to Products</a>
        <a class="clear-btn" href="?action=clear" onclick="return confirm('Clear entire cart?');">Clear Cart</a>
    </div>

<?php else: ?>
    <p class="empty">Your cart is empty.</p>
    <div class="actions">
        <a href="index.php">← Back to Products</a>
    </div>
<?php endif; ?>


</body>
</html>
