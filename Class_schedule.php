<?php
session_start(); // Инициализация сессии                
// Проверка, авторизован ли пользователь
if (!isset($_SESSION['Email'])) {
	header("Location: Index.php"); // Если не авторизован, перенаправляем на страницу входа
	exit();
}

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения к базе данных
if ($conn->connect_error) {
	die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
// Получение информации о пользователе из базы данных
$email = $_SESSION['Email'];
$stmt = $conn->prepare("SELECT ID, FIO, Number, Birthdate,  Status FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($ID, $FIO, $Number, $birthdate, $status);
$stmt->fetch();
$stmt->close();


$stmt = $conn->prepare("SELECT u.FIO FROM users u, club_cards cc WHERE cc.ID_tr=u.ID and cc.ID_user = ?");
$stmt->bind_param("s", $ID);
$stmt->execute();
$stmt->bind_result($tr_fio);
$stmt->fetch();
$stmt->close();



$conn->close();
?>
<!DOCTYPE html>
<td>
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
				<h1>Расписание занятий</h1>
				<a href="Cabinet.php">
					<button class="button">🠔</button>
				</a>
				<table class="shedule">
					<tr>
						<th></th>
						<th>ПН</th>
						<th>ВТ</th>
						<th>СР</th>
						<th>ЧТ</th>
						<th>ПТ</th>
						<th>СБ</th>
						<th>ВС</th>
					</tr>
					<?php
					$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
					mysqli_select_db($link, "db") or die("А нет такой бд!");
					for ($i = 10; $i < 20; $i++) {
						echo "<tr>";
						echo "<th id='time'>" . $i . ":00</th>";
						$rows = mysqli_query($link, "SELECT WeekDay, TimeStart, ClassName, FIO FROM shedule sh, users u where TimeStart = '$i' and sh.Trainer=u.ID");
						$a = array_fill(0, 7, array("время" => "", "название" => "", "тренер" => ""));
						while ($r = mysqli_fetch_array($rows)) {
							$a[$r['WeekDay'] - 1]["название"] = $r['ClassName'];
							$a[$r['WeekDay'] - 1]["тренер"] = $r['FIO'];
						}
						foreach ($a as $b) {
							echo "<td>";
							if ($b["название"] != null)
								echo "<div class=\"eventCard\">";
							else
								"<div>";
							//ccskrf yf cnhfybwe uheggjdst nhtybhjdrb
					
							echo $b["название"] . "<br>";
							//ссылка на старницу тренеры
							echo $b["тренер"] . "<br>";
							echo "</div";
							echo "</td>";

						}
						echo "</tr>";
					}
					echo "</table>";
					
					
					if ($status == 1){
						$rows = mysqli_query($link, "SELECT tt.Time_start, tt.Time_finish, tt.WeekDay FROM club_cards c, users u, tr_table tt where c.ID_tr=u.ID and ID_user=" . $ID." and c.ID_tr=tt.ID_tr");
						if (mysqli_num_rows($rows) > 1) {
							echo "<h2>Расписание тренера</h2>";
							echo "Ваш тренер:".$tr_fio."<br>";
							while ($tr_t = mysqli_fetch_array($rows)) {
								
								echo "<tr>";
								switch ($tr_t['WeekDay']) {
									case 1:
										echo "Понедельник:";
										break;
									case 2:
										echo "Вторник:";
										break;
									case 3:
										echo "Среда:";
										break;
									case 4:
										echo "Четверг:";
										break;
									case 5:
										echo "Пятница:";
										break;
									case 6:
										echo "Суббота:";
										break;
									case 7:
										echo "Всокреснье:";
										break;
								}
								echo " c ".$tr_t['Time_start'];
								echo " по ".$tr_t['Time_finish'];
								echo "<br>";
							}
						}
					}
					
                    
					?>
			</div>
		</div>
		<?php require_once ('footer.php'); ?>
		</script>
	</body>

	</html>