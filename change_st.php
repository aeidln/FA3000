<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");
$makeadmin = "Update users set Status=10 where ID=" . $_GET['ID'];
$makeuser = "Update users set Status=1 where ID=" . $_GET['ID'];
$maketrainer = "Update users set Status=5 where ID=" . $_GET['ID'];
if ($_GET['Status'] == 10){
    if($_GET['St'] == 5) mysqli_query($link, $maketrainer);
    if($_GET['St'] == 1) mysqli_query($link, $makeuser);
}
if ($_GET['Status'] == 1){
    if($_GET['St'] == 5) mysqli_query($link, $maketrainer);
    if($_GET['St'] == 10) mysqli_query($link, $makeadmin);
}
if ($_GET['Status'] == 5){
    if($_GET['St'] == 10) mysqli_query($link, $makeadmin);
    if($_GET['St'] == 1) mysqli_query($link, $makeuser);
}
header('Location: admin.php');
?>