<!DOCTYPE html>
<html lang="ru">

<head>
	<title>ФИТНЕС-АРЕНА 3000</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Клубные карты">
	<link rel="stylesheet" href="3000_стили.css" type="text/css">
	<link rel="shortcut icon" href="Resources/icon.ico" type="image/png">
</head>

<body>
	<?php require_once ('header.php'); ?>
	<div class="container">
		<div class="block">
			<a href="Index.php">Главная</a>/Клубные карты<br>
			<h1>Клубные карты</h1>
			<div class="cc_block">

				<div class="">
					<h2>STANDART</h2>
					<div class="cc_infs">
						<div class="cc_inf"><img alt="" src="Resources/8.webp">Групповые занятия по расписанию</div>
						<div class="cc_inf"><img alt="" src="Resources/6.webp">Посещение тренажерного зала</div>
						<div class="cc_inf"><img alt="" src="Resources/4.webp">1 фитнес-тестирование</div>
						<div class="cc_inf"><img alt="" src="Resources/5.webp">3 персональных тренировок</div>
						<div class="cc_inf"><img alt="" src="Resources/3.webp">1 гостевой визит</div>
					</div>
					<?
					session_start();
					require_once ('conn.php');
					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
						die("Невозможно подключиться к серверу: " . $conn->connect_error);
					}
					$query = "SELECT * FROM club_cards c where ID_user=" . $_SESSION['ID'];
					$result = $conn->query($query);
					$n =$result->num_rows;
					if ( $n<= 0 && isset($_SESSION['Email']) && $_SESSION['Status'] == 1) {
						echo "<button onclick=\"openCc_form(1);\" class=\"button\">Оставить заявку</button>";					
					}				
					$conn->close();						
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
					<div class="cc_infs">
						<div class="cc_inf"><img alt="" src="Resources/8.webp">Групповые занятия по расписанию</div>
						<div class="cc_inf"><img alt="" src="Resources/6.webp">Посещение тренажерного зала</div>
						<div class="cc_inf"><img alt="" src="Resources/4.webp">2 фитнес-тестирования</div>
						<div class="cc_inf"><img alt="" src="Resources/5.webp">10 персональных тренировок</div>
						<div class="cc_inf"><img alt="" src="Resources/7.webp">5 сеансов массажа</div>
						<div class="cc_inf"><img alt="" src="Resources/1.webp">Индивидуальный шкафчик и полотенце</div>
						<div class="cc_inf"><img alt="" src="Resources/3.webp">5 гостевых визитов</div>


					</div>
					<?
					if ( $n<= 0 && isset($_SESSION['Email']) && $_SESSION['Status'] == 1)
						echo "<button onclick=\"openCc_form(2);\" class=\"button\">Оставить заявку</button>";

					?>
				</div>
			</div>
			<div>
				<center>
					<? if (!isset($_SESSION['Email'])) {
						echo "Желаете приобрести клубную карту?<br>";
						if ($_SESSION['PROV'] == false)
							echo "<button class=\"button\" onclick='openReg();'>Войти/Зарегистрироваться</button>";
					}
					?>
				</center>
			</div>
		</div>
	</div>
	<?php require_once ('footer.php'); ?>
</body>

</html>