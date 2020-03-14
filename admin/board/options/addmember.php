<?php
/*= Базовый фукционал: база данных, настройки =*/
      include "../configs/db.php";
      include "../configs/settings.php";
/*=============================================*/

/*============== Это Шапка сайта ==============*/
      include "../parts_site/site_header.php";
/*=============================================*/


if(isset($_POST["username"])){
    $sql = "SELECT id FROM `users` WHERE `email` = '" . $_POST["username"] . "'";
    $result = mysqli_query($connect, $sql);
    $amount = mysqli_num_rows($result);

    if($amount == 1){
        $user_id = mysqli_fetch_assoc($result);
        $sql = "SELECT * FROM `board_users` WHERE `board_id` = ". $_GET["board"] ." AND `user_id` = ". $user_id["id"] ."";
        $result_u = mysqli_query($connect, $sql);
        $amount_u = mysqli_num_rows($result_u);
        if($amount_u == 1){
            $sql = "UPDATE `board_users` SET `access` = '". $_POST["rights"] ."' WHERE `board_users`.`board_id` = ". $_GET["board"] ." AND `board_users`.`user_id` = ". $user_id["id"] .";";
            if(mysqli_query($connect, $sql)){
                $link = "";
                $title = "Внимание!!!";
                $message_modal = "Права выбранного пользователя были изменены.";    
                include "../parts_site/messageModal.php";
                ?>
                <script> $(document).ready(function() {
                $("#messageModal").modal('show'); 
                });
                </script>
                <?php
            }
        } else {
            if($user_id["id"] == $_COOKIE["user_id"]){
                $link = "";
                $title = "ОШИБКА!!!";
                $message_modal = "Нельзя добавить самого себя!";    
                include "../parts_site/messageModal.php";
                ?>
                <script> $(document).ready(function() {
                $("#messageModal").modal('show'); 
                });
                </script>
                <?php
            }else{
                $sql = "INSERT INTO `board_users` (`board_id`, `user_id`, `access`) VALUES ('". $_GET["board"] ."', '". $user_id["id"] ."', '". $_POST["rights"] ."');";

                if(mysqli_query($connect, $sql)){
                    $link = "";
                $title = "Поздравляем!";
                $message_modal = "Пользователь добавлен!";    
                include "../parts_site/messageModal.php";
                ?>
                <script> $(document).ready(function() {
                $("#messageModal").modal('show'); 
                });
                </script>
                <?php
                    ?>
                    <!-- <div class="alert alert-success" role="alert">Пользователь добавлен</div> -->
                    <?php
                    }
            }
        }
} else {
        ?><div class="alert alert-danger" role="alert">Пользователь не найден</div>
            <?php
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Doska</title>
</head>
<body>

    <div class="contacts-container">

        <div id = "contacts">
<!--             <form id = "search" action="http://doska.local/searchUser.php" method="POST">
                <input type="text" name="search-text">
                <button type="submit"><img src="img/search-button.png"></button>
            </form> -->
                <div class="modal-header">                
                <?php
                $sql_boards = "SELECT * FROM `boards` WHERE id=" . $_GET["board"];
                // mysqli_query - выполнить sql запрос
                // 2 параметра: 1 - подключение к БД, 2 - sqlскрипт
                $result_boards = mysqli_query($connect, $sql_boards);
                //  mysqli_num_rows - получить количество результатов
                $number_of_boards = mysqli_num_rows($result_boards);
                $board = mysqli_fetch_assoc($result_boards);
                ?>
                <label align="center">Список участников доски:
                <h4 align="center"><?php echo $board["name"] ?></h4>
                </label>
                </div>

                <div id = "list-contacts">
                <?php
                    // include - подключить файл список контактов
                    include "../modules/listContacts.php";
                ?>
                </div>       
        </div>


        <div class="row m-2">
            <form method="post">

<!--                 <div class="form-group">
                    <label for="exampleInputName1">Имя</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Введите своё имя" aria-describedby="nameHelp">
                    <small id="nameHelp" class="form-text text-muted">Ваше имя необходимо для того, что бы к Вам могли обратиться.</small>
                </div> -->

                <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                      </div>
                      <?php
                            if (isset($_GET["addmember"])&&isset($_GET["user"])) {

                            $sql_u = "SELECT * FROM `users` WHERE id=" . $_GET["user"];
                            $result_u = mysqli_query($connect, $sql_u);
                            $user = mysqli_fetch_assoc($result_u);
                            ?>
                            <input name="username" type="text" class="form-control" value="<?php echo $user["email"] ?>" aria-label="Email" aria-describedby="basic-addon1">
                            <?php

                            } else {
                                ?>
                                <input name="username" type="text" class="form-control" placeholder="email" aria-label="Email" aria-describedby="basic-addon1">
                                <?php
                            }
                      ?>
                      
                </div>

                <div class="form-group">
                    <label>Права:</label>
                    <select class="form-control" name="rights" id="">
                        <option value="1">Разработчика</option>
                        <option value="2">Тестировщика</option>
                        <option value="3">Модератора</option>
                    </select>
                    <!-- <a href="http://doska.local/board.php?board=<?php //echo $_GET["board"] ?>" type="button" class="btn btn-secondary m-2" data-dismiss="modal">Отмена</a> -->
                    <button type="submit" class="btn btn-success m-2" role="button" aria-pressed="true">Добавить / Изменить</button>
                </div>
            </form>
        </div>

    </div>


      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="../js/bootstrap.min.js"></script>
</body>
</html>
