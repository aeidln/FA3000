<?php
    $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
	mysqli_select_db($link, "db") or die("А нет такой таблицы!");
	$query1="Delete From users Where ID=".$_POST['id'];
	$query2="Delete From reviews Where ID=".$_POST['id'];
	$query3="Delete From club_cards Where ID_card=".$_POST['id'];
	if ($_POST['f'] == 1){
		mysqli_query($link,$query1);
	}
	else if ($_POST['f'] == 2){
		mysqli_query($link,$query2);  
	}
	else if ($_POST['f'] == 3){
		mysqli_query($link,$query3);  
	}
?>