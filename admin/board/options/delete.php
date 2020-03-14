<?php
/*==================== Удаление задания  ============================*/
if (isset($_GET["deleteTask"])) {
    //Удаляем сначала все коментарии в задани
    $sql_comments = "DELETE FROM `comments` WHERE task_id = " . $_GET["task"] ."";
    // Когда все коментарии удалены, то
    if (mysqli_query($connect, $sql_comments)) {
        // Кдалаем все задания
        $sql_tasks = "DELETE FROM `tasks` WHERE id = " . $_GET["task"] . " AND card_id = " . $_GET["card"] ."";
        if (mysqli_query($connect, $sql_tasks)) {
            //echo "<h2>Вы создали Задачу</h2>";
            header("Location: /board.php?board=" . $_GET["board"] ."");
            //echo "<h2>Вы собираетесь удалить Задачу?</h2>";
        }
    }    
}
/*=================================================================*/

/*=================== Удаление карточек ===========================*/
if (isset($_GET["delCard"])) {
    $sql_tasks = "SELECT * FROM `tasks` WHERE card_id = " . $_GET["card"] ."";
    $result_tasks = mysqli_query($connect, $sql_tasks);
    $number_of_tasks = mysqli_num_rows($result_tasks);
    $i = 0;
    while ($i < $number_of_tasks) {
        $task = mysqli_fetch_assoc($result_tasks);

        //Удаляем сначала все коментарии в задани
        $sql_comments = "DELETE FROM `comments` WHERE task_id = " . $task["id"] ."";
        // Когда все коментарии удалены, то
        if (mysqli_query($connect, $sql_comments)) {
            // Кдалаем все задания
            $sql_tasks = "DELETE FROM `tasks` WHERE id = " . $task["id"] . " AND card_id = " . $_GET["card"] ."";
            mysqli_query($connect, $sql_tasks);            
        }
        $i++;
    }
    if (mysqli_query($connect, $sql_tasks)) {
        $sql_cards = "DELETE FROM `cards` WHERE id = " . $_GET["card"] ."";
        if (mysqli_query($connect, $sql_cards)) {
            
            $sql_board_cards = "DELETE FROM `board_cards` WHERE card_id = " . $_GET["card"] ."";
            mysqli_query($connect, $sql_board_cards);  
        }
    }
    if (mysqli_query($connect, $sql_board_cards)){
        $sql_board_c = "SELECT * FROM board_cards WHERE board_id = " . $_GET["board"] . "";
        $result_board_c= mysqli_query($connect, $sql_board_c);
        $number_of_board_c= mysqli_num_rows($result_board_c);
        $i = 0;
        while ($i < $number_of_board_c) {
            $card_id = mysqli_fetch_assoc($result_board_c);
            $i++;
            $sql_board_c= "UPDATE `board_cards` SET card_index = " . $i . " WHERE board_id = ". $_GET["board"] . " AND card_id = " . $card_id["card_id"] ."";
            mysqli_query($connect, $sql_board_c);
        }        
        //mysqli_query($connect, $sql_board_c);
        if (mysqli_query($connect, $sql_board_c)){
            //echo "<h2>Вы создали Задачу</h2>";
            header("Location: /board.php?board=" . $_GET["board"] ."");
        }   
    }
}
/*=================================================================*/

/*=================== Удаление досок ===========================*/
if (isset($_GET["board"]) && isset($_GET["delete"])) {
    //echo "<h2>Вы собираетесь удалить ДОСКУ?</h2>";
    $sql_board_cards = "SELECT * FROM `board_cards` WHERE board_id = " . $_GET["board"] ."";
    $result_board_cards = mysqli_query($connect, $sql_board_cards);
    $number_of_board_cards = mysqli_num_rows($result_board_cards);
    $j = 0;
    while ($j < $number_of_board_cards) {
        $card = mysqli_fetch_assoc($result_board_cards);
        $sql_tasks = "SELECT * FROM `tasks` WHERE card_id = " . $card["card_id"] ."";
        $result_tasks = mysqli_query($connect, $sql_tasks);
        $number_of_tasks = mysqli_num_rows($result_tasks);
        $i = 0;
        while ($i < $number_of_tasks) {
            $task = mysqli_fetch_assoc($result_tasks);

            //Удаляем сначала все коментарии в задани
            $sql_comments = "DELETE FROM `comments` WHERE task_id = " . $task["id"] ."";
            // Когда все коментарии удалены, то
            if (mysqli_query($connect, $sql_comments)) {
                // Кдалаем все задания
                $sql_tasks = "DELETE FROM `tasks` WHERE id = " . $task["id"] . " AND card_id = " .$card["card_id"] ."";
                mysqli_query($connect, $sql_tasks);
            }
            $i++;
        }
        if (mysqli_query($connect, $sql_tasks)) {
            $sql_cards = "DELETE FROM `cards` WHERE id = " . $card["card_id"] ."";
            if (mysqli_query($connect, $sql_cards)) {
                $sql_board_cards = "DELETE FROM `board_cards` WHERE card_id = " . $card["card_id"] ."";
                mysqli_query($connect, $sql_board_cards);
                //echo "<h2>Вы удалили карту?</h2>";
            }
        }
        $j++;
    }
    if (mysqli_query($connect, $sql_board_cards)) {
        $sql_boards = "DELETE FROM `boards` WHERE id = " . $_GET["board"] ."";
        if (mysqli_query($connect, $sql_boards)) {
            $sql_board_users = "DELETE FROM `board_users` WHERE board_id = " . $_GET["board"]  ."";
                if(mysqli_query($connect, $sql_board_users)) {
                    header("Location: /profile.php");
                }            
        }
    }
}
/*=================================================================*/


?>