<script src="jquery.min.js"></script>
<script src="jquery.maskedinput.js"></script>
<?php
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$query = "SELECT * FROM users where ID=".$_POST['id'];
$result = $conn->query($query);
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
while ($user = $result->fetch_assoc()) {
	echo "<input type=\"text\" class=\"textbox\" placeholder=\"ФИО\" name=\"FIO_ed\" id=\"FIO_ed\" title=\"Введите ваше ФИО\" value='". htmlspecialchars($user['LastName'] . " " . $user['FirstName'] . " " . $user['Patronymic'])."'><br>";
	echo "<span class=\"error\"><br></span>";
    echo "<input type=\"text\" class=\"textbox\" placeholder=\"Email\" name=\"Email_ed\" id=\"Email_ed\" required title=\"Введите ваш email\" value='".$user['Email']."'><br>";
	echo "<span class=\"error\"><br></span>";
    echo "<input type=\"text\" class=\"textbox\" placeholder=\"Номер телефона\" name=\"Number_ed\" id=\"Number_ed\" required title=\"Введите ваш номер телефона\" value='".$user['PhoneNumber']."'><br>";
    echo "<script>\$(\"#Number\").mask(\"+7(999)999-99-99\", { autoclear: false });</script>";
	
	echo "<input type=\"date\" class=\"textbox\" name=\"Birthdate_ed\" id=\"Birthdate_ed\" title=\"Введите вашу дату рождения\" value='".$user['Birthdate']."'><br>";
	
	echo "<button onclick=\"saveChg(".$_POST['id'].", ".$_POST['Status'].");\" class=\"button\">Сохранить</button>";
}
$result->free();
$conn->close();

     
   

