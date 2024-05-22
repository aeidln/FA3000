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
// echo $_POST['desc'];
// echo $_POST['tr_ph'];

$stmt = $conn->prepare("Update users SET status = 5 WHERE id = ?");
$stmt->bind_param("i", $ID_u);
if ($stmt->execute()) {
    echo 1;
} 
$stmt->close();
$stmt = $conn->prepare("INSERT INTO trainers (ID, Disc, Photo) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $ID_u, $Desc, $Photo);
if ($stmt->execute()) {
    echo 1;
} 
else {
    echo "Ошибка:" . $stmt->error;
}
// for($i=1; $i<=7; $i++){
//     $stmt = $conn->prepare("INSERT INTO tr_table (ID_tr, WeekDay)  VALUES (?, ?)");
//     $stmt->bind_param("ii", $ID_u, $i);
//     if ($stmt->execute()) {
//         echo 1;
//     } 
//     $stmt->close();    
// }

//tr table
//trainers
//club cards удалить 


// // Закрытие подготовленного запроса
// $stmt->close();
?>
