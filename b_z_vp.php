<?php
// Подключение к базе данных
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения к серверу
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
// Выполнение запроса к базе данных
$query = "SELECT * FROM zayavki WHERE Type='vp' ORDER BY CASE WHEN Status = 0 THEN 0 ELSE 1 END, Status";
$result = $conn->query($query);
// Проверка выполнения запроса
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
// Обработка результатов запроса
while ($z_vp = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($z_vp['FIO']) . "</td>";
    echo "<td>" . htmlspecialchars($z_vp['Number']) . "</td>";
    echo "<td>" . htmlspecialchars($z_vp['Date']) . "</td>";
    $t = 1;
    $st1 = 1;
    $st2 = -1;
    switch ($z_vp['Status']) {
        case 1:
            echo "<td>Одобрена</td>";
            echo "<td></td>";
            echo "<td></td>";
            break;
        case -1:
            echo "<td>Отклонена</td>";
            echo "<td></td>";
            echo "<td></td>";
            break;
        case 0:
            echo "<td>Не обработана</td>";
            echo "<td><a onclick='zav_z(" . htmlspecialchars($z_vp['ID']) . ", " . $st1 . ", " . $t . ");'><img class='a_b' src=\"Resources/z.png\"></a></td>";
            echo "<td><a onclick='zav_z(" . htmlspecialchars($z_vp['ID']) . ", " . $st2 . ", " . $t . ");'><img class='a_b' src=\"Resources/k.png\"></a></td>";
            break;
        default:
            echo "<td>Неизвестный статус</td>";
            echo "<td></td>";
            echo "<td></td>";
            break;
    }

    echo "</tr>";
}
// Освобождение ресурсов
$result->free();
// Закрытие соединения
$conn->close();
