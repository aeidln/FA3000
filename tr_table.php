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
    $rows = mysqli_query($link, "SELECT * FROM tr_table WHERE ID_tr=" . $_POST['id']);
    while ($tr_t = mysqli_fetch_array($rows)) {
        echo "<tr>";
        switch ($tr_t['WeekDay']) {
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
    // echo "<td colspan=4><button onclick='save_r' class=\"button\">Сохранить</button></td>";
}

