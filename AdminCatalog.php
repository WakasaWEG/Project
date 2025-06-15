<?php
session_start();

// Проверяем, что пользователь — админ
if (!isset($_SESSION['user']) || $_SESSION['user']['Access'] != 1) {
  header("Location: OnlinePharmacy.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy-online");
if ($conn->connect_error) {
  die("<p style='color:red; text-align:center;'>Ошибка подключения: {$conn->connect_error}</p>");
}

// Обработка добавления
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['name'])) {
  $name = $conn->real_escape_string($_POST['name']);
  $price = floatval($_POST['price']);
  $description = $conn->real_escape_string($_POST['description']);

  $imageName = basename($_FILES['image']['name']);
  $targetDir = __DIR__ . "/img/";
  $targetPath = $targetDir . $imageName;

  if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
    $stmt = $conn->prepare("INSERT INTO medication (Name, Price, Description, Image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $name, $price, $description, $imageName);
    $stmt->execute();
    $stmt->close();
  } else {
    echo "<p style='color:red; text-align:center;'>Ошибка загрузки файла.</p>";
  }
}

// Обработка удаления
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM medication WHERE ID_med = $id");
  header("Location: AdminCatalog.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Админ | Управление каталогом</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #dee9fc;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #222;
    }
    form {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 500px;
      margin: 20px auto;
    }
    input, select, button {
      width: 100%;
      margin-bottom: 15px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    .medication-list {
      max-width: 800px;
      margin: 0 auto;
    }
    .med-card {
      display: flex;
      align-items: center;
      background: #fff;
      padding: 15px;
      margin: 10px 0;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    .med-card img {
      height: 60px;
      width: 60px;
      object-fit: cover;
      margin-right: 20px;
      border-radius: 6px;
    }
    .med-card-info {
      flex-grow: 1;
    }
    .delete-button {
      background: #e74c3c;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Управление каталогом</h1>

  <form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Название" required>
    <input type="number" name="price" step="0.01" placeholder="Цена" required>
    <select name="description" required>
      <option value="Без рецепта">Без рецепта</option>
      <option value="По рецепту">По рецепту</option>
    </select>
    <input type="file" name="image" accept="image/*" required>
    <button type="submit">Добавить препарат</button>
  </form>

  <div class="medication-list">
    <?php
    $result = $conn->query("SELECT * FROM medication ORDER BY ID_med DESC");
    while ($row = $result->fetch_assoc()) {
      echo "<div class='med-card'>";
      echo "<img src='img/" . htmlspecialchars($row['Image']) . "'>";
      echo "<div class='med-card-info'>";
      echo "<strong>" . htmlspecialchars($row['Name']) . "</strong><br>";
      echo "Цена: " . number_format($row['Price'], 2) . " руб.<br>";
      echo "Тип: " . htmlspecialchars($row['Description']) . "<br>";
      echo "</div>";
      echo "<form method='GET' style='margin: 0;'><input type='hidden' name='delete' value='" . $row['ID_med'] . "'>";
      echo "<button class='delete-button' type='submit' onclick='return confirm(\"Удалить?\")'>Удалить</button></form>";
      echo "</div>";
    }
    ?>
  </div>
</body>
</html>
