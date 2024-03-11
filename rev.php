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
$Mark = $_POST['rating'];
$Comment = $_POST['comment'];
$Status_rev = 0;
$Date_rev = date('Y-m-d');
$email = $_SESSION['Email'];
$stmt = $conn->prepare("SELECT ID FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($ID_u);
$stmt->fetch();
$stmt->close();
$stmt = $conn->prepare("INSERT INTO reviews (ID_user, Mark, Comment, Date, Status) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iissi", $ID_u, $Mark, $Comment, $Date_rev, $Status_rev);
if ($stmt->execute()) {
    echo "<script>alert('Спасибо, ваш отзыв отправлен! Ожидайте подтверждения'); window.location.href = 'Reviews.php';</script>";
} else {
    echo "Ошибка:" . $stmt->error;
}
// Закрытие подготовленного запроса
$stmt->close();
?>
