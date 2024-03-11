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
			<h1>Редактировать профиль</h1>
			<a href="Cabinet.php">
				<button class="button">🠔</button>
			</a>
			<form method="POST" action="reg.php">
				<lable for="FIO">ФИО</lable>
				<input type="text" class="textbox" name="FIO" id="FIO"><br>

				<lable for="Email">Email</lable>
				<input type="text" class="textbox" name="Email" id="Email" required><br>

				<lable for="Number">Номер телефона</lable>
				<input type="text" class="textbox" name="Number" id="Number" required><br>
				<script>$("#Number").mask("+7(999)999-99-99", { autoclear: false });</script>

				<lable for="Birthdate">Дата рождения</lable>
				<input type="date" class="textbox" name="Birthdate" id="Birthdate"><br>

				<lable for="Password">Пароль</lable>
				<input type="password" class="textbox" name="Password" id="Password" required
					title="Пароль должен содержать не менее 8 символов, хотя бы по одной заглавной и строчной латинской букве"><br>

				<lable for="R_Password">Повтор пароля</lable>
				<input type="password" class="textbox" name="R_Password" id="R_Password" required
					title="Пароль должен содержать не менее 8 символов"><br>

				<button type="submit" class="button">Зарегистрироваться</button>
			</form>
			<?php
			$rows = mysqli_query($link, "SELECT * from preim_ ");
			while ($preim = mysqli_fetch_array($rows)) {

				echo "<form method='POST' action='edit_tx.php?ID=" . $preim['ID'] . "'>";
				echo "<input name=\"title\" class=\"title\" type=\"text\" value=\"" . $preim['title'] . "\"></input><br>";
				echo "<textarea name=\"text\" class=\"text\">" . $preim['text'] . "</textarea>";
				echo "<button type=\"submit\" class=\"button\">Сохранить</button>";
				echo "</form>";
			}
			?>
		</div>
	</div>
	<?php require_once('footer.php'); ?>
	</script>
</body>

</html>