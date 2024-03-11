   <?php
    $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
	mysqli_select_db($link, "db") or die("А нет такой таблицы!");
	$query="Delete From gallery Where ID=".$_GET['ID'];
	mysqli_query($link,$query);  
	header('Location: Index.php#gallery');
?>