<?php
session_start();
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "pharmacy-online");
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $password = $conn->real_escape_string(trim($_POST['password']));
    $sql = "SELECT * FROM users WHERE Phone = '$phone' AND Password = '$password'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = [
            "ID" => $row['ID_Users'],
            "Phone" => $row['Phone'],
            "Access" => $row['ID_Access_rights']
        ];
        if ($row['ID_Access_rights'] == 1) {
            header("Location: /Project/AdminCatalog.php");
        } else {
            header("Location: /Project/OnlinePharmacy.php");
        }
        exit();
    } else {
        $error = "Неверный номер телефона или пароль!";
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Онлайн-аптека | Авторизация</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #f2e4ff, #c398ec);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffffdd;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
        }
        h1 {
            color: #5c3b94;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        button {
            background-color: #85d7c8;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #76c0b5;
        }
        .error {
            color: #ff6666;
            margin-top: 10px;
        }
        .links {
            margin-top: 20px;
        }
        .links a {
            color: #5c3b94;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Авторизация</h1>
    <form method="POST">
        <input type="tel" name="phone" placeholder="Номер телефона" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
    <div class="links">
        <p>Нет аккаунта? <a href="Registration.html">Зарегистрируйтесь</a></p>
        <p><a href="OnlinePharmacy.php">На главную</a></p>
    </div>
</div>
</body>
</html>
