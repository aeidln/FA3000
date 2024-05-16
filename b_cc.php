<?// Подключение к базе данных
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
// Проверка подключения к серверу
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
// Выполнение запроса к базе данных
$query = "SELECT ID_card, Card_type, Date_start, Date_end, ID_user, ID_tr, u.FIO, Duration, Format FROM club_cards c, users u where c.ID_tr=u.ID";
$result = $conn->query($query);
// Проверка выполнения запроса
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
// Обработка результатов запроса
while ($cc = $result->fetch_assoc()) {
    echo "<tr>";
    switch ($cc['Card_type']) {
        case 1:
            echo "<td>STANDART</td>";
            break;
        case 2:
            echo "<td>VIP</td>";
            break;
        
    }
    echo "<td>" . htmlspecialchars($cc['Duration']) . " месяцев";
    echo "<td>" . htmlspecialchars($cc['Date_start']) . "</td>";
    echo "<td>" . htmlspecialchars($cc['Date_end']) . "</td>";
    echo "<td>" . htmlspecialchars($cc['Format']) . "</td>";
    echo "<td>" . htmlspecialchars($cc['FIO']) . "</td>";
    
    echo "</tr>";
}
// Освобождение ресурсов
$result->free();
// Закрытие соединения
$conn->close();