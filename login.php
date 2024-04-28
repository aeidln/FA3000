<?php
session_start(); // Инициализация сессии

// Проверка, если пользователь уже авторизован, перенаправляем на страницу кабинета
if (isset($_SESSION['Email'])) {
    header("Location: cabinet.php");
    exit();
}

// Обработка формы при отправке
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Подключение к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения к базе данных
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    // Получение данных из формы
    $email_v = trim($_POST['Email_v']);
    $password_v = trim($_POST['Password_v']);

    // Проверка соответствия логина и пароля
    $stmt = $conn->prepare("SELECT Email, Status, Hash FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email_v);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($email_v, $status, $hash);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password_v, $hash)) {
    // Авторизация успешна, сохранение информации в сессии и перенаправление на страницу кабинета
    $_SESSION['Email'] = $email_v;
    $_SESSION['Status'] = $status;
    $_SESSION['PROV'] = true;
    echo $status;
   exit();
    } else {
        echo -1;
    }
    // Закрытие подготовленного запроса
    $stmt->close();
    // Закрытие соединения с базой данных
    $conn->close();
}
?>