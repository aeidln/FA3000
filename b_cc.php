<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
$rows = mysqli_query($link, "SELECT ID_card, Card_type, Date_start, Date_end, ID_user, ID_tr, u.FIO, Duration, Format FROM club_cards c, users u where c.ID_tr=u.ID");
while ($cc = mysqli_fetch_array($rows)) {
    echo "<tr>";
    if ($cc['Card_type'] == 1)
        echo "<td>STANDART</td>";
    else if ($cc['Card_type'] == 2)
        echo "<td>VIP</td>";
    echo "<td>" . $cc['Duration'] . " месяцев";
    echo "<td>" . $cc['Date_start'] . "</td>";
    echo "<td>" . $cc['Date_end'] . "</td>";
    echo "<td>" . $cc['Format'] . "</td>";
    echo "<td>" . $cc['FIO'] . "</td>";
    echo "</tr>";
}
?>