<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");

$FIO = $_POST['FIO'];
$nameParts = explode(" ", $FIO);
list($LastName, $FirstName, $Patronymic) = $nameParts;
$ID = $_POST['ID'];
$Email = $_POST['Email'];
$Number = $_POST['Number'];
$Birthdate = $_POST['Birthdate'];
$Status = $_POST['Status'];

$makez1 = "Update users set LastName = '" . $LastName . "', FirstName = '" . $FirstName . "', Patronymic = '" . $Patronymic . "', Email = '" . $Email . "', PhoneNumber = '" . $Number . "', Birthdate = '" . $Birthdate . "' where ID=" . $_POST['ID'];
mysqli_query($link, $makez1);
session_start();
echo $_SESSION['Status'];
?>