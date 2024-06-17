<?php
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Инициализация базовой строки запроса
$z = "UPDATE tr_timetable SET";
$param_type = '';
$params = [];

// Определение, какое поле нужно обновить, и добавление значения в массив параметров
if ($_POST['f'] == 1) {
    $z .= " Time_start = ?";
    $param_type .= 's';
    $params[] = $_POST['val'];
} elseif ($_POST['f'] == 2) {
    $z .= " Finish = ?";
    $param_type .= 's';
    $params[] = $_POST['val'];
} elseif ($_POST['f'] == 3) {
    $z .= " TypeOfDay = '1";
} elseif ($_POST['f'] == 4) {
    $z .= " TypeOfDay = '2";
} elseif ($_POST['f'] == 5) {
    $z .= " TypeOfDay = '3";
}

$z .= "' WHERE ID_tr = ? AND WeekDay = ?";
$param_type .= 'ss';
$params[] = $_POST['id'];
$params[] = $_POST['wd'];

// Подготовка и выполнение запроса с использованием подготовленных выражений
$stmt = $conn->prepare($z);

// Привязка параметров
$stmt->bind_param($param_type, ...$params);

// Выполнение запроса
$stmt->execute();

// Проверка результата выполнения
if ($stmt->affected_rows > 0) {
    echo "Запись успешно обновлена.";
} else {
    echo "Ошибка обновления записи.";
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>