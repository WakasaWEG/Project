<?php
session_start();
// Проверяем авторизацию пользователя
if (!isset($_SESSION['user']['ID'])) {
    exit("Ошибка: пользователь не авторизован.");
}
$user_id = intval($_SESSION['user']['ID']);

// Получаем ID товара из запроса
$med_id = isset($_POST['med_id']) ? intval($_POST['med_id']) : 0;
if ($med_id < 1) {
    exit("Ошибка: неверный запрос.");
}

// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "pharmacy-online");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Удаляем товар из корзины пользователя
$stmt = $conn->prepare("DELETE FROM shopping_cart WHERE ID_Users = ? AND ID_Medication = ?");
$stmt->bind_param("ii", $user_id, $med_id);
$stmt->execute();
$stmt->close();
$conn->close();

// Возвращаем успешный ответ
echo "ok";
?>
