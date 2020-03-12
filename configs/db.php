<?php


//параметры подключения к базе даных
$server = "localhost";
$username = "root";
$password = "";
$dbname = "itfive";

//подключение к базе даных chat
$connect = new mysqli($server, $username, $password, $dbname);

//проверка на подключение к базе даных
if ($connect->connect_errno) {
    printf("Соединение не удалось: %s\n", $connect->connect_error);
    exit();

}

// кодировка базы даных
$connect->set_charset('utf8');

