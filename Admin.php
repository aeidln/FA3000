<?php
session_start(); // Инициализация сессии                
// Проверка, авторизован ли пользователь
if (!isset($_SESSION['Email'])) {
    header("Location: Index.php"); // Если не авторизован, перенаправляем на страницу входа
    exit();
}
if ($_SESSION['Status'] != 10) {
    header("Location: Index.php");
} ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title>ФИТНЕС-АРЕНА 3000</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin panel">
    <link rel="stylesheet" href="3000_стили.css" type="text/css">
    <link rel="shortcut icon" href="Resources/icon.ico" type="image/png">
</head>

<body>
    <?php require_once ('header.php'); ?>
    <div class="container">
        <div class="block">

            <a href="exit.php">
                <button class="button" id="ex"><img alt="" src="Resources/exit.png"></button>
            </a>
            <h1>Панель администратора</h1>
            <div class="adm_menu">
                <span onclick="pan_adm(0);" class="pan_btn">Пользователи</span>
                <span onclick="pan_adm(1);" class="pan_btn">Заявки</span>
                <span onclick="pan_adm(2);" class="pan_btn">Тренеры</span>
                <span onclick="pan_adm(3);" class="pan_btn">Отзывы</span>
                <span onclick="pan_adm(4);" class="pan_btn">Клубные карты</span>
                <span onclick="pan_adm(5);" class="pan_btn">Редактирование контента</span>
            </div>
            <div class="adm_body">
                <h3>Пользователи</h3>
                <table class="tb_adm">
                    <thead>
                        <tr>
                            <th>ФИО</th>
                            <th>Email</th>
                            <th>Номер телефона</th>
                            <th>Дата рождения</th>
                            <th>Статус</th>
                            <th>Редактировать</th>
                            <th>Удалить</th>
                        </tr>
                    </thead>
                    <tbody id="b_usr">
                        <? require_once ("b_usr.php"); ?>
                    </tbody>
                </table>
            </div>
            <div class="adm_body">
                <h3>Заявки на пробное занятие</h3>
                <table class="tb_adm">
                    <thead>
                        <tr>
                            <th>ФИО</th>
                            <th>Номер телефона</th>
                            <th>Дата заявки</th>
                            <th>Статус</th>
                            <th colspan="2">Одобрить/Отклонить</th>
                        </tr>
                    </thead>
                    <tbody id="b_z_pr">
                        <? require_once ("b_z_pr.php"); ?>

                    </tbody>
                </table>
                <h3>Заявки на звонок</h3>
                <table class="tb_adm">
                    <thead>
                        <tr>
                            <th>ФИО</th>
                            <th>Номер телефона</th>
                            <th>Дата заявки</th>
                            <th>Статус</th>
                            <th colspan="2">Одобрить/Отклонить</th>
                        </tr>
                    </thead>
                    <tbody id="b_z_vp">
                        <? require_once ("b_z_vp.php"); ?>
                    </tbody>
                </table>
                <h3>Заявки на покупку клубной карты</h3>
                <table class="tb_adm">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>ФИО</th>
                            <th>Дата заявки</th>
                            <th>Тариф</th>
                            <th>Длительность карты</th>
                            <th>Фомат карты</th>
                            <th>Статус заявки</th>
                            <th>Завершить</th>
                        </tr>
                    </thead>
                    <tbody id="b_z_card">
                        <? require_once ("b_z_card.php"); ?>

                    </tbody>
                </table>

            </div>
            <div class="adm_body">
                <h3>Тренеры</h3>
                <div>
                    <div class="tr_r">

                        <?php
                        $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                        mysqli_select_db($link, "db") or die("А нет такой бд!");
                        $rows = mysqli_query($link, "SELECT t.ID, u.FIO from trainers t, users u where t.ID=u.ID");
                        echo "<select id=\"tr_names\" onchange=\"myFunction()\">";
                        echo "<option>Выберите тренера</option>";
                        while ($tr = mysqli_fetch_array($rows)) {
                            echo "<option value='" . $tr['ID'] . "'>" . $tr['FIO'] . "</option>";
                        }
                        echo "</select>"; ?>
                        <button class="button"><img class="a_b" src="Resources/add_tr.png"></button>

                        <table id="b_tr">

                            <? require_once ("tr_table.php"); ?>
                        </table>
                    </div>

                </div>


            </div>
            <div class="adm_body">
                <h3>Отзывы</h3>
                <table class="tb_adm">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Оценка</th>
                            <th>Комментарий</th>
                            <th>Дата</th>
                            <th>Cтатус обработки</th>
                            <th>Одобрить</th>
                            <th>Удалить</th>
                        </tr>
                    </thead>
                    <tbody id="b_rev">
                        <? require_once ("b_rev.php"); ?>

                    </tbody>
                </table>
            </div>
            <div class="adm_body">
                <h3>Клубные карты</h3>

                <?php
                $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                mysqli_select_db($link, "db") or die("А нет такой бд!");
                $rows = mysqli_query($link, "SELECT ID_card, Card_type, Date_start, Date_end, ID_user, ID_tr, u.FIO, Duration, Format FROM club_cards c, users u where c.ID_tr=u.ID");
                echo "<table class='tb_adm'><thead><tr>";
                echo "<th>Тариф</th>";
                echo " <th>Длительность</th>";
                echo "<th>Дата начала</th>";
                echo "<th>Дата окончания</th>";
                echo " <th>Вид</th>";
                echo " <th>Тренер</th>";
                echo "</tr></thead><tbody>";
                while ($cc = mysqli_fetch_array($rows)) {


                    echo "<tr>";
                    if ($cc['Card_type'] == 1)
                        echo "<td>STANDART";
                    else if ($cc['Card_type'] == 2)
                        echo "<td>VIP";
                    echo "<td>" . $cc['Duration'] . " месяцев";
                    echo "<td>" . $cc['Date_start'] . "<Br>";
                    echo "<td>" . $cc['Date_end'] . "<Br>";
                    echo "<td>" . $cc['Format'] . "<Br>";
                    echo "<td>" . $cc['FIO'] . "<Br>";
                    echo "</tr>";


                }
                echo "</tbody></table>";

                ?>
            </div>
            <div class="adm_body">
                <h3>Редактирование текста</h3>
                <table class="tb_adm">
                    <colgroup>
                        <col span="1" style="width: 10%;">
                        <col span="1" style="width: 90%;">
                    </colgroup>
                    <thead>
                        <th>Заголовок</th>
                        <th>Текст</th>
                    </thead>
                    <tbody>

                        <?php
                        $rows = mysqli_query($link, "SELECT * from preim_ ");
                        while ($preim = mysqli_fetch_array($rows)) {
                            echo "<tr>";


                            // // echo "<form method='POST' action='edit_tx.php?ID=" . $preim['ID'] . "'>";
                            echo "<td class ='abc' ondblclick='ch_tx();'>" . $preim['title'] . "</td>";
                            echo "<td class ='abc' >" . $preim['text'] . "</td>";
                            // echo "<td class ='abc' onchange='edit_tx(" . $preim['ID'] . ", text, this.value);>" . $preim['text'] . "</td>";
                            // echo "<td><input name=\"title\" class=\"title\" type=\"text\" value=\"" . $preim['title'] . "\"></input></td>";
                        
                            // echo "<td><textarea name=\"text\" class=\"text\">" . $preim['text'] . "</textarea></td>";
                            // echo "<button type=\"submit\" class=\"button\">Сохранить</button>";
                            // echo "</form>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <!-- <h3>Действующие акции</h3> -->
                <h3>Редактирование фотографий</h3>
                <center>
                    <form method="post" enctype="multipart/form-data" action="download_f.php">
                        <input type="file" name="file"></button>
                        <input type="submit" value="Загрузить на сервер">
                    </form>
                </center>
                <?php
                $rows = mysqli_query($link, "SELECT * from gallery");
                while ($ph = mysqli_fetch_array($rows)) {
                    echo "<img onclick=\"podt(" . $ph['id'] . ");\" title=\"Желаете удалить?\"class=\"adm_gal\" src=\"Resources\\" . $ph['name'] . "." . $ph['type'] . "\">";
                }
                ?>
            </div>
        </div>
    </div>
    <?php require_once ('footer.php'); ?>

</body>

</html>
<script language='javascript'>

var val1="";

   function ch_tx (){
           var val = this.innerHTML;
            var input = document.createElement("input");
            input.value = val;
            input.className = "text";
            input.onblur = function () {
                var val = this.value;
                this.parentNode.innerHTML = val;
                console.log(val);
                edit_tx(1,1,val);
            };            
            this.innerHTML = "";
            this.appendChild(input);
            input.focus();

   }
    
    
    const n = window.sessionStorage.getItem('pan_btn');
    console.log(n);
    document.getElementsByClassName("pan_btn")[n].style.border = "2px solid #da1717";
    document.getElementsByClassName("adm_body")[n].style.display = "block";



    function podt(id) {
        if (confirm('Желаете удалить фотографию?'))
            window.location.replace("del_gal.php?ID=" + id);
    };

    function myFunction() {
        var n = document.getElementById("tr_names");
        var id = n.options[n.selectedIndex].value;
        $.ajax({
            url: 'tr_table.php',         /* Куда отправить запрос */
            method: 'post',
            async: false,          /* Метод запроса (post или get) */
            // dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: { id: id },     /* Данные передаваемые в массиве */
            success: function (php) {   /* функция которая будет выполнена после успешного запроса.  */
                $("#b_tr").html(php); /* В переменной data содержится ответ от index.php. */
            }
        });

    }
    function zav_z(id, st, type_z) {
        $.ajax({
            url: 'ch_st.php',         /* Куда отправить запрос */
            method: 'post',
            async: false,          /* Метод запроса (post или get) */
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: { id: id, st: st, type_z: type_z },     /* Данные передаваемые в массиве */
            success: function (data) {   /* функция которая будет выполнена после успешного запроса.  */
                console.log(data);
            }
        });
        $.ajax({
            url: "b_z_pr.php",
            cache: false,
            success: function (php) {
                $("#b_z_pr").html(php);
            }
        });
        $.ajax({
            url: "b_z_vp.php",
            cache: false,
            success: function (php) {
                $("#b_z_vp").html(php);
            }
        });
        $.ajax({
            url: "b_z_card.php",
            cache: false,
            success: function (php) {
                $("#b_z_card").html(php);
            }
        });
        $.ajax({
            url: "b_rev.php",
            cache: false,
            success: function (php) {
                $("#b_rev").html(php);
            }
        });
    }
    function ch_r(id, wd, f, val) {
        console.log(id, wd, f, val);
        $.ajax({
            url: 'ch_r.php',         /* Куда отправить запрос */
            method: 'post',
            async: false,             /* Метод запроса (post или get) */
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: { id: id, wd: wd, f: f, val: val },     /* Данные передаваемые в массиве */
            success: function (data) {  /* функция которая будет выполнена после успешного запроса.  */
                console.log(data);
                myFunction();/* В переменной data содержится ответ от index.php. */
            }
        });

    }
    function edit_tx(id, type, val) {
        console.log(id, type, val);
        // $.ajax({
        //     url: 'edit_tx.php',         /* Куда отправить запрос */
        //     method: 'post',
        //     async: false,             /* Метод запроса (post или get) */
        //     dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
        //     data: { id: id, type: type, val: val },     /* Данные передаваемые в массиве */
        //     success: function (data) {  /* функция которая будет выполнена после успешного запроса.  */
        //         console.log(data);
        //         /* В переменной data содержится ответ от index.php. */
        //     }
        // });

    }
    function del(id, f) {
        $.ajax({
            url: 'delete.php',         /* Куда отправить запрос */
            method: 'post',
            async: false,             /* Метод запроса (post или get) */
            dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
            data: { id: id, f: f },     /* Данные передаваемые в массиве */
            success: function (data) {   /* функция которая будет выполнена после успешного запроса.  */
                console.log(data); /* В переменной data содержится ответ от index.php. */
            }
        });
        $.ajax({
            url: "b_usr.php",
            cache: false,
            success: function (php) {
                $("#b_usr").html(php);
            }
        });
        $.ajax({
            url: "b_rev.php",
            cache: false,
            success: function (php) {
                $("#b_rev").html(php);
            }
        });
    }
    function edit(id) {
        openReg();
    }

</script>