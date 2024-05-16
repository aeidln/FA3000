<?php
// Подключение к базе данных
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения к серверу
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
// Выполнение запроса к базе данных
$query = "SELECT * FROM users";
$result = $conn->query($query);
// Проверка выполнения запроса
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
// Обработка результатов запроса
while ($user = $result->fetch_assoc()) {
    echo "<tr>";
    $d = 1;
    echo "<td>" . htmlspecialchars($user['FIO']) . "</td>";
    echo "<td>" . htmlspecialchars($user['Email']) . "</td>";
    echo "<td>" . htmlspecialchars($user['Number']) . "</td>";
    echo "<td>" . htmlspecialchars($user['Birthdate']) . "</td>";
    switch ($user['Status']) {
        case 1:
            echo "<td>Пользователь</td>";
            break;
        case 5:
            echo "<td>Тренер</td>";
            break;
        case 10:
            echo "<td>Администратор</td>";
            break;
        default:
            echo "<td>Неизвестный статус</td>";
            break;
    }
    echo "<td><a onclick='openEdit(" . htmlspecialchars($user['ID']) . ", " . htmlspecialchars($user['Status']) . ");'><img class='a_b' src=\"Resources/r.png\"></a></td>";
    echo "<td><a onclick='del(" . htmlspecialchars($user['ID']) . ", " . $d . ");'><img class='a_b' src=\"Resources/d.png\"></a></td>";
    echo "</tr>";
}
// Освобождение ресурсов
$result->free();
// Закрытие соединения
$conn->close();