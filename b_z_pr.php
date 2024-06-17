<?php
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$query = "SELECT r.ID AS r_ID, r.LastName, r.FirstName, r.Patronymic, r.PhoneNumber, r.Date, s.ID as s_ID, s.Status FROM requests r, statuses s WHERE Type='pr' and r.Status = s.ID ORDER BY CASE WHEN r.Status = 0 THEN 0 ELSE 1 END, r.Status";
$result = $conn->query($query);
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
while ($z_pr = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($z_pr['LastName'] . " " . $z_pr['FirstName'] . " " . $z_pr['Patronymic']) . "</td>";
    echo "<td>" . htmlspecialchars($z_pr['PhoneNumber']) . "</td>";
    echo "<td>" . htmlspecialchars($z_pr['Date']) . "</td>";
    $t = 1;
    $st1 = 1;
    $st2 = -1;    
    echo "<td>" . htmlspecialchars($z_pr['Status']) . "а</td>";
    if ($z_pr['s_ID'] == 0) {
        echo "<td><a onclick=zav_z(" . $z_pr['r_ID'] . "," . $st1 . "," . $t . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
        echo "<td><a onclick=zav_z(" . $z_pr['r_ID'] . "," . $st2 . "," . $t . ");><img class='a_b' src=\"Resources/k.png\"></a></td>";
    } else {
        echo "<td></td>";
        echo "<td></td>";
    }
    echo "</tr>";
}
$result->free();
$conn->close();