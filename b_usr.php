<?php
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$query = "SELECT * FROM users";
$result = $conn->query($query);
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
$firstRow = $result->fetch_assoc();
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
    echo "<td><a onclick='del(" . htmlspecialchars($user['ID']) . ", " . $d . ");'><img class='a_b' src=\"Resources/d.png\"></a></td>";
    echo "</tr>";
}
$result->free();
$conn->close();