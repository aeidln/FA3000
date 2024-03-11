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
	<script src="jquery.min.js"></script>
	<script src="jquery.maskedinput.js"></script>
	<?php
	echo "<script>
	document.getElementsByClassName(\"circ\")[0].style.background = \"#f73a3a\";document.getElementsByClassName(\"pod\")[0].style.color = \"#ffffff\";
	document.getElementsByClassName(\"desc\")[0].style.display = \"block\";
	alert(\"Hello\");
</script>";
	$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
	mysqli_select_db($link, "db") or die("А нет такой бд!");
	?>
	<div class="container" id="c1">
		<div id="t1">
			<h1>САМЫЙ ПРОСТОРНЫЙ ФИТНЕС В УФЕ</h1>
			<p>ФИТНЕС-АРЕНА 3000 — это комфортное современное фитнес-пространство, где вы сможете достигать своих
				целей<br>
				и поддерживать здоровый образ жизни. Тренажеры ведущих мировых брендов, актуальные программы
				тренировок<br>
				для взрослых и детей и многое другое — всё, что нужно для эффективных занятий и вашего комфорта.<br>
				Становитесь лучшей версией себя вместе с нами!</p>
			<button class="button">Узнать больше →</button>
		</div>
	</div>
	<div class="container">
		<div class="b1">
			<h1>Преимущества клуба</h1>
			<?php
			$rows = mysqli_query($link, "SELECT * from preim_ where id > 0");
			$k = 0;
			while ($preim = mysqli_fetch_array($rows)) {
				if ($k == 0)
					echo "<div class=\"desc\">";
				else
					echo "<div class=\"desc\" style=\"display:none;\">";
				echo "<h2>" . $preim['title'] . "</h2>";
				echo "<p>" . $preim['text'] . "</p>";
				echo "<button class=\"button\">Подробнее →</button>";
				echo "</div>";
				$k++;
			}
			?>

			<!-- <div class="desc">
				<h2>Тренажерный зал</h2>
				<p>Тренажерный зал ФИТНЕС-АРЕНА «3000» — это беговой трек длиной 125 м на две дорожки, внутри
					которого расположены тренажеры на общей площади 1200 м2. Наш зал оснащен передовым и
					высокотехноолгичным обрудованием известных марок. Также в нашем зале всегда находятся дежурные
					теренера, которые с радостью помогут и ответят на ваши вопросы.</p>
				<button class="button">Подробнее →</button>
			</div>
			<div class="desc" style="display:none;">
				<h2>Групповые тренировки</h2>
				<p>У нас вы найдете множество разнообразных групповых направлений на любой вкус: силовые и
					аэробные тренировки, танцевальные классы, занятия для осанки и гибкости и др. Благодаря большому
					выбору, вы можете попробовать себя на разных тренировках и выбрать то направление, которое подходит
					и нравится именно вам.</p>
				<button class="button">Подробнее →</button>
			</div>
			<div class="desc" style="display:none;">
				<h2>Скалодром</h2>
				<p>Крытый скалодром ФИТНЕС-АРЕНЫ «3000» имеет высоту 10 метров, общую площадь более 100 кв. м и 25
					маршрутов, которые постоянно меняются и дополняются.
					Вам не нужно приносить с собой снаряжение, достаточно иметь спортивную форму, обувь и принадлежности
					для душа.
					Все тренировки идут под контролем инструктора-профессионала. </p>
				<button class="button">Подробнее →</button>
			</div>
			<div class="desc" style="display:none;">
				<h2>Фитнес-тестирование</h2>
				<p>На территории ФИТНЕС-АРЕНЫ «3000» вы всегда можете провести анализ состава вашего тела
					(соотношение жировой и мышечной ткани). На основании результатов теста для вас составят эффективную
					и безопасную индивидуальную программу занятий.</p>
				<button class="button">Подробнее →</button>
			</div>
			<div class="desc" style="display:none;">
				<h2>Детский фитнес</h2>
				<p>Детский фитнес - это, прежде всего, здоровье ваших детей. В нашем клубе созданы все условия
					для того, чтобы приобщить к спорту даже самых маленьких деток. Для ваших детей есть уникальная
					возможность познакомиться с миром фитнеса и найти себе занятие по душе. </p>
				<button class="button">Подробнее →</button>
			</div>
			<div class="desc" style="display:none;">
				<h2>Спа-сауна</h2>
				<p>Сауна – это традиционная финская баня с сухим горячим воздухом. Как и другие парные, сауна оказывает
					целебное воздействие на здоровье, тонизируя все системы организма, убивая вирусы и бактерии.
					У нас можно посетить сауну после тренировки или в качестве отдельной услуги.
				</p>
				<button class="button">Подробнее →</button>
			</div> -->
			<div class="circs">
				<div class="circ" onclick="usl_ch(0);">
					<img alt="" src="Resources/gym.png"><br>
					<p class="pod">Тренажерный<br> зал</p>
				</div>
				<div class="circ" onclick="usl_ch(1);">
					<img alt="" src="Resources/group.png">
					<p class="pod">Групповые<br> тренировки</p>
				</div>
				<div class="circ" onclick="usl_ch(2);">
					<img alt="" src="Resources/scal.png">
					<p class="pod">Скалодром</p>
				</div>
				<div class="circ" onclick="usl_ch(3);">
					<img alt="" src="Resources/ekg.png">
					<p class="pod">Фитнес<br> тестирование</p>
				</div>
				<div class="circ" onclick="usl_ch(4);">
					<img alt="" src="Resources/kids.png">
					<p class="pod">Фитнес<br>для детей</p>
				</div>
				<div class="circ" onclick="usl_ch(5);">
					<img alt="" src="Resources/sauna.png">
					<p class="pod">Спа-сауна</p>
				</div>
			</div>
			<h1>Записаться на пробное посещение</h1>
			<form method="POST" action="pr_z.php">
				<input name="FIO_pr" type="text" class="textbox" placeholder="Введите ФИО" required><br>
				<input name="Number_pr" id="Number_pr" type="text" class="textbox" placeholder="Введите номер телефона"
					required><br>
				<script>$("#Number_pr").mask("+7(999)999-99-99", { autoclear: false });</script>
				<p><input required type="checkbox"> Я даю согласие на обработку персональных данных в соотвествии с <a
						href="">политикой конфиденциальности.</a></p><br>
				<button type="submit" class="button">Записаться</button>
			</form>
			<h1>Действующие акции</h1>
			<div class="cards">
				<div class="card">
					<div>
						<img alt="" id="card" src="Resources/card.png">
					</div>
					<div>
						<p></p><b>Годовая дневная карта STANDART</b><br>
						Срок действия:<br>
						с 07:00 до 18:00 - по будням<br>
						с 09:00 до 21:00 - в выходные и праздничные дни<br>
						<p>
							<s>19900 руб.</s><br>
							<font color="#da1717">17900 руб.</font>
						</p>
						<button class="button">Купить карту</button>
					</div>
				</div>
				<div class="card">
					<div>
						<img alt="" id="card" src="Resources/card2.png">
					</div>
					<div>
						<b>Годовая дневная карта VIP</b><br>
						Срок действия:<br>
						с 07:00 до 18:00 - по будням<br>
						с 09:00 до 21:00 - в выходные и праздничные дни<br>
						<p>
							<s>22900 руб.</s><br>
							<font color="#da1717">17900 руб.</font>
						</p>
						<button class="button">Купить карту</button>
					</div>
				</div>
			</div>
			<a name="gallery"></a>
			<h1>Галлерея</h1>
			<div class="sim-slider">
				<ul class="sim-slider-list">
					<li><img src="http://pvbk.spb.ru/inc/slider/imgs/no-image.gif" alt="screen"></li>
					<!-- <li class="sim-slider-element"><img src="Resources/sl1.jpg" alt="0"></li>
					<li class="sim-slider-element"><img src="Resources/sl2.jpg" alt="1"></li>
					<li class="sim-slider-element"><img src="Resources/sl3.jpg" alt="2"></li>
					<li class="sim-slider-element"><img src="Resources/sl4.jpg" alt="3"></li>
					<li class="sim-slider-element"><img src="Resources/sl5.jpg" alt="4"></li>
					<li class="sim-slider-element"><img src="Resources/sl6.jpg" alt="5"></li>
					<li class="sim-slider-element"><img src="Resources/sl7.jpg" alt="6"></li>
					<li class="sim-slider-element"><img src="Resources/sl8.jpg" alt="7"></li> -->
					<?php
                $rows = mysqli_query($link, "SELECT * from gallery");
				$k=0;
                while ($ph = mysqli_fetch_array($rows)) {       
					echo "<li class=\"sim-slider-element\">";    
                    echo "<img alt=".$k." src=\"Resources\\".$ph['name'].".".$ph['type']."\"></li>";                    
                }                
                ?>
				</ul>
				<div class="sim-slider-arrow-left"></div>
				<div class="sim-slider-arrow-right"></div>
				<div class="sim-slider-dots"></div>
			</div>
			<h1>Как до нас добраться?</h1>
			<div class="map">

				<div style="position:relative;overflow:hidden;">
					<iframe
						src="https://yandex.ru/map-widget/v1/?ll=56.008443%2C54.716535&mode=search&oid=1157680995&ol=biz&sctx=ZAAAAAgBEAAaKAoSCZj2zf3V%2F0tAEXAjZYukW0tAEhIJPu3w12SNmj8RcOoDyTuHgj8iBgABAgMEBSgKOABAlc0GSABqAnJ1nQHNzEw9oAEAqAEAvQFo36RgwgEF456DqATqAQDyAQD4AQCCAhzRhNC40YLQvdC10YEg0LDRgNC10L3QsCAzMDAwigIAkgIAmgIMZGVza3RvcC1tYXBz&sll=56.008443%2C54.716535&sspn=0.015525%2C0.005417&text=%D1%84%D0%B8%D1%82%D0%BD%D0%B5%20%D0%B0%D1%80%D0%B5%D0%BD%D0%B0%203000&z=16.54"
						width="700px" height="400px" style="position:relative; border: none; margin-right:30px;">
					</iframe>
				</div>
				<b>ВРЕМЯ РАБОТЫ:</b><br>
				Будни с 07:00 до 24:00 Выходные с 09:00 до 21:00<br>
				Отдел продаж: Будни с 10:00 до 21:00 Выходные с 10:00 до 20:00<br>
			</div>
		</div>
	</div>
	<div class="container" style="background-color: #000000;">

		<form method="POST" action="vp.php" id="quest">
			<h1>Остались вопросы?</h1>
			<p>Мы перезвоним и ответим на них! </p>
			<input name="FIO_vp" type="text" class="textbox" placeholder="Введите ФИО"><br>
			<input name="Number_vp" id="Number_vp" type="text" class="textbox" placeholder="Введите номер телефона"><br>
			<script>$("#Number_vp").mask("+7(999)999-99-99", { autoclear: false });</script>
			<button type="submit" class="button">Отправить</button>
		</form>
		<img alt="" id="wm" src="Resources/wm.png">
	</div>
	<?php require_once('footer.php'); ?>
</body>

</html>
<?php
echo "<script language='javascript'>
  document.getElementsByClassName(\"circ\")[0].style.background = \"#f73a3a\";
  document.getElementsByClassName(\"pod\")[0].style.color = \"#ffffff\";
  document.getElementsByClassName(\"desc\")[0].style.display = \"block\";
</script>
";
?>