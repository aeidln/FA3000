<?php
// Подключение к базе данных
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения к серверу
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
// Выполнение запроса к базе данных
$query = "SELECT r.ID, Email, Mark, Comment, Date, r.Status from reviews r , users u where r.ID_user=u.ID ";
$result = $conn->query($query);
// Проверка выполнения запроса
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
// Обработка результатов запроса
while ($rev = $result->fetch_assoc()) {
    echo "<tr>";
    $d = 1;
    echo "<td>" . htmlspecialchars($rev['Email']) . "</td>";
    echo "<td>" . htmlspecialchars($rev['Mark']) . "</td>";
    echo "<td>" . htmlspecialchars($rev['Comment']) . "</td>";
    echo "<td>" . htmlspecialchars($rev['Date']) . "</td>";
    $t=2;
    $d = 2;
    $st1 = 1;
    switch ($rev['Status']) {
        case 1:
            echo "<td>Одобрен</td>";
        echo "<td></td>";
        echo "<td></td>";
            break;
        case 0:
            echo "<td>Не одобрен</td>";
        echo "<td><a onclick=zav_z(" . $rev['ID'] . "," . $st1 . "," . $t . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
        echo "<td><a onclick=del(" . $rev['ID'] . "," . $d . ");><img class='a_b' src=\"Resources/k.png\"></a></td>";
            break;
    }
    echo "</tr>";
}
// Освобождение ресурсов
$result->free();
// Закрытие соединения
$conn->close();