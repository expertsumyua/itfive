<?php
/*= Базовый фукционал: база данных, настройки =*/
include "configs/db.php";
include "configs/settings.php";
/*=============================================*/

/*========== Это Шапка сайта ==========*/
include "parts_site/site_header.php";
/*=============================================*/

/*Функционал удаления досок, карточек и заданий*/
include "options/delete.php";
/*=============================================*/

// Создаем доску в таблице boards и добавляем связь пользователя с таблицей в board_users
if(isset($_POST["boardname"])&&$_POST["boardname"]!="") {
    $sql = "INSERT INTO `boards` (`id`, `name`, `date_time`, `creator`) VALUES (NULL, '" . $_POST["boardname"] . "', current_timestamp(), '" . $_COOKIE["user_id"] . "');";
    mysqli_query($connect, $sql);
    $sql_m = "SELECT * FROM `boards` WHERE `creator` = " . $_COOKIE["user_id"] . " ORDER BY `id` DESC";
    $boards = mysqli_fetch_assoc(mysqli_query($connect, $sql_m));
    $boards["id"];
    $sql = "INSERT INTO `board_users` (`board_id`, `user_id`, `access`) VALUES ('" . $boards["id"] . "', '" . $_COOKIE["user_id"] ."', '3');";
    mysqli_query($connect, $sql);
} else if (isset($_POST["boardname"])&&$_POST["boardname"]=="") {
    $link = "";
    $title = "Ошибка ввода";
    $message_modal = "Пожалуста введите наименование доски и повторите попытку снова!";
    include "parts_site/messageModal.php";
    ?>
    <script> $(document).ready(function() {
      $("#messageModal").modal('show');
      });
    </script>
    <?php
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Doska</title>
</head>
<body>

    <div class="container">


        <div class="row m-2">
            <div class="col-12">
                <!--Кнопка для вызова модального окна создания досок-->
                <button type="button" class="btn btn-dark my-2 my-sm-0" role="button" aria-pressed="true" data-toggle="modal" data-target="#createModal">
                  Добавить доску
                 </button>


                <!--Вывод досок в которых учавствует авторизованый пользователь-->
                <div class="container">
                    <div class="row">
                       <?php
                          // выбираем все доски где учавствует авторизоываный пользователь
                          $sql ="SELECT * FROM `board_users` WHERE `user_id` = " . $_COOKIE["user_id"] ."";
                          $result = mysqli_query($connect, $sql);
                          $amountBoard = mysqli_num_rows($result);
                          $currentLoop = 0;


                          while($currentLoop < $amountBoard){
                               $board = mysqli_fetch_assoc($result);

                        ?>
                      <div class="col-4 p-2">
                            <div class="card" style="width: 18rem;">
                            <?php
                              // выбираем все данные про доску которую мы сейчас выводим
                                $sql = "SELECT * from boards WHERE id=" . $board["board_id"];
                                // выполняем запрос
                                $boardN = mysqli_query($connect, $sql);
                                // записываем в перемнную массив с данными пользователя
                                $boardN = mysqli_fetch_assoc($boardN);
                            ?>

                              <div class="card-body">
                                <h5 class="card-title"><?php echo $boardN["name"]; ?></h5>
                                <p class="card-text"><?php echo $boardN["date_time"]; ?> </p>
                                <div class="modal-footer">
                                    <a href ="/board.php?board=<?php echo $boardN["id"] ?>" class="btn btn-primary btn-sm">Открыть доску</a>
                                    <?php
                                    $sql = "SELECT access FROM `board_users` WHERE `board_id` = ". $boardN["id"] ." AND `user_id` = ". $_COOKIE["user_id"] ."";
                                    $access = mysqli_fetch_assoc(mysqli_query($connect, $sql));
                                    if($access["access"] == 3){
                                        ?>
                                        <a href ="/profile.php?board=<?php echo $boardN["id"] ?>&delete" class="btn btn-secondary btn-sm">Удалить</a>
                                        <?php
                                    }
                                    ?>
                                </div>
                              </div>

                            </div>
                        </div>
                      <?php

                            $currentLoop = $currentLoop + 1;
                         }
                      ?>


                    </div><!--/.row -->
                </div><!--/.container -->



            </div>
        </div>


    </div><!--/.container -->



<!--Модальное окно для создания досок-->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Create Board</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form method="post">

                  <div class="modal-body">
                      <h4 class="card-title">Создание доски</h4>

                        <div class="form-group">
                          <label for="exampleInputName">Название доски:</label>
                          <input name="boardname" type="text" class="form-control" id="exampleInputName" placeholder="Введите название доски">
                        </div>
                  </div>

                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Отмена</button>
                      <button type="submit" class="btn btn-success btn-lg" role="button" aria-pressed="true">Создать</button>
                  </div>

              </form>

            </div>
          </div>
    </div>


    <?php
?>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
