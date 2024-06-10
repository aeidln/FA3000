<script src="jquery.min.js"></script>
<script src="jquery.maskedinput.js"></script>
<div class="modal" style="display:none;">
	<span id="close" onclick="closeMod();">×</span>
	<div class="modal-cont">
		<div id="registration" style="display:none;">
			<span id="vh" onclick="contReg(0);" style="border-bottom-color: #f73a3a;">Вход</span>/<span id="reg"
				onclick="contReg(1);">Регистрация</span>
			<div class="regCont">
				<input type="text" class="textbox" placeholder="Email" name="Email_v" id="Email_v" required><br>
				<span class="error"><br></span>
				<input type="password" class="textbox" placeholder="Пароль" name="Password_v" id="Password_v" required><br>
				<button onclick="login()" class="button">Войти</button>
			</div>
			<div class="regCont" style="display: none;">
				<form id="regF">

					<span class="required">*</span>
					<input type="text" class="textbox" placeholder="ФИО" name="FIO" id="FIO" title="Введите ваше ФИО. Только латиница и кириллица."><br>
					<span class="error"><br></span>

					<span class="required">*</span>
					<input type="text" class="textbox required" placeholder="Email" name="Email" id="Email" title="Введите ваш email. Формат: example@test.com"><br>
					<span class="error"><br></span>

					<input type="text" class="textbox" placeholder="Номер телефона" name="Number" id="Number" title="Введите ваш номер телефона"><br>
					<script>$("#Number").mask("+7(999)999-99-99", { autoclear: false });</script>
					<span class="error"><br></span>

					<input type="date" class="textbox" name="Birthdate" id="Birthdate" title="Введите вашу дату рождения"><br>
					<span class="error"><br></span>

					<span class="required">*</span>
					<input type="password" class="textbox" placeholder="Пароль" name="Password" id="Password" title="Пароль должен содержать не менее 8 и не более 16 символов, хотя бы по одной заглавной и строчной латинской букве"><br>
					<span class="error"><br></span>

					<span class="required">*</span>
					<input type="password" class="textbox" placeholder="Повтор пароля" name="R_Password" id="R_Password" title="Пароли должны сопадать"><br>
					<span class="error"><br></span>

					<p><input id="polit" type="checkbox" required> Я даю согласие на обработку персональных данных в соотвествии с <a href="Resources/polit.pdf">политикой конфиденциальности.</a></p>
					<button type="submit" class="button">Зарегистрироваться</button>
				</form>
			</div>
		</div>
		<div id="reklama" style="display: none;">
			<img id="gRek" src="Resources/rek.png">
			<button class="button" onclick='openReg();'>Войти/Зарегистрироваться</button>
		</div>
		<div id="tr_form" style="display: none;">
			<h2 class="mod_head">Добавить тренера</h2><br>
			<form action="add_tr.php" method="POST">
			<label>Выберите пользователя:</label>
			<?php
                        $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                        mysqli_select_db($link, "db") or die("А нет такой бд!");
                        $rows = mysqli_query($link, "SELECT * from users u where Status = 1");
                        echo "<select name='u_id' id=\"u_names\">";
                        // echo "<option>Выберите пользователя</option>";
                        while ($u = mysqli_fetch_array($rows)) {
                            echo "<option value='" . $u['ID'] . "'>" . $u['FIO'] . "</option>";
                        }
                        echo "</select><br><br>	"; ?>
						<label>Описание :</label><textarea name="desc"></textarea><br><br>
						<label>Фотография:	</label><input type="file" name="tr_ph"><br><br>					
				<button class="button">Добавить</button>
			</form>
		</div>
		<div id="cc_form" style="display: none;">
			<h2 class="mod_head">Заполните форму, чтобы оставить заявку</h2><br>
			<form action="z_card.php" method="POST">
				Выбранный тариф:<b id="type_val"></b>
				<br>
				Срок карты:<br>
				<input type="hidden" id="type_c" name="type_c"></input>
				<input required value="12" type="radio" name="duration">12 месяцев</input>
				<input required value="6" type="radio" name="duration">6 месяцев</input><br>
				Формат карты:<br>
				<input required value="Дневная" type="radio" name="format">Дневная</input>
				<input required value="Полная" type="radio" name="format">Полная</input><br>
				<button class="button">Отправить заявку</button>
			</form>
		</div>
		<div id="edit_data" style="display:none;">
			<h2 class="mod_head">Редактировать профиль</h2><br>
			<div id="b_editProf"></div>
		</div>
	</div>
