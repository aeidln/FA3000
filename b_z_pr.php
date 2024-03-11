<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
$rows = mysqli_query($link, "SELECT * FROM zayavki WHERE Type='pr' ORDER BY Status ASC");
while ($z_pr = mysqli_fetch_array($rows)) {
    echo "<tr>";
    echo "<td>" . $z_pr['FIO'] . "</td>";
    echo "<td>" . $z_pr['Number'] . "</td>";
    echo "<td>" . $z_pr['Date'] . "</td>";
    $k = 1;
    if ($z_pr['Status'] == 1) {
        echo "<td>Обработана</td>";
        echo "<td></td>";
    } else if ($z_pr["Status"] == 0) {
        echo "<td>Не обработана</td>";
        echo "<td><a onclick=zav_z(" . $z_pr['ID'] . "," . $k . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
    }
    echo "</tr>";
}
