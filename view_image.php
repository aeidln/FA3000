<html>
  <head>
    <meta charset="utf-8">
    <title>Просмотр изображений</title>
  </head>
  <body>
    <?php
        $link=mysqli_connect ("localhost","root","");
        mysqli_connect ("localhost","root","") or die ("Невозможно подключиться к серверу");
		mysqli_select_db($link,"gallery") or die("Нет такой таблицы!");
        mysqli_query($link,"SET NAMES 'cp1251'");
        mysqli_query($link,"SET CHARACTER SET 'cp1251'");


        $getMime = explode('.', $_GET['file_name']);
        $name = reset($getMime);
        $row = mysqli_query($link,"SELECT clicks FROM images WHERE name='" . $name . "'");
        $data = mysqli_fetch_array($row);
        $clicks = $data['clicks'];
        ++$clicks;

        $zapros="UPDATE images SET clicks='" . $clicks ."' WHERE name='" . $name ."'";
        mysqli_query($link,$zapros);
        $file = "large/" . $_GET['file_name'];
        echo "<center><img src='$file' height=600></img></center>";
        echo "<center><strong>Количество просмотров: $clicks</strong></center>"
		
    ?>
	<center><a href="index.php">Вернуться на страницу галереи</a></center>
  </body>
</html>