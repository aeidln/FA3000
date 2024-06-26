<?php
session_start(); // Инициализация сессии                
// Проверка, авторизован ли пользователь
if (!isset($_SESSION['Email'])) {
	header("Location: Index.php"); // Если не авторизован, перенаправляем на страницу входа
	exit();
}

// Подключение к базе данных
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения к базе данных
if ($conn->connect_error) {
	die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
// Получение информации о пользователе из базы данных
$email = $_SESSION['Email'];
$stmt = $conn->prepare("SELECT ID FROM users WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($ID);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT u.LastName, u.FirstName, u.Patronymic, cc.Card_type FROM users u, club_cards cc WHERE cc.ID_tr=u.ID and cc.ID_user = ?");
$stmt->bind_param("s", $ID);
$stmt->execute();
$stmt->bind_result($tr_ln, $tr_fn, $tr_p, $card_type);
$stmt->fetch();
$stmt->close();
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
				<?
				if ($_SESSION['Status'] == 1)
				echo "<a href='Cabinet.php'>";
				elseif ($_SESSION['Status'] == 5)
				echo "<a href='Cabinet_tr.php'>";
				?>
					<button class="button">🠔</button>
				</a>
				<table class="shedule">
					<tr>				
						<th></th>		
					<?php
					$query_weekdays = "SELECT * FROM weekdays";
					$result_weekdays = mysqli_query($conn, $query_weekdays);
			
					if ($result_weekdays) {
						// Цикл для вывода заголовков дней недели
						while ($weekday = mysqli_fetch_assoc($result_weekdays)) {
							echo "<th>" . $weekday['WeekDay'] . "</th>";
						}
					}

					
					$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
					mysqli_select_db($link, "db") or die("А нет такой бд!");
					for ($i = 10; $i < 20; $i++) {
						echo "<tr>";
						echo "<th id='time'>" . $i . ":00</th>";
						//поменять
						$rows = mysqli_query($link, "SELECT WeekDay, TimeStart, ClassName, LastName, FirstName, Patronymic FROM sсhedule sh, users u where HOUR(TimeStart) = '$i' and sh.ID_tr=u.ID");
						$a = array_fill(0, 7, array("время" => "", "название" => "", "тренер" => ""));
						while ($r = mysqli_fetch_array($rows)) {
							$a[$r['WeekDay'] - 1]["название"] = $r['ClassName'];
							$a[$r['WeekDay'] - 1]["тренер"] = $r['LastName']." ".$r['FirstName']." ".$r['Patronymic'];
						}
						foreach ($a as $b) {
							echo "<td>";
							if ($b["название"] != null)
								echo "<div class=\"eventCard\">";
							else
								"<div>";					
							echo "<b>" . $b["название"] . "</b>";
							echo "" . $b["тренер"] . "<br>";
							echo "</div";
							echo "</td>";

						}
						echo "</tr>";
					}
					echo "</table>";


					if ($_SESSION['Status']== 1) {
						$rows = mysqli_query($link, "SELECT tt.Time_start, tt.Time_finish, w.WeekDay, tt.TypeOfDay FROM club_cards c, users u, tr_timetable tt, weekdays w where w.ID=tt.WeekDay and c.ID_tr=u.ID and ID_user=" . $ID . " and c.ID_tr=tt.ID_tr");
						if (mysqli_num_rows($rows) > 1) {
							echo "<center><h2>Расписание вашего тренера</h2>";
							echo "Ваш тренер: <b>$tr_ln $tr_fn $tr_p</b><br>";
							while ($tr_t = mysqli_fetch_array($rows)) {
								echo "<tr>";
								echo $tr_t['WeekDay']." - ";
								switch ($tr_t['TypeOfDay']) {
									case 1:
										echo "Выходной день";
										break;
									case 2:
										if ($card_type == 2) {
											echo "c <b>" . date("H:i", strtotime($tr_t['Time_start']));
											echo "</b> до <b>" . date("H:i", strtotime($tr_t['Time_finish'])) . "</b>";
										}
										else echo "<b>Для клиентов другого тарифа</b>";
										break;
									case 3:
										if ($card_type == 1) {
											echo " c <b>" . date("H:i", strtotime($tr_t['Time_start']));
											echo "</b> до <b>" . date("H:i", strtotime($tr_t['Time_finish'])) . "</b>";
										}
										else echo "<b>Для клиентов другого тарифа</b>";
										break;
								}
								echo "<br>";
							}

							echo "</center>";
						}
					}
					?>
			</div>
		</div>
		<?php require_once ('footer.php'); ?>
		</script>
	</body>

	</html>