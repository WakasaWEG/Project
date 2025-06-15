<?php
session_start();
if ($_SESSION['access_rights'] != 1) {
    header("Location: ../OnlinePharmacy.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "pharmacy-online");
$id = $_GET['id'];
$conn->query("DELETE FROM medication WHERE ID_med = $id");

header("Location: ../AdminCatalog.php");
