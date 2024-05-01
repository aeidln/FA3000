<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
$rows = mysqli_query($link, "SELECT * FROM zayavki WHERE Type='pr' ORDER BY CASE WHEN Status = 0 THEN 0 ELSE 1 END, Status");
while ($z_pr = mysqli_fetch_array($rows)) {
    echo "<tr>";
    echo "<td>" . $z_pr['FIO'] . "</td>";
    echo "<td>" . $z_pr['Number'] . "</td>";
    echo "<td>" . $z_pr['Date'] . "</td>";
    $t = 1;
    $st1 = 1;
    $st2 = -1;
    if ($z_pr['Status'] == 1) {
        echo "<td>Одобрена</td>";
        echo "<td></td>";
        echo "<td></td>";
    } else if ($z_pr["Status"] == -1) {
        echo "<td>Отклонена</td>";
        echo "<td></td>";
        echo "<td></td>";
    } else if ($z_pr["Status"] == 0) {
        echo "<td>Не обработана</td>";
        echo "<td><a onclick=zav_z(" . $z_pr['ID'] . "," . $st1 . "," . $t . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
        echo "<td><a onclick=zav_z(" . $z_pr['ID'] . "," . $st2 . "," . $t . ");><img class='a_b' src=\"Resources/k.png\"></a></td>";
    }
    echo "</tr>";
}
