<!DOCTYPE html>
<html lang="ru">

<head>
	<title>ФИТНЕС-АРЕНА 3000</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="3000_стили.css" type="text/css">
	<link rel="shortcut icon" href="Resources/icon.ico" type="image/png">
</head>

<body>
	<?php require_once('header.php'); ?>
	<div class="container" >
		<div class="block">
			<a href="Index.php">Главная</a>/<a>Тренеры</a><br>
			<h1>Тренеры</h1>
				<div class="container tr" style="flex-wrap:wrap;">
			<?php
			$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
			mysqli_select_db($link, "db") or die("А нет такой бд!");
			$rows = mysqli_query($link, "SELECT u.FIO, t.Disc, t.Photo  from trainers t, users u where u.ID=t.ID");

			while ($tr = mysqli_fetch_array($rows)) {
				$firstName = substr($tr['FIO'], 0, strpos($tr['FIO'], ' ') + 1);
				$IO = substr($tr['FIO'], strlen($firstName));
				$lastName = substr($IO, 0, strpos($IO, ' '));
				echo "<div class=tr_card>";
				echo "	<div class=front>";
				echo "<img src=\"Resources/".$tr['Photo']."\">";
				echo "<h2>".$firstName.$lastName."</h2>";
				echo "	</div>";
				echo "	<div class=back>".$tr['Disc']."</div>";
				echo "</div>";
			}
			?>
				</div>
			</div>
	</div>
	<?php require_once('footer.php'); ?>
</body>

</html>