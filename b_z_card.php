<?php
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$k = 3;
$st1 = 1;
$query = "SELECT ID_card, u.Email, u.LastName, u.FirstName, u.Patronymic, cc.Date_start, cc.Card_type, cc.Duration, cc.Format, cc.Status, s.Status as s_st FROM users u, club_cards cc, statuses s WHERE u.ID = cc.ID_user and cc.Status = s.ID ORDER BY Status ASC";
$result = $conn->query($query);
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
while ($z_card = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($z_card['Email']) . "</td>";
    echo "<td>" . htmlspecialchars($z_card['LastName'] . " " . $z_card['FirstName'] . " " . $z_card['Patronymic']) . "</td>";
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
    $d = 3;
    echo "<td>" . htmlspecialchars($z_card['s_st']) . "а</td>";
    if ($z_card['Status'] == 0) {
        echo "<td><a onclick=zav_z(" . $z_card['ID_card'] . "," . $st1 . "," . $k . ")><img class='a_b' src=\"Resources/z.png\"></a></td>";
        echo "<td><a onclick=del(" . $z_card['ID_card'] . "," . $d . ");><img class='a_b' src=\"Resources/k.png\"></a></td>";
    } else {
        echo "<td></td>";
        echo "<td></td>";
    }
    echo "</tr>";
}
$result->free();
$conn->close();