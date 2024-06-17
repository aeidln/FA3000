<?php
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$stmt = $conn->prepare("DELETE FROM gallery WHERE ID = ?");
if ($stmt === false) {
	die("Ошибка подготовки запроса: " . $conn->error);
}
$stmt->bind_param("i", $_GET['ID']);
if ($stmt->execute()) {
	header('Location: Admin.php');
	exit();
} else {
	echo "Ошибка выполнения запроса: " . $stmt->error;
}
$stmt->close();
$conn->close();
