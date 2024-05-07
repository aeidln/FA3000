<?php

$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");
echo $_POST['type'];
if ($_POST['type'] == 'title'){
    $makez1 = "Update preim_ set title = \"" . $_POST['newVal'] . "\" where ID=" . $_POST['id'];
    mysqli_query($link, $makez1);

}
elseif ($_POST['type'] == 'text'){
    $makez2 = "Update preim_ set text = \"" . $_POST['newVal'] . "\" where ID=" . $_POST['id'];
    mysqli_query($link, $makez2);    
}

?>