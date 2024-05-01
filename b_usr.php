<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
$rows = mysqli_query($link, "SELECT * FROM users");
while ($user = mysqli_fetch_array($rows)) {
    echo "<tr>";
    $d = 1;
    echo "<td>" . $user['FIO'] . "</td>";
    echo "<td>" . $user['Email'] . "</td>";
    echo "<td>" . $user['Number'] . "</td>";
    echo "<td>" . $user['Birthdate'] . "</td>";
    if ($user['Status'] == 1) {
        echo "<td>Пользователь</td>";
    }
    if ($user['Status'] == 5) {
        echo "<td>Тренер</td>";
    }
    if ($user['Status'] == 10) {
        echo "<td>Администратор</td>";
    }
    echo "<td><a onclick=edit(" . $user['ID'].");><img class='a_b' src=\"Resources/r.png\"></a></td>";
    echo "<td><a onclick=del(" .$user['ID'] . "," . $d . ");><img class='a_b' src=\"Resources/d.png\"></a></td>";
    echo "</tr>";
}
