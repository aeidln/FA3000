<!DOCTYPE html>
<html lang="ru">

<head>
    <title>ФИТНЕС-АРЕНА 3000</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="3000_стили.css" type="text/css">
    <link rel="shortcut icon" href="Resources/icon.ico" type="image/png">
</head>

<body>
    <?php require_once('header.php'); ?>
    <div class="container">
        <div class="block">
        <a href="Index.php">Главная</a>/<a>Отзывы</a><br>
            <h1>Отзывы</h1>
            <fieldset id="add_rev">
                <legend>
                    <h2>Ваш отзыв</h2>
                </legend>
                <form id="revF">
                    <p>Ваша оценка</p>
                    <div class="rating-area">
                        <input type="radio" id="star-5" name="rating" value="5" required>
                        <label for="star-5" title="Оценка «5»"></label>
                        <input type="radio" id="star-4" name="rating" value="4">
                        <label for="star-4" title="Оценка «4»"></label>
                        <input type="radio" id="star-3" name="rating" value="3">
                        <label for="star-3" title="Оценка «3»"></label>
                        <input type="radio" id="star-2" name="rating" value="2">
                        <label for="star-2" title="Оценка «2»"></label>
                        <input type="radio" id="star-1" name="rating" value="1">
                        <label for="star-1" title="Оценка «1»"></label>
                    </div>
                    <p>Комментарий</p>
                    <textarea placeholder="Введите комментарий" name="comment" id="textarea" required></textarea> <br>
                    <button type="submit" class="button">Отправить отзыв</button>
                </form>
            </fieldset>
            <div class="rev_pan">
                <div class="revs">
                    <?php
                    $month_list = array(
                        1 => 'января',
                        2 => 'февраля',
                        3 => 'марта',
                        4 => 'апреля',
                        5 => 'мая',
                        6 => 'июня',
                        7 => 'июля',
                        8 => 'августа',
                        9 => 'сентября',
                        10 => 'октября',
                        11 => 'ноября',
                        12 => 'декабря'
                    );
                    $link = mysqli_connect("localhost", "root", "") or die("Невозможно подключиться к серверу");
                    mysqli_select_db($link, "db") or die("А нет такой бд!");

                    $rows = mysqli_query($link, "SELECT LastName, FirstName,  Day(Date) ,Month(Date) ,Year(Date), Mark, Comment FROM reviews r, users u WHERE r.ID_user=u.ID and r.status=1 ");
                    while ($r = mysqli_fetch_array($rows)) {
                        echo "<div class=\"rev\">";
                        echo "<div class=\"rev_top\">";
                        echo "<div>";
                        echo "" . $r['Day(Date)'] . ' ' . $month_list[$r['Month(Date)']] . ' ' . $r['Year(Date)'] . " года";
                        echo "<p>" . $r['LastName']." ". $r['FirstName'] . "</p>";
                        echo "</div>";                        
                        echo "<div class=\"rating-mini\">";
                        for ($i=1; $i<=5; $i++){
                            echo "<span class='";
                            if ($r['Mark'] >= $i)
                            echo 'active'; 
                            echo "'></span>";
                        }                           
                    echo "</div>
                    </div>";                
                    echo $r['Comment'] . "<br>";
                    echo "</div>";
                    $k++;
                    }
                    ?>
            </div>
            <div>
                <div class="o_rate">
                    Общая оценка
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "db";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    // Проверка подключения к базе данных
                    if ($conn->connect_error) {
                        die("Ошибка подключения к базе данных: " . $conn->connect_error);
                    }
                    $stmt = $conn->prepare("SELECT round(avg(Mark),1) FROM reviews group by status=0");
                    $stmt->execute();
                    $stmt->bind_result($Avg);
                    $stmt->fetch();
                    echo "<p>" . $Avg . "</p>"
                        ?>
                </div>
                
                <button id="add_rBTN" class="button" onclick="openAddR();">Добавить отзыв</button>
                <?php
                session_start();
                if (!isset($_SESSION['Email']) || $_SESSION['Status']!=1) {
                    echo "<script> document.getElementById(\"add_rBTN\").disabled = true; </script>";    
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    <?php require_once('footer.php'); ?>
</body>
</html>
<script>
    document.getElementById('revF').addEventListener('submit', function (event) {
		event.preventDefault();
		rating = document.querySelector("[name='rating']").value;
		comment = document.querySelector("[name='comment']").value;
		$.ajax({
			url: 'rev.php',
			method: 'post',
			async: false,
			data: { rating: rating, comment: comment },
			success: function (response) {
				if (response==1){
                    alert('Спасибо, ваш отзыв отправлен! Ожидайте подтверждения');
                     window.location.href = 'Cabinet.php';
				}
			}
		});
	});
</script>