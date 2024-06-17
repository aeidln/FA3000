<?php
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}

if (isset($_FILES['file'])) {
    $check = can_upload($_FILES['file']);

    if ($check === true) {
        $getMime = explode('.', $_FILES['file']['name']);
        $mime = strtolower(end($getMime));
        $name = reset($getMime);
        save_to_db($conn, $name, $mime);
    } else {
        echo $check;
    }
}

// Функция проверки возможности загрузки файла
function can_upload($file)
{
    if ($file['name'] == '') {
        return 'Вы не выбрали файл';
    }

    if ($file['size'] == 0) {
        return 'Файл пустой';
    }

    $getMime = explode('.', $file['name']);
    $mime = strtolower(end($getMime));
    $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

    if (!in_array($mime, $types)) {
        return 'Недопустимый тип файла';
    }

    return true;
}

// Функция сохранения данных в базу
function save_to_db($conn, $name, $type)
{
    $stmt = $conn->prepare("INSERT INTO gallery (name, type) VALUES (?, ?)");
    if ($stmt === false) {
        die("Ошибка подготовки запроса: " . $conn->error);
    }

    $stmt->bind_param("ss", $name, $type);
    if ($stmt->execute()) {
        echo 'Файл успешно сохранен.';
    } else {
        echo "Ошибка выполнения запроса: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();// Закрытие подключения к базе данных
