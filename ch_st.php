<?php

$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");
$makez1 = "Update zayavki set Status=" . $_POST['st'] . " where ID=" . $_POST['id'];
$makez2 = "Update reviews set Status=" . $_POST['st'] . " where ID=" . $_POST['id'];
//заявка вп и пр -- заявка карта -- отзыв
if ($_POST['type_z'] == 1) {
    mysqli_query($link, $makez1);
} else if ($_POST['type_z'] == 2) {
    mysqli_query($link, $makez2);
} else if ($_POST['type_z'] == 3) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db";
    $conn = new mysqli($servername, $username, $password, $dbname);
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
        $stmt = $conn->prepare("SELECT ID FROM trainers ORDER BY RAND() LIMIT 1");
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
if ($stmt->execute()) {
    } else {
    echo "<script>console.log('".$stmt->error."');</script>";
    }
    $stmt->close();
}

