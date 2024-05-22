<!DOCTYPE html>
<html lang="ru">

<head>
	<title>ФИТНЕС-АРЕНА 3000</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Фитнес-арена 3000">
	<link rel="stylesheet" href="3000_стили.css" type="text/css">
	<link rel="shortcut icon" href="Resources/icon.ico" type="image/png">
</head>

<body>
	<?php require_once ('header.php');
	$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
	mysqli_select_db($link, "db") or die("А нет такой бд!");
	?>
	<div class="container" id="c1">
		<div id="t1" class=" animated-element">
			<h1>САМЫЙ ПРОСТОРНЫЙ ФИТНЕС В УФЕ</h1>

			<p>ФИТНЕС-АРЕНА 3000 — это комфортное современное фитнес-пространство, где вы сможете достигать своих
				целей<br>
				и поддерживать здоровый образ жизни. Тренажеры ведущих мировых брендов, актуальные программы
				тренировок<br>
				для взрослых и детей и многое другое — всё, что нужно для эффективных занятий и вашего комфорта.<br>
				Становитесь лучшей версией себя вместе с нами!</p>
			<a href="#123">
				<div id="123" class="arrow"></div>
			</a>
		</div>
	</div>
	<div class="container">
		<div class="b1">
			<h1 class="element">Преимущества клуба</h1>
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
				echo "<a href=\" \"><button class=\"button\">Подробнее →</button></a>";
				echo "</div>";
				$k++;
			}
			?>


			<div class="container">
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
			<h1 class="element">Записаться на пробное посещение</h1>
			<form id="prob">
				<input name="FIO_pr" id="FIO_pr" type="text" class="textbox" placeholder="Введите ФИО" required><br>
				<input name="Number_pr" id="Number_pr" type="text" class="textbox" placeholder="Введите номер телефона"
					required><br>
				<script>$("#Number_pr").mask("+7(999)999-99-99", { autoclear: false });</script>
				<p><input required type="checkbox"> Я даю согласие на обработку персональных данных в соотвествии с <a
						href="Resources/polit.pdf">политикой конфиденциальности.</a></p><br>
				<button type="submit" class="button">Записаться</button>
			</form>
			<h1 class="element">Действующие акции</h1>
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
			<h1 class="element">Галлерея</h1>
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
					$k = 0;
					while ($ph = mysqli_fetch_array($rows)) {
						echo "<li class=\"sim-slider-element\">";
						echo "<img alt=" . $k . " src=\"Resources\\" . $ph['name'] . "." . $ph['type'] . "\"></li>";
					}
					?>
				</ul>
				<div class="sim-slider-arrow-left"></div>
				<div class="sim-slider-arrow-right"></div>
				<div class="sim-slider-dots"></div>
			</div>
			<h1 class="element">Как до нас добраться?</h1>
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

		<form id="quest">
			<h1 class="element">Остались вопросы?</h1>
			<p>Мы перезвоним и ответим на них! </p>
			<input name="FIO_vp" id="FIO_vp" type="text" class="textbox" placeholder="Введите ФИО"><br>
			<input name="Number_vp" id="Number_vp" type="text" class="textbox" placeholder="Введите номер телефона"><br>
			<script>$("#Number_vp").mask("+7(999)999-99-99", { autoclear: false });</script>
			<p><input required type="checkbox"> Я даю согласие на обработку персональных данных в соотвествии с <a
						href="Resources/polit.pdf">политикой конфиденциальности.</a></p><br>
			<button type="submit" class="button">Отправить</button>
		</form>
		<img alt="" id="wm" src="Resources/wm.png">
	</div>
	<?php require_once ('footer.php'); ?>
</body>

</html>
<script language='javascript'>
	document.getElementsByClassName("circ")[0].style.background = "#f73a3a";
	document.getElementsByClassName("pod")[0].style.color = "#ffffff";
	document.getElementsByClassName("desc")[0].style.display = "block";

	window.addEventListener('scroll', function() {
  var elements = document.querySelectorAll('.element');

  elements.forEach(function(element) {
    var elementPosition = element.getBoundingClientRect().top;
    var windowHeight = window.innerHeight;

    // Проверяем, если элемент находится в пределах видимой области окна
    if (elementPosition < windowHeight && elementPosition > 0) {
      element.classList.add('animated-element');
    } else {
      // Убираем класс анимации, если элемент находится за пределами видимости
      element.classList.remove('animated-element');
    }
  });
});

