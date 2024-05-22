<?php
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$query = "SELECT * FROM zayavki WHERE Type='pr' ORDER BY CASE WHEN Status = 0 THEN 0 ELSE 1 END, Status";
$result = $conn->query($query);
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
while ($z_pr = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($z_pr['FIO']) . "</td>";
    echo "<td>" . htmlspecialchars($z_pr['Number']) . "</td>";
    echo "<td>" . htmlspecialchars($z_pr['Date']) . "</td>";
    $t = 1;
    $st1 = 1;
    $st2 = -1;
    switch ($z_pr['Status']) {
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
            echo "<td><a onclick=zav_z(" . $z_pr['ID'] . "," . $st1 . "," . $t . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
        echo "<td><a onclick=zav_z(" . $z_pr['ID'] . "," . $st2 . "," . $t . ");><img class='a_b' src=\"Resources/k.png\"></a></td>";
                break;
        default:
            echo "<td>Неизвестный статус</td>";
            echo "<td></td>";
            echo "<td></td>";
            break;
    }

    echo "</tr>";
}
$result->free();
$conn->close();