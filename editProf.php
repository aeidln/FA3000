<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");

$FIO = $_POST['FIO'];
$Email = $_POST['Email'];
$Number = $_POST['Number'];
$Birthdate = $_POST['Birthdate'];
$Status = $_POST['Status'];
$makez1 = "Update users set FIO = " . $FIO . ", Email = " . $Email . ", Number = " . $Number . ", Birthdate = " . $Birthdate . " where ID=" . $_POST['id'];
mysqli_query($link, $makez1);
if ($status == 1)
    header('Location: Cabinet.php');
elseif ($status == 5)
    header('Location: Cabinet_tr.php');
?>