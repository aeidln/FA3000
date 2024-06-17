<?
require_once('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
$query = "SELECT 
        u_user.LastName AS user_ln, 
        u_user.FirstName AS user_fn, 
        u_user.Patronymic AS user_p, 
        u_trainer.LastName AS trainer_ln, 
        u_trainer.FirstName AS trainer_fn, 
        u_trainer.Patronymic AS trainer_p, 
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
    echo "<td>" . htmlspecialchars($cc['user_ln'] . " " . $cc['user_fn'] . " " . $cc['user_p']) . "</td>";
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
    echo "<td>" . htmlspecialchars($cc['trainer_ln'] . " " . $cc['trainer_fn'] . " " . $cc['trainer_p']) . "</td>";
    echo "</tr>";
}
$result->free();
$conn->close();