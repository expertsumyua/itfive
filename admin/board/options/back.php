<?php
include "../configs/db.php";
$sql = "SELECT card_id FROM `board_cards` WHERE `board_id` = ". $_GET["board"] ." AND `card_index` = 1";
$newCard = mysqli_fetch_assoc(mysqli_query($connect, $sql));
$new = $newCard["card_id"];
$sql = "UPDATE `tasks` SET `card_id` = '". $new ."' WHERE `tasks`.`id` = ". $_GET["moveTask"] .";";
if(mysqli_query($connect, $sql)){
    header("Location: http://doska.local/board.php?board=". $_GET["board"] ."");
}
?>
