<?php
session_start(); // Инициализация сессии                
// Проверка, авторизован ли пользователь
if (!isset($_SESSION['Email'])) {
    header("Location: Index.php"); // Если не авторизован, перенаправляем на страницу входа
    exit();
}
if ($_SESSION['Status']!=5){
    header("Location: Index.php"); 
}
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
// Получение информации о пользователе из базы данных
$email = $_SESSION['Email'];
$stmt = $conn->prepare("SELECT ID, FIO, Number, Birthdate,  Status FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($ID, $FIO, $Number, $birthdate, $status);
$stmt->fetch();
// Сохранение статуса пользователя в сессии
$_SESSION['status'] = $status;
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>ФИТНЕС-АРЕНА 3000</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="3000_стили.css" type="text/css">
    <link rel="shortcut icon" href="Resources/icon.ico" type="image/png">
</head>

<body>
    <?php require_once('header.php'); ?>
    <div class="container">
        <div class="block">
            <a href="exit.php">
                <button class="button" id="ex"><img src="Resources/exit.png"></button>
            </a>
            <h1>Личный кабинет тренера</h1>
            <div class="lk_blocks">
                <div class="lk_b1">
                    <?php
                    // Вывод информации о пользователе
                    echo "<h2>Здравствуйте,  $FIO !</h2>";
                    echo "<p>Email: $email</p>";
                    echo "<p>Номер телефона: $Number</p>";
                    echo "<p>Дата рождения: $birthdate</p>";
                    
                    if ($status == 1) {

                    } elseif ($status == 10) {
                        echo "<p>Роль: Администратор</p>";
                        echo '<p><a href="Admin.php">Панель администратора</a></p>';
                    }
                    ?>
                    <a href="Edit_lk.php">
                        <button class="button">Редактировать данные</button>
                    </a>

                </div>
                <div class="lk_b2">
                    <h2>Расписание занятий</h2>
                    <img src="Resources/shedule.png">
                    <a href="Class_schedule.php">
                    <button class="button">Расписание занятий</button>
                </a>

                </div>
                <div class="lk_b3">
                    <h2>Мои клиенты</h2>
                    <?php
                        $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                        mysqli_select_db($link, "db") or die("А нет такой бд!");
                        $rows = mysqli_query($link, "SELECT * FROM club_cards where ID_user=" . $ID);
                        $сс = mysqli_fetch_array($rows);
                        if (empty($сс)) {
                        echo "<p>У вас еще нет клиентов</p>";
                        }
                    ?>
                </div>
                <div class="lk_b4">
                    <h2>Мое расписание</h2>
                    
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
</body>

</html>