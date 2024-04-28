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
					if (isset($_SESSION['Email'])) {
						if ($_SESSION['Status'] == 1){
							echo "<button onclick=\"z_card(1);\" class=\"button\">Оставить заявку</button>";
					
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
						echo "<button onclick=\"z_card(2);\" class=\"button\">Оставить заявку</button>";
					}					
				}
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
<script>
	function z_card(type_c) {
		

		// document.getElementById("cc_zav").style.display = "block";

		// $.ajax({
		// 	url: 'z_card.php',         /* Куда отправить запрос */
		// 	method: 'get',         /* Метод запроса (post или get) */
		// 	dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
		// 	data: { type_c: type_c },     /* Данные передаваемые в массиве */
		// 	success: function (data) {
		// 		
				


		// 		/* функция которая будет выполнена после успешного запроса.  */
		// 		// document.getElementsByClassName("modal")[0].style.display = "block";
		// 		// document.getElementsByClassName("modal-cont")[0].innerHTML="<h1>МОЛОДЕЦ АДЕЛИНА</h1>" /* В переменной data содержится ответ от index.php. */
		// 	}
		// })
	};
</script>