<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
$FIO_pr = trim($_POST['FIO_pr']); 

$number_pr = $_POST['Number_pr'];

$status_pr = 0;

$date_pr = date('Y-m-d');
$type="pr";
$stmt = $conn->prepare("INSERT INTO zayavki (FIO, Number, Type, Status, Date) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $FIO_pr, $number_pr, $type, $status_pr, $date_pr);
if ($stmt->execute()) {
    echo 1;
}
$stmt->close();
$conn->close();
