<?php
// данные для подключения к базе данных
 $server = "localhost";

/*"http://shop.local/"*/
$username = "root";
$password = "";
$dbName = "itfive";

// Создать соединение
// Подключение к базе данных chat
//$connect = new mysqli($server, $username, $password, $dbName);

// Создать соединение
$conn = new mysqli($server, $username, $password, $dbName);

// Проверьте подключение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/*
В случае, если кодировка сайта и базы данных не совпадает (часть текста на сайте выводится нормально, а часть текста из базы - в виде непонятных знаков). Необходимо в скрипте, который подключается к базе данных добавить команды, которые укажут MySQL серверу кодировку, в которой выводить текст. В зависимости от того, какую библиотеку PHP вы используете команды будут выглядеть так:
*/
/*
mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($connect, "SET CHARACTER SET 'utf8'");
*/
// или

// кодирвка базы данных
//mysqli_set_charset($connect, 'utf8');
mysqli_set_charset($conn, 'utf8');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="it-five container bg-white">
    <header class="it-five__header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="#"></a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="#"><span class="text-warning">IT</span>five</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="btn btn-sm btn-outline-secondary ml-2" href="#">Войти</a>
                <a class="btn btn-sm btn-outline-secondary ml-2" href="#">Выйти</a>
                <a class="btn btn-sm btn-outline-secondary ml-2" href="#">Регистацыя</a>
            </div>
        </div>
    </header>
    <hr>
    <div class="nav-scroller py-1 mb-2">
        <nav class="it-five__nav nav d-flex justify-content-center text-decoration-none">
            <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="#">Главная</a>
            <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="#">Услуги</a>
            <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="#">Заказы</a>
        </nav>
    </div>
    <hr>

<?php
    $sql = "SELECT * FROM categories";
    $result = $conn->query($sql);
    // Выводим циклом вайл по одному каждый продукт
    while ($row = mysqli_fetch_assoc($result)) {
        include 'cat_card.php';
    }
?>

</div>

<!-- footer -->
<footer class="blog-footer">
    <div class="container">
        <div class="row row-cols-3 justify-content-between">
            <a href="/" class="text-decoration-none text-left">IT <span class="text-warning">Five</span></a>
            <nav class="it-five__nav nav d-flex justify-content-around">
                <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="#">Главная</a>
                <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="#">Услуги</a>
                <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="#">Заказы</a>
            </nav>
            <p class="text-right">
                ©IT Five 2019.
            </p>
        </div>
    </div>
</footer><!-- footer -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
