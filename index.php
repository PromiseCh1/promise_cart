<?php
session_start();

$products = [
    1 => ["name" => "(promise_44)Brown Zip Up Hoodie", "price" => 4500.00, "image" => "images/h1.jpg"],
    2 => ["name" => "(promise_44)Vintage Green Corduroy Hood Jacket", "price" => 6600.00, "image" => "images/h2.jpg"],
    3 => ["name" => "(promise_44)Vintage Blue Corduroy Hood Jacket", "price" => 7500.00, "image" => "images/h3.jpg"],
    4 => ["name" => "(promise_44)Mode23 Black Zip Up Hoodie", "price" => 3500.00, "image" => "images/h4.jpg"],
    5 => ["name" => "(promise_44)Charcoal hoodie", "price" => 5500.00, "image" => "images/h5.jpg"],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <h2>Product List: Hoodie</h2>
       <center> <p >Promise Chaudhary | Roll No: 44</p></center>
    </header>

    <main class="products">
        <?php foreach ($products as $id => $product): ?>
            <div class="product">
                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                <h3><?= $product['name'] ?></h3>
                <p class="price">Rs. <?= number_format($product['price'], 2) ?></p>
                <a class="btn" href="cart.php?action=add&id=<?= $id ?>">Add to Cart</a>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>