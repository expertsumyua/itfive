<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

	$sql = "UPDATE orders SET status = 1 WHERE orders . id =" . $_POST['id'];
	mysqli_query($connect, $sql);

	