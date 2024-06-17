<?php
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$query = "SELECT u.ID, LastName, FirstName, Patronymic, Email, PhoneNumber, Birthdate, r.Role FROM users u, roles r WHERE u.Role = r.ID and r.ID != 10 order by u.Role DESC ";
$result = $conn->query($query);
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
$firstRow = $result->fetch_assoc();
while ($user = $result->fetch_assoc()) {
    echo "<tr>";
    $d = 1;
    echo "<td>" . htmlspecialchars($user['LastName']) . "</td>";
    echo "<td>" . htmlspecialchars($user['FirstName']) . "</td>";
    echo "<td>" . htmlspecialchars($user['Patronymic']) . "</td>";
    echo "<td>" . htmlspecialchars($user['Email']) . "</td>";
    echo "<td>" . htmlspecialchars($user['PhoneNumber']) . "</td>";
    echo "<td>" . htmlspecialchars($user['Birthdate']) . "</td>";
    echo "<td>" . htmlspecialchars($user['Role']) . "</td>";
    echo "<td><a onclick='del(" . htmlspecialchars($user['ID']) . ", " . $d . ");'><img class='a_b' src=\"Resources/d.png\"></a></td>";
    echo "</tr>";
}
$result->free();
$conn->close();