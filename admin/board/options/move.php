<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
$sql = "SELECT card_index FROM `board_cards` WHERE `card_id` = ". $_GET["card"] ."";
$index = mysqli_fetch_assoc(mysqli_query($connect, $sql));
$newindex = $index["card_index"]+1;
$sql = "SELECT card_id FROM `board_cards` WHERE `board_id` = ". $_GET["board"] ." AND `card_index` = ". $newindex ."";
$newCard = mysqli_fetch_assoc(mysqli_query($connect, $sql));
$new = $newCard["card_id"];
$sql = "UPDATE `tasks` SET `card_id` = '". $new ."' WHERE `tasks`.`id` = ". $_GET["moveTask"] .";";
if(mysqli_query($connect, $sql)){
    header("Location: http://itfive.local/admin/board/board.php?board=". $_GET["board"] ."");
}
?>
