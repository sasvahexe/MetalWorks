<?php
// Подключаем файл с базой данных
include 'db.php';

// Инициализация переменной для результатов поиска
$searchResults = [];

// Обрабатываем запрос поиска
if (isset($_GET['query'])) {
    $search = htmlspecialchars($_GET['query']);  // Получаем запрос пользователя и защищаем от XSS
    $sql = "SELECT * FROM products WHERE name LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => '%' . $search . '%']);
    $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск товаров</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Шапка сайта -->
    <header class="header">
        <div class="logo">
            <a href="search.php"><img src="img/logo.png" alt="Логотип" class="logo-img"></a>
        </div>
        <div class="search">
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="Введите название товара" required>
            <button type="submit">Поиск</button>
        </form>
        </div>
        <div class="login">
            <a href="#" class="login-text"><img src="img/login.svg" alt=""></a>
        </div>
    </header>

    <section class="promo">
    <h1 class="promo-title">Компания MetalWorks <br /> Мы вдохновляем ваше производство!</h1>
    <p class="promo-text">Наш сайт — это ваш надежный гид в мире станков и технологий.</p>
    <p class="promo-text">Телефон горячей линии<br />«8 (800) 100-10-10»</p>
</section>  


    <!-- Блок с результатами поиска -->
    <section class="product-container">
        <?php if (!empty($searchResults)): ?>
            <?php foreach ($searchResults as $product): ?>
                <div class="product-card">
                <a href="product.php?id=<?= $product['id']; ?>" class="product-link">
                    <img class="product-image" src="img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h2 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h2>
                    <div class="short-text">
                    <?php echo htmlspecialchars($product['description']); ?>
                </div>
                    <p class="product-price">Цена: <?php echo $product['price']; ?> руб.</p>
                </a>
                </div>
            <?php endforeach; ?>
            
        <?php else: ?> 
            <?php
// Подключаемся к базе данных
include 'db.php';

// Получаем данные из таблицы "products"
$sql = "SELECT * FROM products";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="product-container">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
            <a href="product.php?id=<?= $product['id']; ?>" class="product-link">
                <img class="product-image" src="img/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h4 class="product-name"><?php echo htmlspecialchars($product['name']); ?></h4>
                <div class="short-text">
                    <?php echo htmlspecialchars($product['description']); ?>
                </div>
                <p class="product-price">Цена: <?php echo htmlspecialchars($product['price']); ?> руб.</p>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

        <?php endif; ?>
    </section>
</body>
</html>