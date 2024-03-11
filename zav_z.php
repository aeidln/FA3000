<?php

$link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
mysqli_select_db($link, "db") or die("Ошибка подключения к базе данных");
echo "<script>console.log('Debug Objects: " . $_POST['id'] . "' );</script>";
$makez1 = "Update zayavki set Status=1 where ID=" . $_POST['id'];
$makez3 = "Update reviews set Status=1 where ID=" . $_POST['id'];
//заявка вп и пр -- заявка карта -- отзыв
if ($_POST['f'] == 1){
    mysqli_query($link, $makez1);
}
else if ($_POST['f'] == 2){
    mysqli_query($link, $makez1);   
}
else if ($_POST['f'] == 3){
    mysqli_query($link, $makez3);   
}
else if ($_POST['f'] == 4){
    mysqli_query($link, $makez1); 
    // $makez4="INSERT INTO club_cards (FIO, Number, Type, Status, Date) VALUES (";
    // $makez = "INSERT INTO club_cards (Card_type, Date_start, ID_user, ID_tr) VALUES (\'".$_GET['Type_c']."','".."','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')";
    // echo $_GET['Type_c'];
}
// // header('Location: admin.php');
