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
			<a href="Index.php">Главная</a>/<a>Клубные карты</a><br>
			<div>
			<h1>Клубные карты</h1>
			<a href="z_card.php&type_c=1">
                        <button class="button">Оставить заявку</button>
            </a>
			
			</div>
			<div>
			<h2>Standart </h2>
			<a href="z_card.php&type_c=2">
                        <button class="button">Оставить заявку</button>
            </a>
			</div>
			<h2>VIP</h2>
			<? if (!isset($_SESSION['Email'])) {
				echo"Еще не зарегистрированы?<br>";
				if ($_SESSION['PROV'] == false)
				echo "<button class=\"button\" onclick='openReg();'>Войти/Зарегистрироваться</button>";
			}
			?>
		</div>
	</div>
	<?php require_once('footer.php'); ?>
</body>

</html>