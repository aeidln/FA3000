<?php

$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");
if ($_POST['type'] == 'title'){
    $makez1 = "Update edit_cont set Title = \"" . $_POST['newVal'] . "\" where ID=" . $_POST['id'];
    mysqli_query($link, $makez1);
    
}
elseif ($_POST['type'] == 'text'){
    $makez2 = "Update edit_cont set Text = \"" . $_POST['newVal'] . "\" where ID=" . $_POST['id'];
    mysqli_query($link, $makez2);    
    
}
elseif ($_POST['type'] == 'link'){
    $makez2 = "Update edit_cont set Link = \"" . $_POST['newVal'] . "\" where ID=" . $_POST['id'];
    mysqli_query($link, $makez2);    
   
}

?>