<?php
session_start(); // Инициализация сессии  
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
$ID_u = $_POST['u_id'];
$Desc = $_POST['desc'];
$Photo = $_POST['tr_ph'];
 // Установка дефолтных значений, если поля пустые
if (empty($Desc)) {
    $Desc = 'Описание тренера';
}
if (empty($Photo)) {
    $Photo = 'tr_def.png';
}
$stmt = $conn->prepare("Update users SET Role = 5 WHERE ID = ?");
$stmt->bind_param("i", $ID_u);
$stmt->execute();
$stmt->close();

$stmt = $conn->prepare("INSERT INTO trainers (ID, Description, PhotoPath) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $ID_u, $Desc, $Photo);
$stmt->execute();
$stmt->close();

for($i=1; $i<=7; $i++){
    $stmt = $conn->prepare("INSERT INTO tr_timetable (ID_tr, WeekDay)  VALUES (?, ?)");
    $stmt->bind_param("ii", $ID_u, $i);
    $stmt->execute();
    $stmt->close();    
}


// Удаление записей из таблицы club_cards, где id пользователя равно $ID_u
$stmt = $conn->prepare("DELETE FROM club_cards WHERE ID_user = ?");
$stmt->bind_param("i", $ID_u);
$stmt->execute();
$stmt->close();

header('Location: Admin.php');
exit();
?>
