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
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения к базе данных
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
// Получение информации о пользователе из базы данных
$email = $_SESSION['Email'];
$stmt = $conn->prepare("SELECT ID, LastName, FirstName, Patronymic, PhoneNumber, Birthdate,  Role FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($ID, $LastName, $FirstName, $Patronymic, $Number, $birthdate, $status);
$stmt->fetch();
$stmt->close();
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
            <h1>Личный кабинет тренера</h1>
            <div class="lk_blocks">
                <div class="lk_b1">
                    <?php
                    // Вывод информации о пользователе
                    echo "<h2>Здравствуйте,  $LastName $FirstName $Patronymic !</h2>";
                    echo "<p>Email: $email</p>";
                    echo "<p>Номер телефона: $Number</p>";
                    echo "<p>Дата рождения: $birthdate</p>";
                    echo "<button onclick=openEdit(" . $ID . "); class=\"button\">Изменить данные</button>";
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
                    <h2>Мое расписание</h2>
                    <table class="cab_tb">
                        <thead>
                            <tr>
                                <th>День недели</th>
                                <th>Начало рабочего дня</th>
                                <th>Конец рабочего дня</th>
                                <th>Тариф клиентов</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                            $stmt = $conn->prepare("SELECT tt.Time_start, tt.Time_finish, tt.TypeOfDay, w.WeekDay FROM tr_timetable tt, weekdays w WHERE tt.WeekDay = w.ID and ID_tr = ?");
                            $stmt->bind_param("i", $ID);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($tr_t = $result->fetch_assoc()) {
                                $backgroundColor = ($tr_t['TypeOfDay'] == 1) ? '#afafaf' : '';
                                echo "<tr style='background:{$backgroundColor};'>";
                                echo "<td>{$tr_t['WeekDay']}</td>";
                                echo "<td><input disabled id=\"appt-time\" type=\"time\" value=\"{$tr_t['Time_start']}\" /></td>";
                                echo "<td><input disabled id=\"appt-time\" type=\"time\" value=\"{$tr_t['Time_finish']}\" /></td>";
                                $typeOfDayLabel = ($tr_t['TypeOfDay'] == 2) ? 'VIP' : (($tr_t['TypeOfDay'] == 3) ? 'Standart' : '');
                                echo "<td>{$typeOfDayLabel}</td>";
                                echo "</tr>";
                            }
                            $stmt->close();
                            ?>

                        </tbody>

                    </table>


                </div>
                <div class="lk_b4">
                    <h2>Мои клиенты</h2>
                    <?php
                   $query = "SELECT c.ID_card, c.Card_type, c.Date_start, c.Date_end, c.ID_user, c.ID_tr, c.Duration, c.Format, u.LastName, u.FirstName, u.Patronymic
                   FROM club_cards c 
                   JOIN users u ON c.ID_user = u.ID 
                   WHERE c.ID_tr = ?";         
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $ID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows < 1) {
                        echo "<p>У вас еще нет клиентов</p>";
                    } else {
                        echo "<table class='cab_tb'><thead><tr>";
                        echo "<th>Клиент</th>";
                        echo "<th>Тариф</th>";
                        echo "<th>Длительность</th>";
                        echo "<th>Дата начала</th>";
                        echo "<th>Дата окончания</th>";
                        echo "<th>Вид</th>";
                        echo "</tr></thead><tbody>";
                        while ($cc = $result->fetch_assoc()) {
                            echo "<td>" . htmlspecialchars($cc['LastName'] . " " . $cc['FirstName'] . " " . $cc['Patronymic']) . "</td>";
                            if ($cc['Card_type'] == 1) {
                                echo "<td>STANDART</td>";
                            } else if ($cc['Card_type'] == 2) {
                                echo "<td>VIP</td>";
                            }
                            echo "<td>" . htmlspecialchars($cc['Duration']) . " месяцев</td>";
                            echo "<td>" . htmlspecialchars($cc['Date_start']) . "</td>";
                            echo "<td>" . htmlspecialchars($cc['Date_end']) . "</td>";
                            echo "<td>" . htmlspecialchars($cc['Format']) . "</td></tr>";
                        }
                        echo "</tbody></table>";
                    }
                    $stmt->close();
                    $conn->close();
                    ?>
                </div>

            </div>
        </div>
    </div>
    <?php require_once ('footer.php'); ?>
</body>

</html>