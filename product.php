<?php
require 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Некорректный ID продукта.");
}

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Продукт не найден.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product['name']; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="product-detail">
        <img class="product-image-large" src="img/<?= $product['image']; ?>" alt="<?= $product['name']; ?>">
        <h1 class="product-name"><?= $product['name']; ?></h1>
        <p class="product-description"><?= $product['description']; ?></p>
        <p class="product-description"><?= $product['technical_specs']; ?></p>
        <p class="price">Цена: <?= $product['price']; ?> руб.</p>
        <a href="search.php" class="back-link">Вернуться к списку</a>
    </div>
</body>
</html>