</div>
<?
session_start();
if (!isset($_SESSION['Email'])) {
	echo "<script>
	setTimeout(() => {
		if (document.getElementsByClassName(\"modal\")[0].style.display != \"block\" && sessionStorage.getItem(\"rek\") == null){
			openRek();
			sessionStorage.setItem(\"rek\", 1);
		}
	  }, 4000);
	</script>";
}
?>
<script>
	function login() {
		Email_v = document.getElementById("Email_v").value;
		Password_v = document.getElementById("Password_v").value;
		$.ajax({
			url: 'login.php',
			method: 'post',
			async: false,
			data: { Email_v: Email_v, Password_v: Password_v },
			success: function (response) {
				console.log(response);
				if (response == 10) {
					window.sessionStorage.setItem('pan_btn', '0');
					window.sessionStorage.setItem('adm_body', '0');
					window.location.href = "Admin.php";
				}
				else if (response == 5) window.location.href = "Cabinet_tr.php";
				else if (response == 1) window.location.href = "Cabinet.php";
				else {
					document.getElementsByClassName("error")[0].style.display = "block";
					document.getElementsByClassName("error")[0].innerHTML = "Неверный ввод email или пароля. Попробуйте еще раз."
				}

			}
		});

	}
	document.getElementById('regF').addEventListener('submit', function (event) {
		event.preventDefault();
		FIO = document.getElementById("FIO").value;
		Email = document.getElementById("Email").value;
		Number = document.getElementById("Number").value;
		Birthdate = document.getElementById("Birthdate").value;
		Password = document.getElementById("Password").value;
		R_Password = document.getElementById("R_Password").value;
		Polit_ch = document.getElementById('polit').checked;
		if (FIO == "" || Email == "" || Password == "" || R_Password == "") {
			alert("Обязательные поля не могут быть пустыми!");
			return false;
		}
		if (!Polit_ch) {
			return false;
		}
		for (i = 0; i <= 5; i++) {
			if (document.getElementsByClassName("error")[i].style.display == "block") {
				return false;
			}
		}
		$.ajax({
			url: 'reg.php',
			method: 'post',
			async: false,
			data: { Email: Email, Password: Password, FIO: FIO, Number: Number, Birthdate: Birthdate },
			success: function (response) {
				if (response == -1) {
					mail.style.borderColor = "red";
					document.getElementsByClassName("error")[2].style.display = "block";
					document.getElementsByClassName("error")[2].innerHTML = "Такой логин уже занят. Пожалуйста, выберите другой логин.";
					return false;
				}
				else if (response == 1) {
					window.location.href = "Cabinet.php";
				}
				else console.log(response);
			}
		});
	});
	function saveChg(ID, Status) {
			FIO = document.getElementById("FIO_ed").value;
			Email = document.getElementById("Email_ed").value;
			Number = document.getElementById("Number_ed").value;
			Birthdate = document.getElementById("Birthdate_ed").value;
			// k = 0;
			// for (i = 0; i <= 5; i++) {
			// 	if (document.getElementsByClassName("error")[i].style.display == "block") {
			// 		k++;
			// 	}
			// }
			// if (k == 0) {
			$.ajax({
				url: 'editProf.php',         /* Куда отправить запрос */
				method: 'post',
				async: false,          /* Метод запроса (post или get) */
				// dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
				data: { ID: ID, Email: Email, FIO: FIO, Number: Number, Birthdate: Birthdate, Status: Status },     /* Данные передаваемые в массиве */
				success: function (response) {
					console.log(response);
					if (response == 10) {
						window.location.href = "Admin.php";
					}
					else if (response == 1) {
						window.location.href = "Cabinet.php";
					}
					else if (response == 5)
						window.location.href = "Cabinet_tr.php";
					// // else alert("gjrf");
				}
			});
		}
	const FIO_REGEXP = /^[а-яА-ЯЁёa-zA-Z\-]+(\s[а-яА-ЯЁёa-zA-Z\-]+)?(\s[а-яА-ЯЁёa-zA-Z\-]+)?$/iu;
	const fio = document.getElementById("FIO");

	function isFullNameValid(value) {
		return FIO_REGEXP.test(value);
	}

	function onFullNameInput() {
		if (fio.value == "") {
			fio.style.borderColor = "red";
			document.getElementsByClassName("error")[1].style.display = "block";
			document.getElementsByClassName("error")[1].innerHTML = "Поле \"ФИО\" не может быть пустым"
		}
		else if (!isFullNameValid(fio.value)) {
			fio.style.borderColor = "red";
			document.getElementsByClassName("error")[1].style.display = "block";
			document.getElementsByClassName("error")[1].innerHTML = "Неверный ввод ФИО"
		}
		else {
			fio.style.borderColor = "#39393d";
			document.getElementsByClassName("error")[1].style.display = "none";
			document.getElementsByClassName("error")[1].innerHTML = "";
		}
	}
	fio.addEventListener("blur", onFullNameInput);

	const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"а-яА-Я]+(\.[^<>()[\].,;:\s@"а-яА-Я]+)*)|(".+"))@(([^<>()[\].,;:\s@"а-яА-Я]+\.)+[^<>()[\].,;:\s@"а-яА-Я0-9]{2,})$/iu;
	const mail = document.getElementById("Email");
	function isEmailValid(value) {
		return EMAIL_REGEXP.test(value);
	}
	function onInput() {
		if (mail.value == "") {
			mail.style.borderColor = "red";
			document.getElementsByClassName("error")[2].style.display = "block";
			document.getElementsByClassName("error")[2].innerHTML = "Поле \"Email\" не может быть пустым"
		}
		else if (!isEmailValid(mail.value)) {
			mail.style.borderColor = "red";
			document.getElementsByClassName("error")[2].style.display = "block";
			document.getElementsByClassName("error")[2].innerHTML = "Неверный ввод email"
		}
		else {
			mail.style.borderColor = "#39393d";
			document.getElementsByClassName("error")[2].style.display = "none";
			document.getElementsByClassName("error")[2].innerHTML = "";
		}
	}
	mail.addEventListener("blur", onInput);

	const PASSWORD_REGEXP = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
	const password = document.getElementById("Password");
	const password_r = document.getElementById("R_Password");
	function isPasswordValid(value) {
		return PASSWORD_REGEXP.test(value);
	}
	function onPasInput() {
		if (password.value == "") {
			password.style.borderColor = "red"
			document.getElementsByClassName("error")[5].style.display = "block";
			document.getElementsByClassName("error")[5].innerHTML = "Поле \"Пароль\" не может быть пустым";
		}
		else if (!isPasswordValid(password.value)) {
			password.style.borderColor = "red"
			document.getElementsByClassName("error")[5].style.display = "block";
			document.getElementsByClassName("error")[5].innerHTML = "Неверный пароль. Пароль должен содержать от 8 до 16 символов, не менее одной заглавной и строчной латинской букве";
		}
		else {
			password.style.borderColor = "#39393d";
			document.getElementsByClassName("error")[5].style.display = "none";
			document.getElementsByClassName("error")[5].innerHTML = "";
		}
	}
	password.addEventListener("blur", onPasInput);

	function isPasswordEquals(value1, value2) {
		return value1 == value2;
	}
	function onPasEqual() {
		if (isPasswordEquals(password.value, password_r.value)) {
			password_r.style.borderColor = "#39393d";
			document.getElementsByClassName("error")[6].style.display = "none";
			document.getElementsByClassName("error")[6].innerHTML = "";
		}
		else {
			password_r.style.borderColor = "red";
			document.getElementsByClassName("error")[6].style.display = "block";
			document.getElementsByClassName("error")[6].innerHTML = "Пароли не совпадают";
		}
	}
	password_r.addEventListener("blur", onPasEqual);

	function closeMod() {
		document.body.style.overflow = "";
		document.getElementsByClassName("modal")[0].style.display = "none";
		document.getElementById("reklama").style.display = "none";
		document.getElementById("registration").style.display = "none";

	}
	function openReg() {
		document.body.style.overflow = "hidden";
		document.getElementById("reklama").style.display = "none";
		document.getElementsByClassName("modal")[0].style.display = "block";
		document.getElementById("registration").style.display = "block";
	}
	function openRek() {
		document.body.style.overflow = "hidden";
		document.getElementsByClassName("modal")[0].style.display = "block";
		document.getElementById("registration").style.display = "none";
		document.getElementById("reklama").style.display = "block";
	}
	function contReg(code) {
		document.getElementsByClassName("regCont")[code].style.display = "block";
		if (code == 0) {
			document.getElementsByClassName("regCont")[1].style.display = "none";
			document.getElementById("vh").style.borderBottomColor = "#f73a3a";
			document.getElementById("reg").style.borderBottomColor = "";
		}
		else {
			document.getElementsByClassName("regCont")[0].style.display = "none";
			document.getElementById("reg").style.borderBottomColor = "#f73a3a";
			document.getElementById("vh").style.borderBottomColor = "";
		}
	}

	function openCc_form(type_c) {
		document.body.style.overflow = "hidden";
		document.getElementsByClassName("modal")[0].style.display = "block";
		document.getElementById("cc_form").style.display = "block";
		document.getElementById("type_c").value = type_c;
		console.log(type_c);
		if (type_c == 1)
			document.getElementById("type_val").innerHTML = "STANDART";
		else if (type_c == 2)
			document.getElementById("type_val").innerHTML = "VIP";

	}
	function openEdit(id) {
		document.body.style.overflow = "hidden";
		document.getElementsByClassName("modal")[0].style.display = "block";
		document.getElementById("edit_data").style.display = "block";
		$.ajax({
			url: 'b_editProf.php',         /* Куда отправить запрос */
			method: 'post',          /* Метод запроса (post или get) */
			dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
			data: { id: id, status: status },     /* Данные передаваемые в массиве */
			success: function (data) {
				$("#b_editProf").html(data);
			}
		});
	}
	function openTr() {
		document.body.style.overflow = "hidden";
		document.getElementsByClassName("modal")[0].style.display = "block";
		document.getElementById("tr_form").style.display = "block";
		// $.ajax({
		// 	url: 'b_editProf.php',         /* Куда отправить запрос */
		// 	method: 'post',          /* Метод запроса (post или get) */
		// 	dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
		// 	data: { id: id, status: status },     /* Данные передаваемые в массиве */
		// 	success: function (data) {
		// 		$("#b_editProf").html(data);
		// 	}
		// });
	}
</script>