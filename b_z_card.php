<?php
// Подключение к базе данных
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения к серверу
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$k = 3;
$st1 = 1;
// Выполнение запроса к базе данных
$query = "SELECT ID_card, u.Email, u.FIO, cc.Date_start, cc.Card_type, cc.Duration, cc.Format, cc.Status FROM users u, club_cards cc WHERE u.ID = cc.ID_user ORDER BY Status ASC";
$result = $conn->query($query);
// Проверка выполнения запроса
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
// Обработка результатов запроса
while ($z_card = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($z_card['Email']) . "</td>";
    echo "<td>" . htmlspecialchars($z_card['FIO']) . "</td>";
    echo "<td>" . htmlspecialchars($z_card['Date_start']) . "</td>";
    switch ($z_card['Card_type']) {
        case 1:
            echo "<td>Standart</td>";
            break;
        case 2:
            echo "<td>VIP</td>";
            break;
    }
    echo "<td>" . htmlspecialchars($z_card['Duration']) . " месяцев</td>";
    echo "<td>" . htmlspecialchars($z_card['Format']) . "</td>";
    switch ($z_card['Status']) {
        case 1:
            echo "<td>Завершена</td>";
            echo "<td></td>";
            break;
        case 0:
            echo "<td>Не обработана</td>";
            echo "<td><a onclick=zav_z(" . $z_card['ID_card'] . "," . $st1 . "," . $k . ")><img class='a_b' src=\"Resources/z.png\"></a></td>";
            break;
    }
    echo "</tr>";
}
// Освобождение ресурсов
$result->free();
// Закрытие соединения
$conn->close();