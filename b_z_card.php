<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
$k = 4;
$rows = mysqli_query($link, "SELECT * FROM zayavki WHERE Type='card' ORDER BY Status ASC ");
while ($z_card = mysqli_fetch_array($rows)) {
    echo "<tr>";
    echo "<td>" . $z_card['FIO'] . "</td>";
    echo "<td>" . $z_card['Number'] . "</td>";
    echo "<td>" . $z_card['Date'] . "</td>";
    if ($z_card['Type_c'] == 1) {
        echo "<td>Standart</td>";
    } else if ($z_card["Type_c"] == 2) {
        echo "<td>VIP</td>";
    }

    if ($z_card['Status'] == 1) {
        echo "<td>Обработана</td>";
        echo "<td></td>";
    } else if ($z_card["Status"] == 0) {
        echo "<td>Не обработана</td>";
        echo "<td><a onclick=zav_z(" . $z_card['ID'] . "," . $k . "," . $z_card['Type_c'] . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
    }

    echo "</tr>";
} ?>