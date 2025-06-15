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

// Проверяем, есть ли уже этот товар в корзине пользователя
$stmt = $conn->prepare("SELECT Count FROM shopping_cart WHERE ID_Users = ? AND ID_Medication = ?");
$stmt->bind_param("ii", $user_id, $med_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Если товар уже есть, увеличиваем его количество на 1
    $new_count = $row['Count'] + 1;
    $update = $conn->prepare("UPDATE shopping_cart SET Count = ? WHERE ID_Users = ? AND ID_Medication = ?");
    $update->bind_param("iii", $new_count, $user_id, $med_id);
    $update->execute();
    $update->close();
} else {
    // Если товара еще нет в корзине, добавляем новую запись с количеством 1
    $insert = $conn->prepare("INSERT INTO shopping_cart (ID_Users, ID_Medication, Count) VALUES (?, ?, 1)");
    $insert->bind_param("ii", $user_id, $med_id);
    $insert->execute();
    $insert->close();
}

$stmt->close();
$conn->close();

// Перенаправляем пользователя обратно на страницу корзины
header("Location: ../cart.php");
exit();
?>
