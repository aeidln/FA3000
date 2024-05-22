<?
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$query = "SELECT 
        u_user.fio AS user_fio, 
        u_trainer.fio AS trainer_fio,
        cc.ID_Card, 
        cc.Card_type, 
        cc.Date_start, 
        cc.Date_end, 
        cc.Duration, 
        cc.Format 
    FROM 
        club_cards cc
    JOIN 
        users u_user ON cc.ID_user = u_user.ID
    JOIN 
        users u_trainer ON cc.ID_tr = u_trainer.ID";
$result = $conn->query($query);
if (!$result) {
    die("Ошибка выполнения запроса: " . $conn->error);
}
while ($cc = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($cc['user_fio']) . "</td>";
    switch ($cc['Card_type']) {
        case 1:
            echo "<td>STANDART</td>";
            break;
        case 2:
            echo "<td>VIP</td>";
            break;
        
    }
    echo "<td>" . htmlspecialchars($cc['Duration']) . " месяцев</td>";
    echo "<td>" . htmlspecialchars($cc['Date_start']) . "</td>";
    echo "<td>" . htmlspecialchars($cc['Date_end']) . "</td>";
    echo "<td>" . htmlspecialchars($cc['Format']) . "</td>";
    echo "<td>" . htmlspecialchars($cc['trainer_fio']) . "</td>;";
    echo "</tr>";
}
$result->free();
$conn->close();