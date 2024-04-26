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

    // if (empty($login) || empty($password)) {
    //     echo "Логин и пароль являются обязательными полями. Пожалуйста, заполните их.";
    // } else {
        // Проверка соответствия логина и пароля
        $stmt = $conn->prepare("SELECT Email, Status, Hash FROM users WHERE Email = ?");
        $stmt->bind_param("s", $email_v);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($email_v,$status, $hash);
        $stmt->fetch();

        if ($stmt->num_rows > 0 && password_verify($password_v, $hash)) {
            // Авторизация успешна, сохранение информации в сессии и перенаправление на страницу кабинета
            $_SESSION['Email'] = $email_v;            
            $_SESSION['Status'] = $status;
            $_SESSION['PROV']=true;
            if ($status==1) header("Location: Cabinet.php");
            elseif ($status==5) header("Location: Cabinet_tr.php");
            elseif($status==10) header("Location: Admin.php");
            exit();
        } else {
            echo "<script>alert('Неверный логин или пароль. Пожалуйста, попробуйте еще раз.');window.location.href = 'Index.php';</script>";
        }
        // Закрытие подготовленного запроса
        $stmt->close();
    // }

    // Закрытие соединения с базой данных
    $conn->close();
}
?>

