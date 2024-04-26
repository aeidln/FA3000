<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");
$z = "Update tr_table set";
if ($_POST['f'] == 1){
   $z=$z." Time_start='".$_POST['val'];
}
if ($_POST['f'] == 2){
    $z=$z." Finish='".$_POST['val'];
}
if ($_POST['f'] == 3){
    $z=$z." DayOff='".$_POST['val'];
}
$z=$z."' where ID_tr='" . $_POST['id']."' and WeekDay='".$_POST['wd']."'";
echo $z;
mysqli_query($link, $z);

?>