<?php
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$query = "SELECT r.ID, u.LastName, u.FirstName, u.Patronymic, Email, Mark, Comment, Date, s.Status, r.Status as st_ID from reviews r , users u, statuses s where r.ID_user=u.ID and r.Status = s.ID";
$result = $conn->query($query);
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
while ($rev = $result->fetch_assoc()) {
    echo "<tr>";
    $d = 1;

    echo "<td>" . htmlspecialchars($rev['LastName'] . " " . $rev['FirstName'] . " " . $rev['Patronymic']) . "</td>";
    echo "<td>" . htmlspecialchars($rev['Email']) . "</td>";
    echo "<td>" . htmlspecialchars($rev['Mark']) . "</td>";
    echo "<td>" . htmlspecialchars($rev['Comment']) . "</td>";
    echo "<td>" . htmlspecialchars($rev['Date']) . "</td>";
    $t = 2;
    $d = 2;
    $st1 = 1;
    echo "<td>" . htmlspecialchars($rev['Status']) . "</td>";
    if ($rev['st_ID'] == 0) {
        echo "<td><a onclick=zav_z(" . $rev['ID'] . "," . $st1 . "," . $t . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
        echo "<td><a onclick=del(" . $rev['ID'] . "," . $d . ");><img class='a_b' src=\"Resources/k.png\"></a></td>";
    } else {
        echo "<td></td>";
        echo "<td></td>";
    }
    echo "</tr>";
}
$result->free();
$conn->close();