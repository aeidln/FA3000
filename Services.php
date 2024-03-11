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
			<a href="Index.php">Главная</a>/<a>Услуги</a><br>
			<h1>Услуги</h1>
			<!-- <p>Фитнес-арена 3000 предлагает своим посетителям множество услуг для поддержания физической формы и здоровья.</p> -->
			<div class="usl">

				<div class="hover-effect-scale">
					<a href="Gym.php">
						<div class="effect">
							<img src="Resources/usl1.jpg" alt="">
							<div class="caption">
								<h3>Тренажерный зал</h3>
							</div>
						</div>
					</a>
				</div>

				<div class="hover-effect-scale">
				<a href="Group_lessons.php">
					<div class="effect">
						<img src="Resources/usl2.jpg" alt="">
						<div class="caption">
							<h3>Групповые занятия</h3>
						</div>
					</div>
					</a>
				</div>
				<div class="hover-effect-scale">
				<a href="Sport_medicine.php">
					<div class="effect">
						<img src="Resources/usl3.jpg" alt="">
						<div class="caption">
							<h3>Спортивная медицина</h3>
						</div>
					</div>
					</a>
				</div>
				<div class="hover-effect-scale">
				<a href="Personal_tr.php">
					<div class="effect">
						<img src="Resources/usl4.jpg" alt="">
						<div class="caption">
							<h3>Персональные тренировки</h3>
						</div>
					</div>
					</a>
				</div>
				<div class="hover-effect-scale">
				<a href="Kids_fit.php">
					<div class="effect">
						<img src="Resources/usl5.jpg" alt="">
						<div class="caption">
							<h3>Детский фитнес</h3>
						</div>
					</div>
					</a>
				</div>
				<div class="hover-effect-scale">
				<a href="Extra_serv.php">
					<div class="effect">
						<img src="Resources/usl6.jpg" alt="">
						<div class="caption">
							<h3>Дополнительные услуги</h3>
						</div>
					</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php require_once('footer.php'); ?>
	</script>
</body>

</html>