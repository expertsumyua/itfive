<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

$sql = "DELETE FROM `orders` WHERE `customer_id` =" . $_GET['id'] ."";
$result = $connect->query($sql);
$sql = "DELETE FROM `customers` WHERE `customers`.`id` =" . $_GET['id'] ."";
$result = $connect->query($sql);

setcookie("customers_id", '', 0, "/");
setcookie("status", '', 0, "/");
setcookie("basket", '', 0, "/");
header('Location: /');

?>
