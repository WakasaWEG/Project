<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Онлайн-аптека | Главная</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
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

        .qr-socials {
            background: #f7f7f7;
            padding: 40px 20px;
            text-align: center;
        }

        .qr-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .qr-image {
            width: 160px;
            height: 160px;
            border: 3px solid #85d7c8;
            border-radius: 12px;
        }

        .social-icons {
            display: flex;
            gap: 30px;
            justify-content: center;
            margin-top: 10px;
        }

        .social-icons img {
            width: 48px;
            height: 48px;
            transition: transform 0.3s ease;
        }

        .social-icons img:hover {
            transform: scale(1.2);
        }

        /* Шапка */
        .header {
            background-color: #85d7c8;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
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

        /* Главный баннер */
        .hero {
            position: relative;
            background: url('apteka.jpg') center/cover no-repeat;
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .hero::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 30px;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
        }

        .hero-buttons {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .hero-buttons a {
            background-color: #85d7c8;
            color: #000;
            text-decoration: none;
            padding: 15px 30px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .hero-buttons a:hover {
            background-color: #60c7b3;
            transform: translateY(-3px);
        }

        /* Информационный блок */
        .info-section {
            background: linear-gradient(135deg, #85d7c8 0%, #A569BD 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
        }

        .info-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .info-section p {
            font-size: 20px;
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Карта */
        .map-container {
            width: 100%;
            height: 400px;
            margin-top: 40px;
        }

        /* Подвал */
        .footer-divider {
            height: 5px;
            background-color: #85d7c8;
            width: 100%;
        }

        .footer {
            background-color: #000000;
            color: #ffffff;
            text-align: center;
            padding: 30px 0;
            font-family: 'Roboto', sans-serif;
        }

        .footer-info {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .catalog-link {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid #85d7c8;
            border-radius: 6px;
        }

        .catalog-link:hover {
            background-color: #85d7c8;
            color: #000;
        }

        @media (max-width: 600px) {
            .hero h1 {
                font-size: 32px;
            }

            .hero-buttons a {
                font-size: 18px;
                padding: 12px 24px;
            }

            .info-section h2 {
                font-size: 28px;
            }

            .info-section p {
                font-size: 18px;
            }
        }
        

      .why-us-section .why-us-content {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .why-us-text {
            flex: 1 1 400px;
            min-width: 280px;
            text-align: left;
        }

        .why-us-image {
            flex: 0 0 auto;
        }

        .why-us-image img {
            width: 400px;
            height: 400px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .why-us-content {
                flex-direction: column;
                text-align: center;
            }

            .why-us-text {
                text-align: left;
            }

            .why-us-image img {
                width: 280px;
                height: 280px;
            }
        }

        .login-icon {
            position: absolute;
            top: 10px;
            right: 30px;
            z-index: 1000;
            display: block;
            width: 40px;
            height: 40px;
        }

        .login-icon img {
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .login-icon img:hover {
            transform: scale(1.2);
        }

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
</head>
<body>

    <!-- Шапка -->
    <header class="header">
        <a href="#" class="logo-container">
            <img src="pharmacy.png" alt="Логотип" class="logo" />
            <span class="logo-text">Онлайн-аптека</span>
        </a>

        <a href="Authorization.php" class="login-icon">
            <img src="login-icon.png" alt="Авторизация" />
        </a>

        <nav>
            <ul class="nav-menu">
                <li><a href="OnlinePharmacy.php">Главная</a></li>
                <li><a href="Catalog.php">Каталог</a></li>
                <li><a href="News.php">Новости</a></li>
                <li><a href="cart.php">Корзина</a></li>
            </ul>
        </nav>
    </header>

    <!-- Главный блок -->
    <section class="hero">
        <div class="hero-content">
            <h1>Добро пожаловать в онлайн-аптеку</h1>
            <div class="hero-buttons">
                <a href="Catalog.php">Перейти в каталог</a>
                <a href="News.php">Перейти к новостям</a>
            </div>
        </div>
    </section>

    <!-- Информация -->
    <section class="info-section">
        <h2>Удобство, скорость и доступность</h2>
        <p>
            Мы предлагаем быструю доставку медикаментов прямо до вашей двери — от 30 минут! <br />
            Заказывайте в любое время, следите за новостями и получайте только оригинальные препараты.
        </p>
        <br />
        <br />
        <div>
            <img src="qr-code.png" alt="QR-код" class="qr-image" />
            <div class="social-icons">
                <a href="https://t.me/yourchannel" target="_blank" rel="noopener noreferrer">
                    <img src="telegram-icon.png" alt="Telegram" />
                </a>
                <a href="https://vk.com/yourpage" target="_blank" rel="noopener noreferrer">
                    <img src="vk-icon.png" alt="VK" />
                </a>
            </div>
        </div>
    </section>

    <!-- Почему выбирают нас -->
    <section class="info-section why-us-section" style="background: #f0f0f0; color: #333;">
        <div class="why-us-content">
            <div class="why-us-text">
                <h2>Почему выбирают нас?</h2>
                <p>
                    ✔️ Более 10 000 товаров в наличии<br />
                    ✔️ Удобный и интуитивный интерфейс сайта<br />
                    ✔️ Постоянные акции и бонусы для клиентов<br />
                    ✔️ Проверенные поставщики и сертифицированные препараты<br />
                    ✔️ Возможность заказать по рецепту и без
                </p>
            </div>
            <div class="why-us-image">
                <img src="why-us.jpg" alt="Преимущества" />
            </div>
        </div>
    </section>

    <!-- Часто задаваемые вопросы -->
    <section class="info-section">
        <h2>Часто задаваемые вопросы</h2>
        <p><strong>Как быстро доставляется заказ?</strong><br />
            Среднее время доставки — 30–90 минут в пределах города. Мы также предлагаем доставку в другие регионы курьерскими службами.</p>
        <br />
        <p><strong>Можно ли оплатить онлайн?</strong><br />
            Да, вы можете оплатить заказ банковской картой на сайте, а также наличными или картой курьеру.</p>
        <br />
        <p><strong>Нужен ли рецепт?</strong><br />
            Рецепт необходим только для некоторых видов медикаментов. У таких товаров будет пометка "требуется рецепт".</p>
        <br />
        <p><strong>Как я могу получить консультацию?</strong><br />
            Вы можете написать нам через Telegram или VK, либо позвонить по номеру, указанному в подвале сайта.</p>
    </section>

    <!-- Карта -->
    <section class="map-container">
        <!-- Пример вставки карты Яндекс -->
        <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A589a343e4d467840643c45a8b2e07df441a5904312a12c337875bbf0c060c925&amp;source=constructor" 
        width="100%" 
        height="500" 
        frameborder="0">
        </iframe>
    </section>

    <!-- Подвал -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="footer-divider"></div>   
    <footer class="footer">
        <div class="footer-info">
            Онлайн-аптека. Все права защищены.<br>
            Номер телефона аптеки: 8(800) 555-35-35.<br>
            Часы работы: 8:00 - 20:00 по МСК.
        </div>
        <a href="Catalog.php" class="catalog-link">Перейти в каталог</a>
    </footer>
</body>
</html>
