<?php
session_start();
if ($_SESSION['access_rights'] != 1) {
   header("Location: ../AdminCatalog.php");
   exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy-online");
if ($conn->connect_error) die("Ошибка подключения: " . $conn->connect_error);

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];

$imageName = basename($_FILES['image']['name']);
$uploadDir = "../img/";
$target = $uploadDir . $imageName;
move_uploaded_file($_FILES['image']['tmp_name'], $target);

$stmt = $conn->prepare("INSERT INTO medication (Name, Price, Description, Image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdss", $name, $price, $description, $imageName);
$stmt->execute();
$stmt->close();

header("Location: ../AdminCatalog.php");
exit();
?>