document.getElementById('prob').addEventListener('submit', function (event) {
		event.preventDefault();
		FIO_pr = document.getElementById("FIO_pr").value;
		Number_pr = document.getElementById("Number_pr").value;
		$.ajax({
			url: 'pr_z.php',
			method: 'post',
			async: false,
			data: { FIO_pr: FIO_pr, Number_pr: Number_pr },
			success: function (response) {
				if (response==1){
					alert("Заявка на пробное занятие успешно отправлена!");
					location.reload()
				}
			}
		});
	});
	document.getElementById('quest').addEventListener('submit', function (event) {
		event.preventDefault();
		FIO_vp = document.getElementById("FIO_vp").value;
		Number_vp = document.getElementById("Number_vp").value;
		$.ajax({
			url: 'vp.php',
			method: 'post',
			async: false,
			data: { FIO_vp: FIO_vp, Number_vp: Number_vp},
			success: function (response) {
				if (response==1){
					alert("Заявка отпралвенаю Перезвоним в ближайшее время!");
					location.reload()
				}
			}
		});
	});
	function Sim(sldrId) {
		let id = document.getElementById(sldrId);
		if (id) {
			this.sldrRoot = id
		}
		else {
			this.sldrRoot = document.querySelector('.sim-slider')
		};


		this.sldrList = this.sldrRoot.querySelector('.sim-slider-list');
		this.sldrElements = this.sldrList.querySelectorAll('.sim-slider-element');
		this.sldrElemFirst = this.sldrList.querySelector('.sim-slider-element');
		this.leftArrow = this.sldrRoot.querySelector('div.sim-slider-arrow-left');
		this.rightArrow = this.sldrRoot.querySelector('div.sim-slider-arrow-right');
		this.indicatorDots = this.sldrRoot.querySelector('div.sim-slider-dots');

		// Initialization
		this.options = Sim.defaults;
		Sim.initialize(this)
	};

	Sim.defaults = {

		// Default options for the carousel
		loop: true,     // Бесконечное зацикливание слайдера
		auto: true,     // Автоматическое пролистывание
		interval: 3000, // Интервал между пролистыванием элементов (мс)
		arrows: true,   // Пролистывание стрелками
		dots: true      // Индикаторные точки
	};

	Sim.prototype.elemPrev = function (num) {
		num = num || 1;

		let prevElement = this.currentElement;
		this.currentElement -= num;
		if (this.currentElement < 0) this.currentElement = this.elemCount - 1;

		if (!this.options.loop) {
			if (this.currentElement == 0) {
				this.leftArrow.style.display = 'none'
			};
			this.rightArrow.style.display = 'block'
		};

		this.sldrElements[this.currentElement].style.opacity = '1';
		this.sldrElements[prevElement].style.opacity = '0';

		if (this.options.dots) {
			this.dotOn(prevElement); this.dotOff(this.currentElement)
		}
	};

	Sim.prototype.elemNext = function (num) {
		num = num || 1;

		let prevElement = this.currentElement;
		this.currentElement += num;
		if (this.currentElement >= this.elemCount) this.currentElement = 0;

		if (!this.options.loop) {
			if (this.currentElement == this.elemCount - 1) {
				this.rightArrow.style.display = 'none'
			};
			this.leftArrow.style.display = 'block'
		};

		this.sldrElements[this.currentElement].style.opacity = '1';
		this.sldrElements[prevElement].style.opacity = '0';

		if (this.options.dots) {
			this.dotOn(prevElement); this.dotOff(this.currentElement)
		}
	};

	Sim.prototype.dotOn = function (num) {
		this.indicatorDotsAll[num].style.cssText = 'background-color:#BBB; cursor:pointer;'
	};

	Sim.prototype.dotOff = function (num) {
		this.indicatorDotsAll[num].style.cssText = 'background-color:#556; cursor:default;'
	};

	Sim.initialize = function (that) {

		// Constants
		that.elemCount = that.sldrElements.length; // Количество элементов

		// Variables
		that.currentElement = 0;
		let bgTime = getTime();

		// Functions
		function getTime() {
			return new Date().getTime();
		};
		function setAutoScroll() {
			that.autoScroll = setInterval(function () {
				let fnTime = getTime();
				if (fnTime - bgTime + 10 > that.options.interval) {
					bgTime = fnTime; that.elemNext()
				}
			}, that.options.interval)
		};

		// Start initialization
		if (that.elemCount <= 1) {   // Отключить навигацию
			that.options.auto = false; that.options.arrows = false; that.options.dots = false;
			that.leftArrow.style.display = 'none'; that.rightArrow.style.display = 'none'
		};
		if (that.elemCount >= 1) {   // показать первый элемент
			that.sldrElemFirst.style.opacity = '1';
		};

		if (!that.options.loop) {
			that.leftArrow.style.display = 'none';  // отключить левую стрелку
			that.options.auto = false; // отключить автопркрутку
		}
		else if (that.options.auto) {   // инициализация автопрокруки
			setAutoScroll();
			// Остановка прокрутки при наведении мыши на элемент
			that.sldrList.addEventListener('mouseenter', function () { clearInterval(that.autoScroll) }, false);
			that.sldrList.addEventListener('mouseleave', setAutoScroll, false)
		};

		if (that.options.arrows) {  // инициализация стрелок
			that.leftArrow.addEventListener('click', function () {
				let fnTime = getTime();
				if (fnTime - bgTime > 1000) {
					bgTime = fnTime; that.elemPrev()
				}
			}, false);
			that.rightArrow.addEventListener('click', function () {
				let fnTime = getTime();
				if (fnTime - bgTime > 1000) {
					bgTime = fnTime; that.elemNext()
				}
			}, false)
		}
		else {
			that.leftArrow.style.display = 'none'; that.rightArrow.style.display = 'none'
		};

		if (that.options.dots) {  // инициализация индикаторных точек
			let sum = '', diffNum;
			for (let i = 0; i < that.elemCount; i++) {
				sum += '<span class="sim-dot"></span>'
			};
			that.indicatorDots.innerHTML = sum;
			that.indicatorDotsAll = that.sldrRoot.querySelectorAll('span.sim-dot');
			// Назначаем точкам обработчик события 'click'
			for (let n = 0; n < that.elemCount; n++) {
				that.indicatorDotsAll[n].addEventListener('click', function () {
					diffNum = Math.abs(n - that.currentElement);
					if (n < that.currentElement) {
						bgTime = getTime(); that.elemPrev(diffNum)
					}
					else if (n > that.currentElement) {
						bgTime = getTime(); that.elemNext(diffNum)
					}
					// Если n == that.currentElement ничего не делаем
				}, false)
			};
			that.dotOff(0);  // точка[0] выключена, остальные включены
			for (let i = 1; i < that.elemCount; i++) {
				that.dotOn(i)
			}
		}
	};
	new Sim();
</script>