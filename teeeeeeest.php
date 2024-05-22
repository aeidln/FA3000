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

<body id='cont'>
	<?php require_once ('header.php'); ?>
	<div class="container">
		<div class="block">
			<div id="cont">
				<div class="cc_block" id="cont">

					<div class="">
						<h2>STANDART</h2>
						<div class="cc_infs">
							<div class="cc_inf"><img alt="" src="Resources/8.webp">Групповые занятия по расписанию</div>
							<div class="cc_inf"><img alt="" src="Resources/6.webp">Посещение тренажерного зала</div>
							<div class="cc_inf"><img alt="" src="Resources/4.webp">1 фитнес-тестирование</div>
							<div class="cc_inf"><img alt="" src="Resources/5.webp">3 персональных тренировок</div>
							<div class="cc_inf"><img alt="" src="Resources/3.webp">1 гостевой визит</div>
						</div>
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
				<div class="cc_block" id="cont">
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
							<div class="cc_inf"><img alt="" src="Resources/1.webp">Индивидуальный шкафчик и полотенце
							</div>
							<div class="cc_inf"><img alt="" src="Resources/3.webp">5 гостевых визитов</div>


						</div>
						<?
						if (isset($_SESSION['Email']) && $_SESSION['Status'] == 1)
							echo "<button onclick=\"openCc_form(2);\" class=\"button\">Оставить заявку</button>";

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php require_once ('footer.php'); ?>
</body>

</html>
<script>
	document.querySelector('#cont').addEventListener('scrollend', () => console.log('snap ended'))
</script>
<style>
	#cont {
		height: 600px;


		overflow-x: auto;
		scroll-snap-type: y mandatory;

	}

	#cont .a11 {
		height: 100%;
		scroll-snap-align: start;
		
	}

	#cont::-webkit-scrollbar {
		width: 0;
	}
</style>