<?php
/*= Базовый фукционал: база данных, настройки =*/
include "configs/db.php";
include "configs/settings.php";
/*=============================================*/

/*========== Это Шапка сайта ==========*/
include "parts_site/site_header.php";
/*=============================================*/

$boardindex = 0;
if (isset($_POST["cardname"])&& $_POST["cardname"]!="") {
    $sql = "INSERT INTO `cards` (`id`, `name`, `date_time`, `type_access`, `type`) VALUES (NULL, '" . $_POST["cardname"] . "', current_timestamp(), '" . $_POST["type_access"] . "', '" . $_POST["type_card"] . "');";
    mysqli_query($connect, $sql);

//    $sql = "INSERT INTO `board_cards` (`board_id`, `card_id`, `card_index`) VALUES ('" . $_GET["board"] . "', '1', '1');";

    $sql_m = "SELECT * FROM `cards` WHERE `name` = '" . $_POST["cardname"] . "' ORDER BY `id` DESC";
    $cards = mysqli_fetch_assoc(mysqli_query($connect, $sql_m));
    $cards["id"];
    $sql = "INSERT INTO `board_cards` (`board_id`, `card_id`, `card_index`) VALUES ('" . $_GET["board"] . "', '" . $cards["id"] . "', '" . $boardindex ."');";
    mysqli_query($connect, $sql);
    $sql_n = "SELECT * FROM `board_cards` WHERE board_id = " . $_GET["board"] . "";
    $amount = mysqli_num_rows(mysqli_query($connect, $sql_n));
    $sql = "UPDATE `board_cards` SET `card_index` = '" . $amount . "' WHERE `board_cards`.`board_id` = " . $_GET["board"] . " AND `board_cards`.`card_id` = " . $cards["id"] . ";";
    mysqli_query($connect, $sql);
} else if (isset($_POST["cardname"])&& $_POST["cardname"]=="") {
    $link = "";
    $title = "Ошибка ввода";
    $message_modal = "Пожалуста введите наименование карты и повторите попытку снова!";
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

<div class="container-fluid">

    <div class="row m-2">
       <?php
        // $sql = "SELECT access FROM `board_users` WHERE `board_id` = ". $_GET["board"] ." AND `user_id` = ". $_COOKIE["user_id"] ."";
        // $access = mysqli_fetch_assoc(mysqli_query($connect, $sql));
        // if($access["access"] == 3){
        ?>
            <button type="button" class="btn btn-dark my-2 my-sm-0" role="button" aria-pressed="true" data-toggle="modal" data-target="#createCardModal">
              Добавить карточку
            </button>
            <a href="options/addmember.php?board=<?php echo $_GET["board"]?>&addmember" type="button" class="btn btn-dark my-2 my-sm-0 m-2" role="button" aria-pressed="true">
            Список участников
            </a>
        <?php
        // }
        ?>
    </div>
    <div class="row m-2">
    <?php
    if (isset($_GET["board"])) {
        // выбираем все доски где учавствует авторизоываный пользователь
        $sql ="SELECT * FROM `board_cards` WHERE `board_id` = " . $_GET["board"] ."";
        $result = mysqli_query($connect, $sql);
        $amountcards = mysqli_num_rows($result);
        $currentLoop = 0;

        while($currentLoop < $amountcards){
          $card = mysqli_fetch_assoc($result);
          $boardindex = $boardindex + 1;
          include "card.php";
          $currentLoop = $currentLoop + 1;
        }
    }
    ?>
    </div>

</div>

<div class="modal fade" id="createCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Создание карточки</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST">

                <div class="modal-body">
                    <h4 class="card-title">Создание карточки</h4>

                      <div class="form-group">
                        <label for="exampleInputName">Название карточки:</label>
                        <input name="cardname" type="text" class="form-control" id="exampleInputName" placeholder="Введите название карточки">
                      </div>
                      <div class="form-group">
                        <label>Доступ к карточке:</label>
                              <select class="form-control" name="type_access" id="">
                                  <option value="1">Для разработчиков</option>
                                  <option value="2">Для тестировщиков</option>
                                  <option value="3">Для Модераторов</option>


                              </select>
                      </div>
                      <div class="form-group">
                        <label>Тип карточки:</label>
                              <select class="form-control" name="type_card" id="">
                                  <option value="1">Начальная</option>
                                  <option value="2">Конечная</option>


                              </select>
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



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>





</body>
</html>
