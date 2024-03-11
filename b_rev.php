<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
$rows = mysqli_query($link, "SELECT r.ID, Email, Mark, Comment, Date, r.Status from reviews r , users u where r.ID_user=u.ID ");
while ($rev = mysqli_fetch_array($rows)) {
    echo "<tr>";
    echo "<td>" . $rev['Email'] . "</td>";
    echo "<td>" . $rev['Mark'] . "</td>";
    echo "<td>" . $rev['Comment'] . "</td>";
    echo "<td>" . $rev['Date'] . "</td>";
    $k=3;
    $d = 2;
    if ($rev['Status'] == 1) {
        echo "<td>Одобрен</td>";
        echo "<td></td>";
        echo "<td></td>";
    } else if ($rev["Status"] == 0) {
        echo "<td>Не одобрен</td>";
        echo "<td><a onclick=zav_z(" . $rev['ID'] . "," . $k . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
        echo "<td><a onclick=del(" . $rev['ID'] . "," . $d . ");><img class='a_b' src=\"Resources/k.png\"></a></td>";
    }
    echo "</tr>";
} ?>