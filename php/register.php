<?php
// Подключение к БД
$conn = new mysqli("localhost", "root", "", "pharmacy-online");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получаем данные формы
$phone = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

if ($password !== $confirm) {
    echo "<script>alert('Пароли не совпадают!'); window.location.href='../Registration.html';</script>";
    exit();
}

// Защита
$phone = $conn->real_escape_string($phone);
$password = $conn->real_escape_string($password);

// Вставка пользователя
$sql = "INSERT INTO users (Phone, Password, ID_Access_rights) VALUES ('$phone', '$password', 2)";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Регистрация успешна! Войдите в аккаунт.'); window.location.href='../Authorization.html';</script>";
} else {
    echo "<script>alert('Ошибка регистрации: возможно, пользователь уже существует.'); window.location.href='../Registration.html';</script>";
}
?>
