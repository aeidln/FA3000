<header>
	<div class="header">
		<a href="index.php"><img alt="" id="logo" src="Resources/logo_3000.png"></a>
		<div class="main_nav">
			<div class="dropdown"><a href="">О клубе</a><i class="-hover"></i>
				<ul class="dropdown-list">
					<li><a href="https://fitness3000.ru/upload/29.05.2023.%D0%9E%D0%B1%D1%89%D0%B8%D0%B5%20%D0%BF%D1%80%D0%B0%D0%B2%D0%B8%D0%BB%D0%B0.pdf">Правила клуба</a></li>
					<li><a href="Trainers.php">Тренеры</a></li>
					<li><a href="Reviews.php">Отзывы</a></li>
				</ul>
			</div>
			<div class="dropdown"><a href="Services.php">Услуги</a><i class="-hover"></i>
				<ul class="dropdown-list">
					<li><a href="Gym.php">Тренажерный зал</a></li>
					<li><a href="Group_lessons.php">Групповые занятия</a></li>
					<ul>
						<li><a href="Group_lessons.php#gl1">Кросс-треннинг и единоборства</a></li>
						<li><a href="Group_lessons.php#gl2">Йога и гибкая сила</a></li>
						<li><a href="Group_lessons.php#gl3">Танцевальный фитнес</a></li>
						<li><a href="Group_lessons.php#gl4">Сила и выносливость</a></li>
						<li><a href="Group_lessons.php#gl5">Кардиотренировки</a></li>
						<li><a href="Group_lessons.php#gl6">Игровые виды</a></li>
						<li><a href="Group_lessons.php#gl7">Скаладром</a></li>
					</ul>
					<li><a href="Sport_medicine.php">Спортивная медицина</a></li>
					<li><a href="Personal_tr.php">Персональные тренировки</a></li>
					<li><a href="Kids_fit.php">Детский фитнес</a></li>
					<li><a href="Extra_serv.php">Дополнительные услуги</a></li>
				</ul>
			</div>
			<div class="dropdown"><a href="Club_cards.php">Клубные карты</a><i class="-hover"></i>
				<ul class="dropdown-list">
					<li><a href="">Карты STANDART</a></li>
					<li><a href="">Карты VIP</a></li>
				</ul>
			</div>
			<div class="dropdown"><a href="">Ваши цели</a><i class="-hover"></i>
				<ul class="dropdown-list">
					<li><a href="Loss_weight.php">Снижение веса</a></li>
					<li><a href="Musclues.php">Увеличение мышечной массы</a></li>
					<li><a href="">Реабилитация</a></li>
				</ul>
			</div>
		</div>
		<div class="inf_menu">
			<span class="inf_cont">
				<a href="">
					<img alt="" id="phone_menu" src="Resources/phone_menu.png">
					<b>+7 (347) 216-3000</b></a>
			</span>
			<hr>
			<span class="inf_cont">
				<?php
				session_start();
				if ($_SESSION['PROV'] == false)
					echo "<img alt='' src='Resources/123.png' onclick='openReg();'>";

				if ($_SESSION['PROV'] == true) {
					if ($_SESSION['Status'] == 1)
					echo "<a href='Cabinet.php'><img alt='' src='Resources/123.png'></a>";
					elseif ($_SESSION['Status'] == 5)
					echo "<a href='Cabinet_tr.php'><img alt='' src='Resources/123.png'></a>";
					elseif ($_SESSION['Status'] == 10)
					echo "<a href='Admin.php'><img alt='' src='Resources/123.png'></a>";
				}
				?>
			</span>
		</div>
		<div class="menu_burg" onclick="bopen();">
			<span></span>
		</div>

	</div>
</header>
<?php require_once('modal.php'); 
session_start();
if (!isset($_SESSION['Email'])) {	
	echo "<script>
	setTimeout(() => {
		document.getElementsByClassName(\"modal\")[0].style.display = \"block\";
		document.getElementById(\"reklama\").style.display = \"block\";
	  }, 3000);
	</script>";
}
?>