<?php
    $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
	mysqli_select_db($link, "db") or die("А нет такой таблицы!");
	$query1="Delete From users Where ID=".$_POST['id'];
	$query2="Delete From reviews Where ID=".$_POST['id'];
	if ($_POST['f'] == 1){
		mysqli_query($link,$query1);
	}
	else if ($_POST['f'] == 2){
		mysqli_query($link,$query2);  
	}
?>