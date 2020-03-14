<?php
include '../../../configs/db.php';

$sql = "DELETE FROM `orders` WHERE `customer_id` =" . $_GET['id'] ."";
$result = $connect->query($sql);
$sql = "DELETE FROM `customers` WHERE `customers`.`id` =" . $_GET['id'] ."";
$result = $connect->query($sql);

header("Location: http://itfive.local/admin/users.php");
?>
