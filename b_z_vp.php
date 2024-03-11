<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
$rows = mysqli_query($link, "SELECT * FROM zayavki WHERE Type='vp' ORDER BY Status ASC ");
while ($z_vp = mysqli_fetch_array($rows)) {
    echo "<tr>";
    echo "<td>" . $z_vp['FIO'] . "</td>";
    echo "<td>" . $z_vp['Number'] . "</td>";
    echo "<td>" . $z_vp['Date'] . "</td>";
    $k = 2;
    if ($z_vp['Status'] == 1) {
        echo "<td>Обработана</td>";
        echo "<td></td>";
    } else if ($z_vp["Status"] == 0) {
        echo "<td>Не обработана</td>";
        echo "<td><a onclick=zav_z(" . $z_vp['ID'] . "," . $k . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
    }
    echo "</tr>";
} ?>