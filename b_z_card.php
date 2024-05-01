<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
$k = 3;
$st1=1;
$rows = mysqli_query($link, "SELECT ID_card, u.Email, u.FIO, cc.Date_start, cc.Card_type, cc.Duration, cc.Format, cc.Status FROM users u, club_cards cc WHERE u.ID = cc.ID_user ORDER BY Status ASC");
while ($z_card = mysqli_fetch_array($rows)) {
    echo "<tr>";
    echo "<td>" . $z_card['Email'] . "</td>";
    echo "<td>" . $z_card['FIO'] . "</td>";
    echo "<td>" . $z_card['Date_start'] . "</td>";    
    if ($z_card['Card_type'] == 1) {
        echo "<td>Standart</td>";
    } else if ($z_card["Card_type"] == 2) {
        echo "<td>VIP</td>";    }
    echo "<td>" . $z_card['Duration'] . " месяцев</td>";
    echo "<td>" . $z_card['Format'] . "</td>";
    if ($z_card['Status'] == 1) {
        echo "<td>Завершена</td>";
        echo "<td></td>";
    } else if ($z_card["Status"] == 0) {
        echo "<td>Не обработана</td>";  
        echo "<td><a onclick=zav_z(" . $z_card['ID_card'] . "," . $st1 . "," . $k . ")><img class='a_b' src=\"Resources/z.png\"></a></td>";
    }

    echo "</tr>";
} ?>