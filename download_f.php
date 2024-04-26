<?php

$link = mysqli_connect("localhost", "root", "");
mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
// mysqli_select_db($link, "gallery") or die("Нет такой таблицы!");
if (isset($_FILES['file'])) {
    $check = can_upload($_FILES['file']);

    if ($check === true) {

        //make_upload($_FILES['file']);
        $getMime = explode('.', $_FILES['file']['name']);
        $mime = strtolower(end($getMime));
        $name = reset($getMime);
        save_to_db($name, $mime);
    } else {
        echo "<strong>$check</strong><br /><br />";
    }
}

function can_upload($file)
{
    if ($file['name'] == '')
        echo '<script language="javascript">' .
            'alert("Вы не выбрали файл")' .
            '</script>';

    if ($file['size'] == 0)
        return '';

    $getMime = explode('.', $file['name']);
    $mime = strtolower(end($getMime));
    $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

    if (!in_array($mime, $types))
        echo '<script language="javascript">' .
            'alert("Недопустимый тип файла")' .
            '</script>';

    return true;
}

// function make_upload($file){
//     copy($file['tmp_name'], 'large/' . $file['name']);
//     copy($file['tmp_name'], 'small/' . $file['name']);

//     $filename = $file['name'];

//     $size=GetImageSize ("small/$filename");
//     $src=ImageCreateFromJPEG ("small/$filename");
//     $iw=$size[0];
//     $ih=$size[1];
//     $koe=$iw/200;
//     $new_h=ceil ($ih/$koe);
//     $dst=ImageCreateTrueColor (200, $new_h);
//     ImageCopyResampled ($dst, $src, 0, 0, 0, 0, 200, $new_h, $iw, $ih);
//     ImageJPEG ($dst, "small/$filename", 100);
//     imagedestroy($src);
// }

function save_to_db($name, $type)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO gallery (name, type) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $type);
    if ($stmt->execute()) {
        echo '<script language="javascript">' .
            'alert("Файл успешно сохранен.")' .
            '</script>';
        header("Location: Index.php#gallery");
        exit();
    } else {
        echo "Ошибка : " . $stmt->error;
    }
    $stmt->close();

}
?>