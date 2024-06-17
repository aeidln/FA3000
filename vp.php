<?
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
$fullName = $_POST['FIO_vp'];
// Разбиваем строку на три части
$nameParts = explode(" ", $fullName);
list($LastName_vp, $FirstName_vp, $Patronymic_vp) = $nameParts;
$number_vp = $_POST['Number_vp'];
$status_vp = 0;
$date_vp = date('Y-m-d');
$type="vp";
$stmt = $conn->prepare("INSERT INTO `requests` (`LastName`, `FirstName`, `Patronymic`, `PhoneNumber`, `Type`, `Status`, `Date`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $LastName_vp, $FirstName_vp, $Patronymic_vp, $number_vp, $type, $status_vp, $date_vp);
if ($stmt->execute()) {
    echo 1;            
}
$stmt->close();
$conn->close();
