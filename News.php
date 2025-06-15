<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Онлайн-аптека | Новости</title>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #ffffff 0%, #A569BD 100%);
    }

    .header {
      background-color: #85d7c8;
      padding: 15px 0;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      position: relative;
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
    }

    .main-content {
      max-width: 1200px;
      margin: 40px auto;
      padding: 0 20px;
    }

    h1 {
      text-align: center;
      color: #800080;
      margin-bottom: 20px;
    }

    .filters {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 30px;
    }

    .filters button {
      padding: 8px 16px;
      background-color: white;
      border: 2px solid #85d7c8;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
    }

    .filters button.active,
    .filters button:hover {
      background-color: #85d7c8;
      color: black;
    }

    .news-card {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      grid-template-rows: auto auto auto;
      gap: 10px;
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 40px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .news-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .news-title {
      grid-column: 1 / 2;
      font-size: 24px;
      font-weight: bold;
      color: white;
      background-color: #85d7c8;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
    }

    .news-meta {
      grid-column: 1 / 2;
      font-size: 14px;
      color: #555;
      padding-left: 10px;
    }

    .news-description {
      grid-column: 1 / 2;
      font-size: 18px;
      background-color: #f5f5f5;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
    }

    .news-image {
      grid-column: 2 / 3;
      grid-row: 1 / span 3;
      overflow: hidden;
      border-radius: 10px;
    }

    .news-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .comments {
      grid-column: 1 / 3;
      padding-top: 10px;
    }

    .comments textarea {
      width: 100%;
      padding: 8px;
      resize: vertical;
      margin-top: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .comments button {
      margin-top: 5px;
      padding: 6px 12px;
      background-color: #85d7c8;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .comment-list {
      margin-top: 10px;
      font-size: 14px;
    }

    .footer {
      background-color: #000;
      color: white;
      text-align: center;
      padding: 30px 0;
    }

    .footer-divider {
      height: 5px;
      background-color: #85d7c8;
    }

    .home-link {
      color: #ffffff;
      text-decoration: none;
      font-size: 16px;
      padding: 8px 16px;
      border: 2px solid #85d7c8;
      border-radius: 6px;
    }

    .home-link:hover {
      background-color: #85d7c8;
      color: #000;
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
        <li><a href="Catalog.php">Каталог</a></li>
        <li><a href="News.php">Новости</a></li>
        <li><a href="cart.php">Корзина</a></li>
      </ul>
    </nav>
  </header>

  <main class="main-content">
    <h1>Новости</h1>

    <!-- Категории -->
    <div class="filters">
      <button class="active" data-category="all">Все</button>
      <button data-category="promo">Акции</button>
      <button data-category="logistics">Склад</button>
      <button data-category="delivery">Доставка</button>
      <button data-category="social">Социальная</button>
    </div>

    <!-- Новость -->
    <div class="news-card" data-category="promo">
      <div class="news-title">Коллаборация с ZXC.Okyn</div>
      <div class="news-meta">12 июня 2025 | Автор: PR-отдел</div>
      <div class="news-description">
        Совместная акция с исполнителем ZXC.Okyn. Получите шанс услышать эксклюзивный трек!
        <br><a href="https://music.yandex.ru/artist/24029938/tracks" target="_blank">Слушать</a>
      </div>
      <div class="news-image"><img src="RR.png" alt="ZXC.Okyn"></div>
      <div class="comments">
        <textarea placeholder="Оставьте комментарий..."></textarea>
        <button>Отправить</button>
        <div class="comment-list"></div>
      </div>
    </div>

    <div class="news-card" data-category="promo">
      <div class="news-title">Отдых с LazurWave</div>
      <div class="news-meta">10 июня 2025 | Автор: Маркетинг</div>
      <div class="news-description">Закажите препараты — получите скидку на отдых!</div>
      <div class="news-image"><img src="Hotel.png" alt="LazurWave"></div>
      <div class="comments">
        <textarea placeholder="Оставьте комментарий..."></textarea>
        <button>Отправить</button>
        <div class="comment-list"></div>
      </div>
    </div>

    <div class="news-card" data-category="logistics">
      <div class="news-title">Новый склад в Хамовниках</div>
      <div class="news-meta">8 июня 2025 | Автор: Логистика</div>
      <div class="news-description">Теперь доставка станет ещё быстрее.</div>
      <div class="news-image"><img src="warehouse.png" alt="Склад"></div>
      <div class="comments">
        <textarea placeholder="Оставьте комментарий..."></textarea>
        <button>Отправить</button>
        <div class="comment-list"></div>
      </div>
    </div>

    <div class="news-card" data-category="delivery">
      <div class="news-title">Ночные доставки</div>
      <div class="news-meta">5 июня 2025 | Автор: Отдел доставки</div>
      <div class="news-description">Доставка теперь круглосуточная!</div>
      <div class="news-image"><img src="night-delivery.png" alt="Ночная доставка"></div>
      <div class="comments">
        <textarea placeholder="Оставьте комментарий..."></textarea>
        <button>Отправить</button>
        <div class="comment-list"></div>
      </div>
    </div>

    <div class="news-card" data-category="social">
      <div class="news-title">Поддержка пожилых</div>
      <div class="news-meta">3 июня 2025 | Автор: Социальная программа</div>
      <div class="news-description">Скидки для пенсионеров и бесплатные консультации по пятницам.</div>
      <div class="news-image"><img src="senior-support.png" alt="Поддержка"></div>
      <div class="comments">
        <textarea placeholder="Оставьте комментарий..."></textarea>
        <button>Отправить</button>
        <div class="comment-list"></div>
      </div>
    </div>



  <div class="footer-divider"></div>
  <footer class="footer">
    Онлайн-аптека. Все права защищены.<br>
    Телефон: 8(800) 555-35-35.
    <br><br>
    <a href="OnlinePharmacy.php" class="home-link">Вернуться на главную</a>
  </footer>

  <script>
    // Фильтрация по категории
    const filterButtons = document.querySelectorAll('.filters button');
    const cards = document.querySelectorAll('.news-card');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        document.querySelector('.filters .active').classList.remove('active');
        button.classList.add('active');
        const category = button.dataset.category;

        cards.forEach(card => {
          card.style.display = (category === 'all' || card.dataset.category === category) ? 'grid' : 'none';
        });
      });
    });

    // Комментарии
    document.querySelectorAll('.news-card').forEach(card => {
      const btn = card.querySelector('button');
      const textarea = card.querySelector('textarea');
      const list = card.querySelector('.comment-list');

      btn.addEventListener('click', () => {
        const text = textarea.value.trim();
        if (text) {
          const div = document.createElement('div');
          div.textContent = '— ' + text;
          list.appendChild(div);
          textarea.value = '';
        }
      });
    });
  </script>
</body>
</html>
