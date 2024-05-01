<?php
session_start(); // Инициализация сессии                
// Проверка, авторизован ли пользователь
if (!isset($_SESSION['Email'])) {
    header("Location: Index.php"); // Если не авторизован, перенаправляем на страницу входа
    exit();
}
if ($_SESSION['Status'] != 1) {
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
    <?php require_once ('header.php'); ?>
    <div class="container">
        <div class="block">
            <a href="exit.php">
                <button class="button" id="ex"><img src="Resources/exit.png"></button>
            </a>
            <h1>Личный кабинет</h1>
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
                    <h2>Моя клубная карта</h2>
                    <?php
                    $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                    mysqli_select_db($link, "db") or die("А нет такой бд!");
                    $rows = mysqli_query($link, "SELECT ID_card, Card_type, Date_start, Date_end, ID_user, ID_tr, u.FIO, Duration, Format FROM club_cards c, users u where c.ID_tr=u.ID and ID_user=" . $ID);
                    if (mysqli_num_rows($rows) < 1) {
                        echo "<p>У вас еще нет клубной карты</p>";
                        echo "<a href=\"Club_cards.php\">";
                        echo "<button class=\"button\">Выбрать подходящий тариф</button>";
                        echo "</a>";
                    } else {
                        while ($cc = mysqli_fetch_array($rows)) {

                            if ($cc['ID_tr'] == NULL) {
                                echo "Ваш тариф - VIP. Выберите тренера для дальнейших тренировок:";
                                $rows1 = mysqli_query($link, "SELECT t.ID, u.FIO from trainers t, users u where t.ID=u.ID");
                                echo "<select id=\"tr_names\" onchange=\"ch_tr()\">";
                                echo "<option>Выберите тренера</option>";
                                while ($tr = mysqli_fetch_array($rows1)) {
                                    echo "<option value='" . $tr['ID'] . "'>" . $tr['FIO'] . "</option>";
                                }
                                echo "</select><BR>";
                                echo "<a href=\"Club_cards.php\">";
                                echo "<button class=\"button\">Сохранить</button>";
                                echo "</a>";
                            } else {
                                echo "<table class='cab_tb'><thead><tr>";
                                echo "<th>Тариф</th>";
                                echo " <th>Длительность</th>";
                                echo "<th>Дата начала</th>";
                                echo "<th>Дата окончания</th>";
                                echo " <th>Вид</th>";
                                echo " <th>Тренер</th>";
                                echo "</tr></thead><tbody><tr>";
                                if ($cc['Card_type'] == 1)
                                    echo "<td>STANDART";
                                else if ($cc['Card_type'] == 2)
                                    echo "<td>VIP";
                                echo "<td>" . $cc['Duration'] . " месяцев";
                                echo "<td>" . $cc['Date_start'] . "<Br>";
                                echo "<td>" . $cc['Date_end'] . "<Br>";
                                echo "<td>" . $cc['Format'] . "<Br>";
                                echo "<td>" . $cc['FIO'] . "<Br>";
                                echo "</tr></tbody></table>";
                            }
                        }
                    }
                    ?>
                </div>


                <div class="lk_b4">
                    <h2>Мои отзывы</h2>
                    <?php
                    $rows = mysqli_query($link, "SELECT * FROM reviews where ID_user=" . $ID);

                    if (mysqli_num_rows($rows) < 1) {
                        echo "<p>У вас пока нет отзывов</p>";
                    } else {
                        ?>
                        <table class="cab_tb">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Оценка</th>
                                    <th>Комментарий</th>
                                    <th>Дата</th>
                                    <th>Cтатус обработки</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $k = 1;
                                while ($r = mysqli_fetch_array($rows)) {
                                    echo "<tr>";
                                    echo "<td>" . $k . "</td>";
                                    echo "<td>" . $r['Mark'] . "</td>";
                                    echo "<td>" . $r['Comment'] . "</td>";
                                    echo "<td>" . $r['Date'] . "</td>";
                                    $st = $r['Status'];
                                    if ($st == 1)
                                        echo "<td>Одобрен</td>";
                                    if ($st == 0)
                                        echo "<td>Не одобрен</td>";
                                    echo "</tr>";
                                    $k++;
                                }
                    }
                    ?>
                        </tbody>
                    </table>
                    <a href="Reviews.php">
                        <button class="button">Оставить отзыв</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php require_once ('footer.php'); ?>
</body>

</html>