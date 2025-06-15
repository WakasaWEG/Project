<?php
session_start();
if (!isset($_SESSION['user']['ID'])) {
  echo "Ошибка: пользователь не авторизован.";
  exit();
}
$conn = new mysqli("localhost", "root", "", "pharmacy-online");
if ($conn->connect_error) die("Ошибка подключения: " . $conn->connect_error);

$user_id = $_SESSION['user']['ID'];
$stmt = $conn->prepare("
    SELECT cart.Count, med.ID_med, med.Name, med.Price, med.Image
    FROM shopping_cart cart
    JOIN medication med ON cart.ID_Medication = med.ID_med
    WHERE cart.ID_Users = ?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
$total = 0;
while ($row = $result->fetch_assoc()) {
    $row['TotalPrice'] = $row['Count'] * $row['Price'];
    $total += $row['TotalPrice'];
    $items[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <title>Онлайн-аптека | Корзина</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #fefaff, #dab6f9);
      display: flex;
      flex-direction: column;
    }

    .header {
      background-color: #85d7c8;
      padding: 15px 0;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      z-index: 10;
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

    main {
      flex: 1;
    }

    .container {
      max-width: 1200px;
      margin: 40px auto;
      padding: 20px;
      background-color: #ffffffcc;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    h2 {
      text-align: center;
      color: purple;
    }

    .cart-scroll-wrapper {
      max-height: 400px;
      overflow-y: auto;
      margin-bottom: 20px;
      padding-right: 10px;
    }

    .item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      padding: 20px;
      border-radius: 12px;
      background: #fff;
      box-shadow: 0 3px 12px rgba(0,0,0,0.12);
    }

    .item-info {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .item-info img {
      height: 80px;
      width: 80px;
      object-fit: contain;
      border-radius: 8px;
      box-shadow: 0 0 6px rgba(0,0,0,0.1);
    }

    .item-info strong {
      font-size: 20px;
      color: #4a148c;
    }

    .item-info div {
      font-size: 18px;
      color: #333;
    }

    .qty {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .qty button {
      font-size: 18px;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
      border: 1px solid #ccc;
      background: #f0f0f0;
      transition: background-color 0.3s;
    }

    .qty button:hover {
      background: #dcdcdc;
    }

    .qty input {
      width: 50px;
      font-size: 18px;
      text-align: center;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .remove-btn {
      background-color: #e53935 !important;
      border: none !important;
      color: white !important;
      padding: 8px 14px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }

    .remove-btn:hover {
      background-color: #b71c1c !important;
    }

    #total {
      text-align: right;
      margin-top: 20px;
      font-size: 18px;
      font-weight: bold;
    }

    .pay-btn {
      display: block;
      margin: 20px auto 0;
      background-color: #2ecc71;
      border: none;
      color: white;
      padding: 14px 28px;
      font-size: 18px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .pay-btn:hover {
      background-color: #27ae60;
    }

    footer {
      background: #000;
      color: white;
      text-align: center;
      padding: 20px;
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
  </style>
</head>
<body>
  <header class="header">
    <a href="OnlinePharmacy.php" class="logo-container">
      <img src="pharmacy.png" alt="Логотип" class="logo" />
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

  <main>
    <div class="container">
      <h2>Корзина</h2>
      <div class="cart-scroll-wrapper">
        <?php if (empty($items)) : ?>
          <div class="empty-cart">Корзина пуста :(</div>
        <?php else: ?>
          <?php foreach ($items as $item): ?>
            <div class="item" data-med-id="<?= $item['ID_med'] ?>">
              <div class="item-info">
                <img src="img/<?= htmlspecialchars($item['Image']) ?>" alt="">
                <div>
                  <strong><?= htmlspecialchars($item['Name']) ?></strong><br>
                  <?= number_format($item['Price'], 2) ?> ₽
                </div>
              </div>
              <div class="qty">
                <button onclick="updateQty(<?= $item['ID_med'] ?>, -1)">-</button>
                <input type="number" value="<?= $item['Count'] ?>" onchange="manualQty(<?= $item['ID_med'] ?>, this.value)">
                <button onclick="updateQty(<?= $item['ID_med'] ?>, 1)">+</button>
                <button class="remove-btn" onclick="removeItem(<?= $item['ID_med'] ?>)">Удалить</button>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
      <div id="total">Итого: <?= number_format($total, 2) ?> ₽</div>
      <button class="pay-btn">Оплатить</button>
    </div>
  </main>

  <footer>
    <p>Онлайн-аптека. Все права защищены.<br>Телефон: 8 (800) 555-35-35 | Работаем 8:00 – 20:00 по МСК</p>
    <a href="OnlinePharmacy.php" class="home-link">Вернуться на главную</a>
  </footer>

  <script>
    function updateQty(medId, delta) {
      const input = document.querySelector(`[data-med-id='${medId}'] input`);
      let newQty = Math.max(1, parseInt(input.value) + delta);
      sendUpdate(medId, newQty);
    }

    function manualQty(medId, val) {
      const qty = Math.max(1, parseInt(val));
      sendUpdate(medId, qty);
    }

    function removeItem(medId) {
      fetch('php/remove_from_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'med_id=' + medId
      }).then(() => location.reload());
    }

    function sendUpdate(medId, qty) {
      fetch('php/update_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'med_id=' + medId + '&count=' + qty
      }).then(() => location.reload());
    }
  </script>
</body>
</html>
