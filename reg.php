<?php
session_start(); // Инициализация сессии
$_SESSION['PROV'] = false;
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
    $FIO = trim($_POST['FIO']);
    $email = $_POST['Email'];
    $number = $_POST['Number'];
    $birthdate = $_POST['Birthdate'];
    $password = trim($_POST['Password']);
    $status = 1; // Установка статуса для простого пользователя

    // Проверка занятости логина
    $stmt = $conn->prepare("SELECT Email FROM users WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo -1;
    } else {
        // Логин свободен, выполнение запроса на добавление пользователя
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (FIO, Email, Number, Birthdate, Status, Hash) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssis", $FIO, $email, $number, $birthdate, $status, $hash);
        if ($stmt->execute()) {
            // Регистрация успешно завершена, сохранение информации в сессии и перенаправление на страницу cabinet.php
            $_SESSION['FIO'] = $FIO;
            $_SESSION['Email'] = $email;
            $_SESSION['Number'] = $number;
            $_SESSION['Birthdate'] = $birthdate;
            $_SESSION['PROV'] = true;
            $_SESSION['Status'] = $status;
            echo 1;
        }
        else {
            echo "Ошибка при регистрации: " . $stmt->error;            
        }
        // Закрытие подготовленного запроса
        $stmt->close();
    }
    //}

    // Закрытие соединения с базой данных
    $conn->close();
}
?>