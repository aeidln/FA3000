<?php
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
$fullName = $_POST['FIO_pr'];
// Разбиваем строку на три части
$nameParts = explode(" ", $fullName);
list($LastName_pr, $FirstName_pr, $Patronymic_pr) = $nameParts;
$number_pr = $_POST['Number_pr'];
$status_pr = 0;
$date_pr = date('Y-m-d');
$type="pr";
$stmt = $conn->prepare("INSERT INTO `requests`(`LastName`, `FirstName`, `Patronymic`, `PhoneNumber`, `Type`, `Status`, `Date`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $LastName_pr, $FirstName_pr, $Patronymic_pr, $number_pr, $type, $status_pr, $date_pr);
if ($stmt->execute()) {
    echo 1;            
}
$stmt->close();
$conn->close();
