<?php

$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");
echo "<script>console.log('Debug Objects: " . $_POST['id'] . "' );</script>";
$makez1 = "Update zayavki set Status=1 where ID=" . $_POST['id'];
$makez3 = "Update reviews set Status=1 where ID=" . $_POST['id'];
//заявка вп и пр -- заявка карта -- отзыв
if ($_POST['f'] == 1) {
    mysqli_query($link, $makez1);
} else if ($_POST['f'] == 2) {
    mysqli_query($link, $makez1);
} else if ($_POST['f'] == 3) {
    mysqli_query($link, $makez3);
} else if ($_POST['f'] == 4) {
    // mysqli_query($link, $makez1); 
// echo "<script>console.log(\"Hello\");</script>";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    $stmt = $conn->prepare("SELECT FIO, Number, Type_c FROM zayavki WHERE ID = ?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $stmt->bind_result($FIO_c, $number_c, $type_c);
    echo $FIO_c, $number_c, $type_c;
    $stmt->fetch();
    $stmt->close();
    $stmt = $conn->prepare("SELECT ID FROM users WHERE FIO = ? and Number = ? ");
    $stmt->bind_param("ss", $FIO_c, $number_c);
    $stmt->execute();
    $stmt->bind_result($ID_u);
    $stmt->fetch();
    $stmt->close();
    echo "<script>console.log(\"" . $ID_u . "\");</script>";

    $date_c = date('Y-m-d');
    if ($type_c == 1) {
        $stmt = $conn->prepare("SELECT id FROM trainers ORDER BY RAND() LIMIT 1");
        $stmt->bind_param("i", $ID_tr);
        $stmt->execute();
        $stmt->close();
    } else if ($type_c == 2) {
        $ID_tr == NULL;
    }
$stmt = $conn->prepare("INSERT INTO club_cards (Card_type, Date_start, ID_user, ID_tr) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $type_c, $date_c, $ID_u, $ID_tr);
if ($stmt->execute()) {
    echo "<script>console.log('Спасибо, ваша заявка отправлена!');</script>";
    // echo "<script>document.getElementsByClassName(\"modal\")[0].style.display = \"block\";document.getElementsByClassName(\"modal\")[0].innerHTML=\"МОЛОДЕЦ АДЕЛИНА\"</script>";
} else {
    echo "<script>console.log('".$stmt->error."');</script>";
}

$stmt->close();
    mysqli_query($link, $makez1); 

}
