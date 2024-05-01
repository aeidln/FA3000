<?php
session_start();
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
$email = $_SESSION['Email'];
$stmt = $conn->prepare("SELECT ID FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($ID_u);
$stmt->fetch();
$stmt->close();
$status = 0;
$type_c = $_POST['type_c'];
$duration = $_POST['duration'];
$format = $_POST['format'];
$date_c = date('Y-m-d');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$stmt = $conn->prepare("INSERT INTO club_cards (Card_type, Duration, Format, ID_user, Status, Date_start) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $type_c, $duration, $format, $ID_u, $status, $date_c);
if ($stmt->execute()) {
    echo "<script>console.log('Спасибо, ваша заявка отправлена!');</script>";  
    header("Location: Cabinet.php");  
} else {
    echo "Ошибка: " . $stmt->error;
}
$stmt->close();