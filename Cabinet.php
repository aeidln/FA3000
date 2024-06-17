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
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения к базе данных
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
// Получение информации о пользователе из базы данных
$email = $_SESSION['Email'];
$stmt = $conn->prepare("SELECT ID, LastName, FirstName, Patronymic, PhoneNumber, Birthdate, Role FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($ID, $LastName, $FirstName, $Patronymic, $Number, $birthdate, $status);
$stmt->fetch();
$stmt->close();
$_SESSION['ID'] = $ID;
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
                    <h2>Моя клубная карта</h2>
                    <?php
                    // Запрос для получения информации о клубных картах пользователя
                    $query = "
        SELECT 
            ID_card, 
            Card_type, 
            Date_start, 
            Date_end, 
            ID_user, 
            CASE WHEN u.ID IS NULL THEN NULL ELSE ID_tr END AS ID_tr, 
            CASE WHEN u.ID IS NULL THEN NULL ELSE CONCAT(u.LastName, ' ', u.FirstName, ' ', u.Patronymic) END AS FIO, 
            Duration, 
            Format, 
            c.Status 
        FROM 
            club_cards c 
        LEFT JOIN 
            users u 
        ON 
            c.ID_tr = u.ID 
        WHERE 
            ID_user = ?
    ";
                    // Подготовка запроса с использованием подготовленных выражений
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $ID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows < 1) {
                        echo "<p>У вас еще нет клубной карты</p>";
                        echo "<a href=\"Club_cards.php\">";
                        echo "<button class=\"button\">Выбрать подходящий тариф</button>";
                        echo "</a>";
                    } else {
                        while ($cc = $result->fetch_assoc()) {
                            if ($cc['Status'] == 0) {
                                echo "Ожидайте. Ваша заявка на карту обрабатывается.";
                            } else {
                                if (is_null($cc['ID_tr'])) {
                                    echo "Ваш тариф - VIP. Выберите тренера для дальнейших тренировок:";
                                    $queryTrainers = "
                        SELECT t.ID, u.LastName, u.FirstName, u.Patronymic
                        FROM trainers t
                        INNER JOIN users u ON t.ID = u.ID
                        WHERE t.ID IN (
                            SELECT ID_tr
                            FROM club_cards
                            GROUP BY ID_tr
                            HAVING COUNT(*) <= 5
                            AND SUM(CASE WHEN Card_type = 2 THEN 1 ELSE 0 END) <= 2
                        );
                    ";
                                    $result1 = $conn->query($queryTrainers);
                                    echo "<select id=\"tr_names\">";
                                    echo "<option>Выберите тренера</option>";
                                    while ($tr = $result1->fetch_assoc()) {
                                        echo "<option value='" . $tr['ID'] . "'>" . htmlspecialchars($tr['LastName'] . " " . $tr['FirstName'] . " " . $tr['Patronymic']) . "</option>";
                                    }
                                    echo "</select><br>";
                                    echo "<button onclick='select_tr(" . $ID . ");' class=\"button\">Сохранить</button>";
                                } else {
                                    echo "<table class='cab_tb'><thead><tr>";
                                    echo "<th>Тариф</th>";
                                    echo "<th>Длительность</th>";
                                    echo "<th>Дата начала</th>";
                                    echo "<th>Дата окончания</th>";
                                    echo "<th>Вид</th>";
                                    echo "<th>Тренер</th>";
                                    echo "</tr></thead><tbody><tr>";
                                    if ($cc['Card_type'] == 1)
                                        echo "<td>STANDART</td>";
                                    else if ($cc['Card_type'] == 2)
                                        echo "<td>VIP</td>";
                                    echo "<td>" . $cc['Duration'] . " месяцев</td>";
                                    echo "<td>" . $cc['Date_start'] . "</td>";
                                    echo "<td>" . $cc['Date_end'] . "</td>";
                                    echo "<td>" . $cc['Format'] . "</td>";
                                    echo "<td>" . $cc['FIO'] . "</td>";
                                    echo "</tr></tbody></table>";
                                }
                            }
                        }
                    }
                    $stmt->close();
                    ?>
                </div>
                <div class="lk_b4">
                    <h2>Мои отзывы</h2>
                    <?php
                    // Запрос для получения отзывов пользователя
                    $queryReviews = "
        SELECT r.*, s.Status AS StatusName 
        FROM reviews r
        JOIN statuses s ON r.Status = s.ID
        WHERE r.ID_user = ?
    ";
                    // Подготовка запроса с использованием подготовленных выражений
                    $stmt = $conn->prepare($queryReviews);
                    $stmt->bind_param("i", $ID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows < 1) {
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
                                while ($r = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $k . "</td>";
                                    echo "<td>" . htmlspecialchars($r['Mark']) . "</td>";
                                    echo "<td>" . htmlspecialchars($r['Comment']) . "</td>";
                                    echo "<td>" . htmlspecialchars($r['Date']) . "</td>";
                                    echo "<td>" . htmlspecialchars($r['StatusName']) . "</td>";                                    
                                    echo "</tr>";
                                    $k++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <a href="Reviews.php">
                            <button class="button">Оставить отзыв</button>
                        </a>
                        <?php
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
<script>
    function select_tr(id) {
        ID_tr = document.getElementById("tr_names").value;
        $.ajax({
            url: 'select_tr.php',         /* Куда отправить запрос */
            method: 'post',          /* Метод запроса (post или get) */
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: { id: id, ID_tr: ID_tr },     /* Данные передаваемые в массиве */
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });
    }
</script>