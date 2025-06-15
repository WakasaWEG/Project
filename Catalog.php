<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Онлайн-аптека | Каталог</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #ffffff 0%, #A569BD 100%);
        }
        .logo-container {
            display: flex;
            align-items: center;
            position: absolute;
            left: 30px;
            top: 10px;
            z-index: 1000;
            text-decoration: none;
        }
        .logo {
            height: 40px;
            margin-right: 10px;
        }
        .logo-text {
            font-size: 22px;
            font-weight: bold;
            color: white;
            font-family: 'Roboto', sans-serif;
        }
        .header {
            background-color: #85d7c8;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .nav-menu {
            display: flex;
            justify-content: center;
            gap: 40px;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }
        .nav-menu a:hover {
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.7);
        }
        .main-content {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .catalog-switcher {
            display: flex;
            justify-content: center;
            margin: 30px 0;
            gap: 20px;
        }
        .catalog-switcher a {
            color: #800080;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .catalog-switcher a.active {
            background-color: #85d7c8;
            color: white;
        }
        .catalog-switcher a:not(.active):hover {
            background-color: rgba(133, 215, 200, 0.2);
        }
        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(4, auto);
            gap: 30px;
            margin-bottom: 40px;
        }
        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border: 2px solid #85d7c8;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #85d7c8;
        }
        .product-info {
            padding: 15px;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
        }
        .product-price {
            font-size: 20px;
            color: #800080;
            font-weight: bold;
            margin: 10px 0;
        }
        .product-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
            font-weight: bold;
        }
        .otc {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #2e7d32;
        }
        .footer-divider {
            height: 5px;
            background-color: #85d7c8;
            width: 100%;
        }
        .footer {
            background-color: #000000;
            color: white;
            text-align: center;
            padding: 30px 0;
            font-family: 'Roboto', sans-serif;
        }
        .footer-info {
            font-size: 16px;
            margin-bottom: 15px;
        }
        .home-link {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid #85d7c8;
            border-radius: 6px;
        }
        .home-link:hover {
            background-color: #85d7c8;
            color: #000;
        }
        .subtitle {
            font-size: 20pt;
            margin-bottom: 10px;
            text-align: center;
            color: #85d7c8;
        }
        .add-to-cart {
            background: linear-gradient(135deg, #4CAF50, #85d7c8);
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 7px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-top: 10px;
        }
        .add-to-cart:hover {
            background: linear-gradient(135deg, #388E3C, #85d7c8);
            transform: scale(1.02);
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="OnlinePharmacy.php" class="logo-container">
            <img src="pharmacy.png" alt="Логотип" class="logo">
            <span class="logo-text">Онлайн-аптека</span>
        </a>
        <nav>
            <ul class="nav-menu">
                <li><a href="OnlinePharmacy.php">Главная</a></li>
                <li><a href="Catalog.php" class="active">Каталог</a></li>
                <li><a href="News.php">Новости</a></li>
                <li><a href="cart.php">Корзина</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <div><h2 class="subtitle">Каталог</h2></div>
        <div class="catalog-switcher">
            <a href="Catalog.php" class="active">Без рецепта</a>
            <a href="Catalog1.php">Рецептурные препараты</a>
        </div>

        <div class="products-grid">
        <?php
        $conn = new mysqli("localhost", "root", "", "pharmacy-online");
        if ($conn->connect_error) die("Ошибка подключения: " . $conn->connect_error);

        $result = $conn->query("SELECT * FROM medication WHERE Description = 'Без рецепта'");
        while ($row = $result->fetch_assoc()) {
            $id = $row['ID_med'];
            $name = htmlspecialchars($row['Name']);
            $price = number_format($row['Price'], 2);
            $image = htmlspecialchars($row['Image']);
            echo "
            <div class='product-card'>
                <img src='img/$image' alt='$name' class='product-image'>
                <div class='product-info'>
                    <div class='product-name'>$name</div>
                    <div class='product-price'>{$price} ₽</div>
                    <span class='product-status otc'>Без рецепта</span>
                </div>
                <form action='php/add_to_cart.php' method='POST'>
                    <input type='hidden' name='med_id' value='$id'>
                    <input type='hidden' name='redirect' value='Catalog.php'>
                    <button type='submit' class='add-to-cart'>Добавить в корзину</button>
                </form>
            </div>
            ";
        }
        $conn->close();
        ?>
        </div>
    </main>

    <div class="footer-divider"></div>
    <footer class="footer">
        <div class="footer-info">
            Онлайн-аптека. Все права защищены.<br>
            Номер телефона аптеки: 8(800) 555-35-35.
        </div>
        <a href="OnlinePharmacy.php" class="home-link">Вернуться на главную</a>
    </footer>
</body>
</html>
