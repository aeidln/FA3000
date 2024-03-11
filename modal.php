<script src="jquery.min.js"></script>
<script src="jquery.maskedinput.js"></script>
<div class="modal" style="display:none;">
	<span id="close" onclick="closeMod();">×</span>
	<div class="modal-cont">
		<div id="registration" style="display:none;">
			<span id="vh" onclick="contReg(0);" style="border-bottom-color: #f73a3a;">Вход</span>/<span id="reg"
				onclick="contReg(1);">Регистрация</span>
			<div class="regCont">
				<form method="POST" action="login.php">
					<input type="text" class="textbox" placeholder="Email" name="Email_v" id="Email_v" required><br>
					<input type="password" class="textbox" placeholder="Пароль" name="Password_v" id="Password_v"
						required><br>
					<button type="submit" class="button">Войти</button>
				</form>
			</div>
			<div class="regCont" style="display: none;">
				<form method="POST" action="reg.php">

					<input type="text" class="textbox" placeholder="ФИО" name="FIO" id="FIO"
						title="Введите ваше ФИО"><br>
					<span class="error"><br></span>

					<input type="text" class="textbox" placeholder="Email" name="Email" id="Email" required
						title="Введите ваш email"><br>
					<span class="error"><br></span>

					<input type="text" class="textbox" placeholder="Номер телефона" name="Number" id="Number" required
						title="Введите ваш номер телефона"><br>
					<script>$("#Number").mask("+7(999)999-99-99", { autoclear: false });</script>
					<span class="error"><br></span>


					<input type="date" class="textbox" name="Birthdate" id="Birthdate"
						title="Введите вашу дату рождения"><br>
					<span class="error"><br></span>

					<input type="password" class="textbox" placeholder="Пароль" name="Password" id="Password" required
						title="Пароль должен содержать не менее 8 символов, хотя бы по одной заглавной и строчной латинской букве"><br>
					<span class="error"><br></span>

					<input type="password" class="textbox" placeholder="Повтор пароля" name="R_Password" id="R_Password"
						required title="Пароль должен содержать не менее 8 символов"><br>
					<span class="error"><br></span>


					<p><input type="checkbox" required> Я даю согласие на обработку персональных данных в соотвествии с
						<a href="">политикой конфиденциальности.</a></p>

					<button type="submit" class="button">Зарегистрироваться</button>
				</form>
			</div>
		</div>
		<!-- <div id="reklama">
				<img id="gRek" src="Resources/rek.png">
			</div> -->
	</div>
</div>

<script>
	// const FIO_REGEXP = /^[а-яА-ЯЁё\-]+(\s[а-яА-ЯЁё\-]+)?(\s[а-яА-ЯЁё\-]+)?$/iu;
	// const fio = document.getElementById("FIO");

	// function isFullNameValid(value) {
	// return FIO_REGEXP.test(value);
	// }

	// function onFullNameInput() {
	// if (isFullNameValid(fio.value)) {
	// 	fio.style.borderColor = "#39393d";
	// } else {
	// 	fio.style.borderColor = "red";
	// 	alert('Поле ФИО должно содержать только кириллицу');
	// }
	// }
	// fio.addEventListener("blur", onFullNameInput);

	const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"а-яА-Я]+(\.[^<>()[\].,;:\s@"а-яА-Я]+)*)|(".+"))@(([^<>()[\].,;:\s@"а-яА-Я]+\.)+[^<>()[\].,;:\s@"а-яА-Я0-9]{2,})$/iu;
	const mail = document.getElementById("Email");
	function isEmailValid(value) {
		return EMAIL_REGEXP.test(value);
	}
	function onInput() {
		if (isEmailValid(mail.value)) {
			mail.style.borderColor = "#39393d";
			document.getElementsByClassName("error")[1].style.display = "none";
			document.getElementsByClassName("error")[1].innerHTML = "";
		}
		else {
			mail.style.borderColor = "red";
			document.getElementsByClassName("error")[1].style.display = "block";
			document.getElementsByClassName("error")[1].innerHTML = "Неверный ввод email"
		}
	}
	mail.addEventListener("blur", onInput);

	// const PHONE_NUMBER_REGEXP = /^\d+$/;
	// const number = document.getElementById("Number");
	// function isNumberValid(value) {
	// 	return PHONE_NUMBER_REGEXP.test(value);
	// }
	// function onNumInput() {
	// 	if (isNumberValid(number.value)) {
	// 		number.style.borderColor = "#39393d";
	// 	} 
	// 	else {
	// 		number.style.borderColor = "red";
	// 		document.getElementsByClassName("error")[2].innerHTML = 'Неверный номер телефона. Разрешены только цифры';
	// 	}
	// }
	// number.addEventListener("blur", onNumInput);

	const PASSWORD_REGEXP = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
	const password = document.getElementById("Password");
	const password_r = document.getElementById("R_Password");
	function isPasswordValid(value) {
		return PASSWORD_REGEXP.test(value);
	}
	function onPasInput() {
		if (isPasswordValid(password.value)) {
			password.style.borderColor = "#39393d";
			document.getElementsByClassName("error")[4].style.display = "none";
			document.getElementsByClassName("error")[4].innerHTML = "";
		}
		else {
			password.style.borderColor = "red"
			document.getElementsByClassName("error")[4].style.display = "block";
			document.getElementsByClassName("error")[4].innerHTML = "Неверный пароль";

		}
	}
	password.addEventListener("blur", onPasInput);
	function isPasswordEquals(value1, value2) {
		return value1 == value2;
	}
	function onPasEqual() {
		if (isPasswordEquals(password.value, password_r.value)) {
			password_r.style.borderColor = "#39393d";
			document.getElementsByClassName("error")[5].style.display = "none";
			document.getElementsByClassName("error")[5].innerHTML = "";
		}
		else {
			password_r.style.borderColor = "red";
			document.getElementsByClassName("error")[5].style.display = "block";
			document.getElementsByClassName("error")[5].innerHTML = "Пароли не совпадают";
		}
	}
	password.addEventListener("blur", onPasEqual);

	for (i = 0; i <= 5; i++) {
		if (document.getElementsByClassName("error")[5].style.display == "block") {
			alert("НЕЛЬЗЯ РЕГАТЬСЯ");
		}
	}
	// 	document.querySelector('form').addEventListener('submit', function(event) {
	//   var errors = document.querySelectorAll('.error');
	//   for (var i = 0; i < errors.length; i++) {
	//     if (window.getComputedStyle(errors[i]).display == 'block') {
	//       event.preventDefault(); // Prevent form submission
	//       alert('Please fill in all the required fields correctly.'); // Display an alert or handle the error accordingly
	//       return;
	//     }
	//   }
	// });

</script>