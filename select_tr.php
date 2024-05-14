<?php

$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");
    $makez1 = "Update club_cards set ID_tr = \"" . $_POST['ID_tr'] . "\" where ID_user=" . $_POST['id'];
    mysqli_query($link, $makez1);
    echo $makez1;
?>