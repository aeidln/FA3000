<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
if ($_POST['id']!=NULL)
{
$rows = mysqli_query($link, "SELECT * FROM tr_table WHERE ID_tr=" . $_POST['id']);
while ($tr_t = mysqli_fetch_array($rows)) {
    echo "<tr>";
    switch ($tr_t['Weekday']) {
        case 1:
            echo "<td>ПН</td>";
            break;
        case 2:
            echo "<td>ВТ</td>";
            break;
        case 3:
            echo "<td>СР</td>";
            break;
        case 4:
            echo "<td>ЧТ</td>";
            break;
        case 5:
            echo "<td>ПТ</td>";
            break;
        case 6:
            echo "<td>СБ</td>";
            break;
        case 7:
            echo "<td>ВС</td>";
            break;

    }
    echo "<td><input id=\"appt-time\" type=\"time\" value=\"" . $tr_t['Time_start'] . "\" /></td>";
    echo "<td><input id=\"appt-time\" type=\"time\" value=\"" . $tr_t['Time_finish'] . "\" /></td>";

    echo "</tr>";



    // <tr>
    //     <td>ПН</td>
    //     <td><input id="appt-time" type="time" value="10:00" /></td>
    //     <td><input id="appt-time" type="time" value="22:00" /></td>
    // </tr>

    // 
    // echo "<td>" . $z_vp['FIO'] . "</td>";
    // echo "<td>" . $z_vp['Number'] . "</td>";
    // echo "<td>" . $z_vp['Date'] . "</td>";
    // $k = 2;
    // if ($z_vp['Status'] == 1) {
    //     echo "<td>Обработана</td>";
    //     echo "<td></td>";
    // } else if ($z_vp["Status"] == 0) {
    //     echo "<td>Не обработана</td>";
    //     echo "<td><a onclick=zav_z(" . $z_vp['ID'] . "," . $k . ");><img class='a_b' src=\"Resources/z.png\"></a></td>";
    // }
    // 
}
} ?>