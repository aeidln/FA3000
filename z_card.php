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
$stmt = $conn->prepare("SELECT FIO, Number FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($FIO_c, $number_c);
$stmt->fetch();
$stmt->close();
$status_c = 0;
$date_c = date('Y-m-d');
$type="card";
$type_c=$_GET['type_c'];
$stmt = $conn->prepare("INSERT INTO zayavki (FIO, Number, Type, Status, Date, Type_c) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssisi", $FIO_c, $number_c, $type, $status_c, $date_c, $type_c);
if ($stmt->execute()) {
    echo "<script>console.log('Спасибо, ваша заявка отправлена!');</script>";
    // echo "<script>document.getElementsByClassName(\"modal\")[0].style.display = \"block\";document.getElementsByClassName(\"modal\")[0].innerHTML=\"МОЛОДЕЦ АДЕЛИНА\"</script>";
} else {
    echo "Ошибка: " . $stmt->error;
}
// Закрытие подготовленного запроса
$stmt->close();