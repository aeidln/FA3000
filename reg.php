<?php
session_start(); // Инициализация сессии
$_SESSION['PROV']=false;
// Обработка формы при отправке
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    // Получение данных из формы
    $FIO = trim($_POST['FIO']); 
    $email = $_POST['Email'];
    $number = $_POST['Number'];
    $birthdate = $_POST['Birthdate'];
    $password = trim($_POST['Password']);    
    $status = 1; // Установка статуса для простого пользователя
	
	// Проверка формата даты рождения
	// $dateComponents = explode('.', $birthdate);
	// if (count($dateComponents) !== 3 || !checkdate($dateComponents[1], $dateComponents[0], $dateComponents[2])) {
    // echo "Некорректный формат даты рождения. Пожалуйста, введите дату в формате dd.mm.yyyy.";
	// }
    // elseif (empty($login) || empty($password)) {
    //     echo "Логин и пароль являются обязательными полями. Пожалуйста, заполните их.";
    // } elseif (strlen($login) < 4 || strlen($login) > 10) {
    //     echo "Длина логина должна быть от 4 до 10 символов.";
    // } elseif (strlen($password) < 6 || strlen($password) > 12) {
    //     echo "Длина пароля должна быть от 6 до 12 символов.";
    // } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     echo "Некорректный формат email.";
    // } elseif (!preg_match('/^[A-Za-z0-9]+$/', $login)) {
    //     echo "Логин может содержать только латинские буквы и цифры.";
    // } else {
        // Проверка занятости логина
        $stmt = $conn->prepare("SELECT Email FROM users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            
            echo "<script>alert('Такой логин уже зарегистрирован. Пожалуйста, выберите другой логин.');  window.location.href = 'Index.php';</script>";            
        } else {
            // Логин свободен, выполнение запроса на добавление пользователя
            $stmt = $conn->prepare("INSERT INTO users (FIO, Email, Number, Birthdate, Password, Status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssi", $FIO, $email, $number, $birthdate, $password, $status);

            if ($stmt->execute()) {
                // Регистрация успешно завершена, сохранение информации в сессии и перенаправление на страницу cabinet.php
                $_SESSION['FIO'] = $FIO;
                $_SESSION['Email'] = $email;
                $_SESSION['Number'] = $number;
                $_SESSION['Birthdate'] = $birthdate;
                $_SESSION['Password'] = $password;
                $_SESSION['PROV']=true;
                header("Location: cabinet.php");
                exit();
            } else {
                echo "Ошибка при регистрации: " . $stmt->error;
            }
            // Закрытие подготовленного запроса
            $stmt->close();
        }
    //}
    
    // Закрытие соединения с базой данных
    $conn->close();
    session_destroy();
}
?>
