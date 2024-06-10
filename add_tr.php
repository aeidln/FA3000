<?php
session_start(); // Инициализация сессии                
//Проверка, авторизован ли пользователь
if (!isset($_SESSION['Email'])) {
    header("Location: Index.php"); // Если не авторизован, перенаправляем на страницу входа
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$ID_u = $_POST['u_id'];
$Desc = $_POST['desc'];
$Photo = $_POST['tr_ph'];
 // Установка дефолтных значений, если поля пустые
if (empty($Desc)) {
    $Desc = 'Описание тренера'; // Замените на нужное дефолтное значение
}

if (empty($Photo)) {
    $Photo = 'tr_def.png'; // Замените на нужное дефолтное значение
}

$stmt = $conn->prepare("Update users SET status = 5 WHERE id = ?");
$stmt->bind_param("i", $ID_u);
$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("INSERT INTO trainers (ID, Disc, Photo) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $ID_u, $Desc, $Photo);
$stmt->execute();
$stmt->close();

for($i=1; $i<=7; $i++){
    $stmt = $conn->prepare("INSERT INTO tr_table (ID_tr, WeekDay)  VALUES (?, ?)");
    $stmt->bind_param("ii", $ID_u, $i);
    $stmt->execute();
    $stmt->close();    
}


// Удаление записей из таблицы club_cards, где id пользователя равно $ID_u
$stmt = $conn->prepare("DELETE FROM club_cards WHERE ID_user = ?");
$stmt->bind_param("i", $ID_u);
$stmt->execute();
$stmt->close();


?>
