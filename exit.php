
<?php
// Инициализация сессии
session_start();

// Уничтожение всех данных сессии
session_destroy();
echo "<script>
window.sessionStorage.clear();
window.sessionStorage.removeItem('pan_btn');
console.log(window.sessionStorage.getItem('pan_btn'));
</script>";

// Перенаправление на страницу входа
header("Location: Index.php");
?>
