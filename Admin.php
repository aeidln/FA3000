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
                            <th>Фамилия</th>
                            <th>Имя</th>
                            <th>Отчество</th>
                            <th>Email</th>
                            <th>Номер телефона</th>
                            <th>Дата рождения</th>
                            <th>Роль</th>
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
                            <th>Одобрить</th>
                            <th>Отклонить</th>
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
                        require_once ('conn.php');
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                            die("Невозможно подключиться к серверу: " . $conn->connect_error);
                        }
                        $query = "SELECT t.ID, u.LastName, u.FirstName, u.Patronymic FROM trainers t JOIN users u ON t.ID = u.ID";
                        $rows = $conn->query($query);
                        if (!$rows) {
                            die("Ошибка выполнения запроса: " . $conn->error);
                        }
                        echo "<select id=\"tr_names\" onchange=\"myFunction()\">";
                        echo "<option>Выберите тренера</option>";
                        while ($tr = $rows->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($tr['ID']) . "'>" . htmlspecialchars($tr['LastName'] . " " . $tr['FirstName'] . " " . $tr['Patronymic']) . "</option>";
                        }
                        echo "</select>";
                        ?>
                        <button class="button" onclick="openTr();"><img class="a_b" src="Resources/add_tr.png"></button>
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
                            <th>ФИО</th>
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
                <table class="tb_adm">
                    <thead>
                        <tr>
                            <th>Клиент</th>
                            <th>Тариф</th>
                            <th>Длительность</th>
                            <th>Дата начала</th>
                            <th>Дата окончания</th>
                            <th>Вид</th>
                            <th>Тренер</th>
                        </tr>
                    </thead>
                    <tbody id="b_cc">
                        <? require_once ("b_cc.php"); ?>
                    </tbody>
                </table>
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
                        <th>Ссылка</th>
                        <th>Картинка</th>
                    </thead>
                    <tbody>

                        <?php
                        $rows = mysqli_query($link, "SELECT * from edit_cont ");
                        while ($ed_cont = mysqli_fetch_array($rows)) {
                            echo "<tr>";
                            echo "<td class ='abc' data-type='title' data-id='" . $ed_cont['ID'] . "' contenteditable>" . $ed_cont['Title'] . "</td>";
                            echo "<td class ='abc' data-type='text' data-id='" . $ed_cont['ID'] . "' contenteditable>" . $ed_cont['Text'] . "</td>";
                            echo "<td class ='abc' data-type='link' data-id='" . $ed_cont['ID'] . "' contenteditable>" . $ed_cont['Link'] . "</td>";                           
                            echo "<td><img src=\"".$ed_cont['PhotoPath'] ."\"></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <h3>Редактирование фотографий</h3>
                <center>
                    <form id="uploadForm" enctype="multipart/form-data">
                        <input type="file" name="file">
                        <input type="button" value="Загрузить на сервер" onclick="uploadFile()">
                    </form>
                </center>
                <?php
                $rows = mysqli_query($link, "SELECT * from gallery");
                while ($ph = mysqli_fetch_array($rows)) {
                    echo "<img onclick=\"podt(" . $ph['ID'] . ");\" title=\"Желаете удалить?\"class=\"adm_gal\" src=\"Resources\\" . $ph['Name'] . "." . $ph['Type'] . "\">";
                }
                ?>
            </div>

        </div>
    </div>
    <?php require_once ('footer.php'); ?>

</body> 
</html>
<script language='javascript'>

$(function () {
    var oldVal, newVal, type, id;

    $('.abc').focus(function () {
        oldVal = $(this).text();
        id = $(this).data('id');
        type = $(this).data('type');
    }).blur(function () {
        newVal = $(this).text();
        if (newVal != oldVal) {
            $.ajax({
                url: 'edit_tx.php',
                method: 'post',
                async: false,
                dataType: 'html',
                data: { id: id, type: type, newVal: newVal },
                success: function (response) {
                    console.log(response);
                }
            });
        }
    });

    $('.abc').keypress(function (e) {
        if (e.which == 13) return false;
    });
});


    const n = window.sessionStorage.getItem('pan_btn');
    console.log(n);
    document.getElementsByClassName("pan_btn")[n].style.border = "2px solid #da1717";
    document.getElementsByClassName("adm_body")[n].style.display = "block";


    function podt(id) {
        if (confirm('Желаете удалить фотографию?')) {
            window.location.replace("del_gal.php?ID=" + id);
        }
    };
    function uploadFile() {
            var formData = new FormData($('#uploadForm')[0]);
            $.ajax({
                url: 'download_f.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Ошибка: ' + textStatus);
                }
            });
        }

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
        $.ajax({
            url: "b_cc.php",
            cache: false,
            success: function (php) {
                $("#b_cc").html(php);
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
        $.ajax({
            url: "b_z_card.php",
            cache: false,
            success: function (php) {
                $("#b_z_card").html(php);
            }
        });
    }


</script>