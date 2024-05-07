<?php
session_start(); // Инициализация сессии                
// Проверка, авторизован ли пользователь
if (!isset($_SESSION['Email'])) {
    header("Location: Index.php"); // Если не авторизован, перенаправляем на страницу входа
    exit();
}
if ($_SESSION['Status'] != 5) {
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
                    echo "<button onclick=openEdit(" . $ID."); class=\"button\">Изменить данные</button>";
                    // echo "<button onclick=openEditPas(" . $ID."); class=\"button\">Изменить пароль</button>";
                    ?>
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
                    $rows = mysqli_query($link, "SELECT ID_card, Card_type, Date_start, Date_end, ID_user, ID_tr, u.FIO, Duration, Format FROM club_cards c, users u where c.ID_user=u.ID and ID_tr=" . $ID);
                    
                    if (mysqli_num_rows($rows) < 1) {
                        echo "<p>У вас еще нет клиентов</p>";
                    }
                    else{
                        while ($cc = mysqli_fetch_array($rows)) {
                                echo "<table class='cab_tb'><thead><tr>";
                                echo " <th>Клиент</th>";
                                echo "<th>Тариф</th>";
                                echo " <th>Длительность</th>";
                                echo "<th>Дата начала</th>";
                                echo "<th>Дата окончания</th>";                                
                                echo " <th>Вид</th>";
                               
                                echo "</tr></thead><tbody><tr>";
                                echo "<td>" . $cc['FIO']. "<Br>";
                                if ($cc['Card_type'] == 1)
                                    echo "<td>STANDART";
                                else if ($cc['Card_type'] == 2)
                                    echo "<td>VIP";
                                echo "<td>" . $cc['Duration'] . " месяцев";
                                echo "<td>" . $cc['Date_start'] . "<Br>";
                                echo "<td>" . $cc['Date_end'] . "<Br>";
                                echo "<td>" . $cc['Format'] . "<Br>";
                                
                                echo "</tr></tbody></table>";
                        }
                    
                    }
                    ?>
                    <!-- <a href="Add_cc.php">
                        <button class="button">Добавить клиента</button>
                    </a> -->
                </div>
                <div class="lk_b4">
                    <h2>Мое расписание</h2>
                    <table class="cab_tb">
                        <thead>
                            <tr>
                                <th>День недели</th>
                                <th>Начало рабочего дня</th>
                                <th>Конец рабочего дня</th>
                            </tr>
                        </thead>
                        <tbody>
                        <? $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                    mysqli_select_db($link, "db") or die("А нет такой бд!");
                    $rows = mysqli_query($link, "SELECT * FROM tr_table WHERE ID_tr=" . $ID);
                    while ($tr_t = mysqli_fetch_array($rows)) {
                        echo "<tr>";
                        switch ($tr_t['WeekDay']) {
                            case 1:
                                echo "<td>ПН</td>";
                                break;
                            case 2:
                                echo "<td>ВТ</td>";
                                break;
                            case 3:
                                echo "<td>СР</td>";
                                break;
                            case 4:
                                echo "<td>ЧТ</td>";
                                break;
                            case 5:
                                echo "<td>ПТ</td>";
                                break;
                            case 6:
                                echo "<td>СБ</td>";
                                break;
                            case 7:
                                echo "<td>ВС</td>";
                                break;
                        }
                        echo "<td><input disabled  id=\"appt-time\" type=\"time\" value=\"" . $tr_t['Time_start'] . "\" /></td>";
                        echo "<td><input disabled id=\"appt-time\" type=\"time\" value=\"" . $tr_t['Time_finish'] . "\" /></td>";

                        echo "</tr>";
                    } ?>


                        </tbody>

                    </table>
                    

                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
</body>

</html>