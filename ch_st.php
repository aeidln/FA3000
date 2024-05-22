<?php
require_once ('conn.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Невозможно подключиться к серверу: " . $conn->connect_error);
}
if ($_POST['type_z'] == 1) {
    $stmt = $conn->prepare("UPDATE zayavki set Status= ? where ID= ?");
    $stmt->bind_param("ii", $_POST['st'], $_POST['id']);
    $stmt->execute();
    $stmt->close();
} else if ($_POST['type_z'] == 2) {
    $stmt = $conn->prepare("UPDATE reviews set Status= ? where ID= ?");
    $stmt->bind_param("ii", $_POST['st'], $_POST['id']);
    $stmt->execute();
    $stmt->close();
} else if ($_POST['type_z'] == 3) {
    $stmt = $conn->prepare("SELECT ID_user, Format, Card_type, Duration FROM club_cards WHERE ID_card = ?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $stmt->bind_result($ID_u, $format, $type_c, $duration);
    echo $type_c;
    $stmt->fetch();
    $stmt->close();
    $date_start = date('Y-m-d');
    $date_fin = date('Y-m-d', strtotime("+" . $duration . " month"));
    $status = 1;
    echo $date_fin;
    if ($type_c == 1) {
        $stmt = $conn->prepare("SELECT ID 
        FROM trainers 
        WHERE (SELECT COUNT(*) 
               FROM club_cards 
               WHERE club_cards.ID_tr = trainers.ID) <= 5 
        ORDER BY RAND() 
        LIMIT 1");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $ID_tr = $row['ID'];
        $stmt->close();
        echo $ID_tr;
    } else if ($type_c == 2) {
        $ID_tr == NULL;
    }
    $stmt = $conn->prepare("UPDATE club_cards set Date_start = ?, Date_end = ?, ID_tr = ?, Status = ? WHERE ID_card = ?");
    $stmt->bind_param("sssss", $date_start, $date_fin, $ID_tr, $status, $_POST['id']);
    $stmt->execute();
    $stmt->close();
}

