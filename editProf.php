<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");

$FIO = $_POST['FIO'];
$ID = $_POST['ID'];
$Email = $_POST['Email'];
$Number = $_POST['Number'];
$Birthdate = $_POST['Birthdate'];
$Status = $_POST['Status'];
$makez1 = "Update users set FIO = '" . $FIO . "', Email = '" . $Email . "', Number = '" . $Number . "', Birthdate = '" . $Birthdate . "' where ID=" . $_POST['ID'];
mysqli_query($link, $makez1);

session_start();
echo $_SESSION['Status'];
?>