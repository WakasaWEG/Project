<?php
session_start();
// Проверяем авторизацию пользователя
if (!isset($_SESSION['user']['ID'])) {
    exit("Ошибка: пользователь не авторизован.");
}
$user_id = intval($_SESSION['user']['ID']);

// Получаем ID товара и новое количество из запроса
$med_id = isset($_POST['med_id']) ? intval($_POST['med_id']) : 0;
$count = isset($_POST['count']) ? intval($_POST['count']) : 0;
$count = max(1, $count);
if ($med_id < 1) {
    exit("Ошибка: неверный запрос.");
}

// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "pharmacy-online");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Обновляем количество указанного товара в корзине пользователя
$stmt = $conn->prepare("UPDATE shopping_cart SET Count = ? WHERE ID_Users = ? AND ID_Medication = ?");
$stmt->bind_param("iii", $count, $user_id, $med_id);
$stmt->execute();
$stmt->close();
$conn->close();

// Возвращаем ответ
echo "ok";
?>
