<!DOCTYPE html>
<html lang="ru">

<head>
	<title>ФИТНЕС-АРЕНА 3000</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="3000_стили.css" type="text/css">
	<link rel="shortcut icon" href="Resources/icon.ico" type="image/png">
</head>

<body>
	<?php require_once ('header.php'); ?>
	<div class="container">
		<div class="block">
			<a href="Index.php">Главная</a>/<a>Клубные карты</a><br>
			<h1>Клубные карты</h1>
			<div class="cc_block">

				<div class="">
					<h2>STANDART</h2>
					<div class="cc_inf"><img src="Resources/1.jpg">Групповые занятия по расписанию</div>
					<div class="cc_inf"><img src="Resources/1.jpg">Самостоятельные тренировки в тренажерном зале</div>
					<div class="cc_inf"><img src="Resources/1.jpg">1 фитнес-тестирование</div>
					<div class="cc_inf"><img src="Resources/1.jpg">3 персональных тренировок</div>
					<? session_start();
					if (isset($_SESSION['Email']) && $_SESSION['Status'] == 1)
							echo "<button onclick=\"openCc_form(1);\" class=\"button\">Оставить заявку</button>";
						//проверка на наличие заявки
					
					
					?>
				</div>
				<div class="app" id="cc1">
					<div class="card-front">
						<label class="number" for="cardNumber">
							0000 0000 0000 0000
						</label>
						<label class="name" for="cardHolder">
							Иван Иванов
						</label>
					</div>
				</div>
			</div>
			<div class="cc_block">
				<div class=app id="cc2">
					<div class="card-front">
						<label class="number" for="cardNumber">
							0000 0000 0000 0000
						</label>
						<label class="name" for="cardHolder">
							Иван Иванов
						</label>
					</div>
				</div>
				<div>
					<h2>VIP</h2>
					<div><img src="Resources/group.png">Групповые занятия по расписанию</div>
					<div><img src="Resources/1.jpg">Самостоятельные тренировки в тренажерном зале</div>
					<div><img src="Resources/1.jpg">2 фитнес-тестирования</div>
					<div><img src="Resources/1.jpg">10 персональных тренировок</div>
					<div><img src="Resources/1.jpg">Полотенце</div>
					<div><img src="Resources/1.jpg">Индивидуальный шкафчик</div>
					<div><img src="Resources/1.jpg">5 сеансов массажа</div>
					<div><img src="Resources/1.jpg">Выбор персонального тренера в ЛК</div>
					<div><img src="Resources/1.jpg">5 гостевых визитов</div>
					<?
						if (isset($_SESSION['Email']) && $_SESSION['Status'] == 1)
						echo "<button onclick=\"openCc_form(2);\" class=\"button\">Оставить заявку</button>";
					
				?>
				</div>				
			</div>
			<span>
				<? if (!isset($_SESSION['Email'])) {
					echo "Еще не зарегистрированы?<br>";
					if ($_SESSION['PROV'] == false)
						echo "<button class=\"button\" onclick='openReg();'>Войти/Зарегистрироваться</button>";
				}
				?>
			</span>		
		</div>
	</div>
	<?php require_once ('footer.php'); ?>
</body>
</html>