<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");

$title = $_POST['title'];
$text = $_POST['text'];
$makez1 = "Update preim_ set title = \"".$title."\", text = \"".$text."\" where ID=" . $_GET['ID'];
mysqli_query($link, $makez1);
header('Location: Index.php');
?>