<?php
// данные для подключения к базе данных
$server = "localhost";
$username = "root";
$password = "";
$dbName = "jobboard";
//$userID = "";
// Подключение к базе данных chat
$connect = mysqli_connect($server, $username, $password, $dbName);
/*
В случае, если кодировка сайта и базы данных не совпадает (часть текста на сайте выводится нормально, а часть текста из базы - в виде непонятных знаков). Необходимо в скрипте, который подключается к базе данных добавить команды, которые укажут MySQL серверу кодировку, в которой выводить текст. В зависимости от того, какую библиотеку PHP вы используете команды будут выглядеть так:
*/
/*
mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($connect, "SET CHARACTER SET 'utf8'");
*/
// или

// кодирвка базы данных
mysqli_set_charset($connect, 'utf8');

?>