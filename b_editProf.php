<?php
$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("А нет такой бд!");
$query = "SELECT * FROM users where ID=".$_POST['id'];
$rows = mysqli_query($link, $query);
while ($user = mysqli_fetch_array($rows)) {
     
    echo "<input type=\"text\" class=\"textbox\" placeholder=\"ФИО\" name=\"FIO_ed\" id=\"FIO_ed\" title=\"Введите ваше ФИО\" value='".$user['FIO']."'><br>";
	echo "<span class=\"error\"><br></span>";
    echo "<input type=\"text\" class=\"textbox\" placeholder=\"Email\" name=\"Email_ed\" id=\"Email_ed\" required title=\"Введите ваш email\" value='".$user['Email']."'><br>";
	echo "<span class=\"error\"><br></span>";
    echo "<input type=\"text\" class=\"textbox\" placeholder=\"Номер телефона\" name=\"Number_ed\" id=\"Number_ed\" required title=\"Введите ваш номер телефона\" value='".$user['Number']."'><br>";
    echo "<script>$(\"#Number\").mask(\"+7(999)999-99-99\", { autoclear: false });</script>";
	echo "<span class=\"error\"><br></span>";
	echo "<input type=\"date\" class=\"textbox\" name=\"Birthdate_ed\" id=\"Birthdate_ed\" title=\"Введите вашу дату рождения\" value='".$user['Birthdate']."'><br>";
	echo "<span class=\"error\"><br></span>";
	echo "<button onclick=\"saveChg(".$_POST['id'].", ".$_POST['Status'].");\" class=\"button\">Сохранить</button>";
}
