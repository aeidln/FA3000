<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
if ($_POST['id'] != NULL) {
    echo "<thead>
                <tr>
                <th>День недели</th>
                <th>Начало рабочего дня</th>
                <th>Конец рабочего дня</th>
                <th>Выходной день</th>
                <th>VIP-клиенты</th>
                <th>Standart-клиенты</th>
                </tr>
                </thead>
                <tbody>";
    $rows = mysqli_query($link, "SELECT * FROM tr_timetable WHERE ID_tr=" . $_POST['id']);
    while ($tr_t = mysqli_fetch_array($rows)) {
        echo "<tr>";
        echo "<td>".$tr_t['WeekDay']."</td>";
        if ($tr_t['TypeOfDay'] == 1) {
            echo "<td><input disabled onchange='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 1, this.value);' id=\"appt-time\" type=\"time\" value=\"" . $tr_t['Time_start'] . "\" /></td>";
            echo "<td><input disabled onchange='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 2, this.value);' id=\"appt-time\" type=\"time\" value=\"" . $tr_t['Time_finish'] . "\" /></td>";
            echo "<td><input type='radio' checked onclick='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 3, Number(this.checked));'></td>";
            echo "<td><input type='radio' onclick='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 4, Number(this.checked));'></td>";
            echo "<td><input type='radio' onclick='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 5, Number(this.checked));'></td>";
        } else {
            echo "<td><input onchange='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 1, this.value);' id=\"appt-time\" type=\"time\" value=\"" . $tr_t['Time_start'] . "\" /></td>";
            echo "<td><input onchange='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 2, this.value);' id=\"appt-time\" type=\"time\" value=\"" . $tr_t['Time_finish'] . "\" /></td>";
            echo "<td><input type='radio' onclick='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 3, Number(this.checked));'></td>";
            if ($tr_t['TypeOfDay'] == 2) {
                echo "<td><input checked type='radio' onclick='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 4, Number(this.checked));'></td>";
                echo "<td><input type='radio' onclick='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 5, Number(this.checked));'></td>";
            } 
            if ($tr_t['TypeOfDay'] == 3) {
                echo "<td><input  type='radio' onclick='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 4, Number(this.checked));'></td>";
                echo "<td><input checked type='radio' onclick='ch_r(" . $_POST['id'] . "," . $tr_t['WeekDay'] . ", 5, Number(this.checked));'></td>";
            }
        }
        echo "</tr></tbody>";
    }
}

