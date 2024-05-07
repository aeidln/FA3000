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
	<div class="container">
		<div class="block">
			<a href="Index.php">Главная</a>/<a>Тренеры</a><br>
			<h1>Тренеры</h1>
			<!-- <p>В "Фитнес-арена 3000" каждый тренер – настоящий профессионал своего дела. Их энергия и энтузиазм
				заразительны,
				а профессионализм заметен с первых минут занятий. У каждого тренера своя история успеха – они не только
				помогают клиентам достигать результатов,
				но и сами служат примером того, насколько далеко можно зайти благодаря спорту и здоровому образу жизни.
				Их индивидуальный подход к каждому клиенту делает занятия уникальными и эффективными.
				Они не просто следят за выполнением упражнений, они вкладывают частичку своей души в каждую тренировку,
				мотивируя, поддерживая и направляя своих подопечных к новым вершинам достижений.
				Здесь каждый тренер – не просто инструктор, а настоящий наставник, готовый поддержать и помочь в
				освоении новых вершин фитнеса и здорового образа жизни.</p> -->
				<div class="container">
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