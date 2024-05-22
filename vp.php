<?php
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
$FIO_vp = trim($_POST['FIO_vp']); 

$number_vp = $_POST['Number_vp'];

$status_vp = 0;
$type="vp";
$date_vp = date('Y-m-d');
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$stmt = $conn->prepare("INSERT INTO zayavki (FIO, Number, Type, Status, Date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $FIO_vp, $number_vp, $type, $status_vp, $date_vp);
if ($stmt->execute()) {
    echo 1;
} else {
    echo "Ошибка при регистрации: " . $stmt->error;
}
$stmt->close();
