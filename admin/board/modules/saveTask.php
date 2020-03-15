<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
/*==========================================*/

 	/*=====	Отправка сообщений выбраномкпользователю ===========================*/
	// echo "<h2>Вы пытаетесь отправить коментарий!</h2>";
	// echo "<h2>";
	// echo $_POST["board_id"];
	// echo "</h2>";
	// echo "<h2>";
	// echo $_POST["card_id"];
	// echo "</h2>";
	// echo "<h2>";
	// echo $_POST["task_id"];
	// echo "</h2>";
	// echo "<h2>";
	// echo $_POST["task_status"];
	// echo "</h2>";
	// echo "<h2>";
	// echo $_POST["user_id"];
	// echo "</h2>";
	// echo "<h2>";
	// echo $_POST["taskname"];
	// echo "</h2>";
	// echo "<h2>";
	// echo $_POST["description"];
	// echo "</h2>";

/*=============== Добавление задания в карту ========================*/
if (isset($_POST["board_id"]) && isset($_POST["card_id"]) && $_POST["task_status"] =="addTask") {
    if (isset($_POST["taskname"])&&(isset($_POST["description"]))) {
        $sql_tasks = "INSERT INTO `tasks` (`card_id`, `name`, `description`) VALUES ('" . $_POST["card_id"] . "','" . $_POST["taskname"] . "', '" . $_POST["description"] . "');";
        if (mysqli_query($connect, $sql_tasks)) {
             //echo "<h2>Вы создали Задачу</h2>";
             header("Location: /admin/board/board.php?board=" . $_POST["board_id"] ."");
        }
    }
} 
if (isset($_POST["board_id"]) && isset($_POST["card_id"]) && isset($_POST["task_id"]) && $_POST["task_status"] =="editTask") {
	
    if (isset($_POST["taskname"])&&(isset($_POST["description"]))) {
        $sql_tasks = "UPDATE tasks SET name = '" . $_POST["taskname"] . "', description = '" . $_POST["description"] . "' WHERE id =" . $_POST["task_id"] . ";";
        //UPDATE `tasks` SET `name`="задача",`description`="звыжделвыадлпевн" WHERE `id` = 58
        if (mysqli_query($connect, $sql_tasks)) {
             //echo "<h2>Вы отредактировали Задачу</h2>";
             header("Location: /admin/board/board.php?board=" . $_POST["board_id"] . "");
        }
    }
}
/*=================================================================*/

/*=============== Редактирования задания  ========================*/
if (isset($_POST["board_id"]) && isset($_POST["card_id"]) && isset($_POST["task_id"]) && $_POST["task_status"] =="editTask") {
    echo "<h2>yr1ourmuxpq</h2>";
    if (isset($_POST["taskname"])&&(isset($_POST["description"]))) {
        $sql_tasks = "UPDATE tasks SET name = '" . $_POST["taskname"] . "', description = '" . $_POST["description"] . "' WHERE tasks.id =" . $_POST["task_id"] . ";";
        if (mysqli_query($connect, $sql_tasks)) {
             echo "<h2>Вы отредактировали Задачу</h2>";
             //header("Location: /board.php?board=" . $_POST["board_id"] . "");
        }
    }
}
/*=================================================================*/
?>