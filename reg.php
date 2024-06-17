<?php
session_start(); // Инициализация сессии
$_SESSION['PROV'] = false;
// Обработка формы при отправке
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once ('conn.php');
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Проверка подключения к базе данных
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }
    $FIO = trim($_POST['FIO']);
    // Разбиваем строку на три части
    $nameParts = explode(" ", $FIO);
    list($LastName, $FirstName, $Patronymic) = $nameParts;
    $email = $_POST['Email'];
    $number = $_POST['Number'];
    $birthdate = $_POST['Birthdate'];
    $password = trim($_POST['Password']);
    $status = 1; // Установка статуса для простого пользователя
    if ($birthdate == "")
        $birthdate = NULL;
    if ($number == "")
        $number = NULL;
    //Проверка на занятость email при регистрации
    $stmt = $conn->prepare("SELECT Email FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        echo -1;
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (LastName, FirstName, Patronymic, Email, PhoneNumber, Birthdate, Role, Hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssis", $LastName, $FirstName, $Patronymic, $email, $number, $birthdate, $status, $hash);
        if ($stmt->execute()) {
            $_SESSION['Email'] = $email;
            $_SESSION['PROV'] = true;
            $_SESSION['Status'] = $status;
            echo 1;
        } else {
            echo "Ошибка при регистрации: " . $stmt->error;
        }
        $stmt->close();
    }
    //}
    $conn->close();
}