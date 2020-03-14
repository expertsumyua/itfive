<?php
/* Базовый фукционал: база данных, настройки*/
include "configs/db.php";
//include "configs/settings.php";
/*==========================================*/

/*Функционал удаления досок, карточек и заданий*/
include "options/delete.php";
/*=============================================*/
?>

<div class="col-3 p-2">
    <div class="card strpied-tabled-with-hover">
        <?php
        // выбираем все данные про карточку которую мы сейчас выводим
        $sql = "SELECT * from cards WHERE id=" . $card["card_id"];
        // выполняем запрос
        $cardN = mysqli_query($connect, $sql);
        // записываем в перемнную массив с данными пользователя
        $cardN = mysqli_fetch_assoc($cardN);
        ?>
        <div class="card-header ">
            <h4 class="card-title">
                <?php echo $cardN["name"]; ?>
                <?php
                if ($card["card_index"] < 2) {
                    ?>
                    <!-- Кнопка вызова модального окна Созадния задание -->
                    <a href="/board.php?board=<?php echo $_GET["board"]?>&card=<?php echo $cardN["id"]?>&addTask" type="button" class="btn btn-primary">Добавить задание</a>
                    <?php
                }
                ?>
            </h4>

            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                    </thead>
                    <tbody>
                        <?php
                        /*========= Подкоючаемся к базе для вывод всех карточек=========*/
                        $sql_b = "SELECT * FROM `tasks` WHERE `card_id` = ". $cardN["id"] . "";
                        $result_b = mysqli_query($connect, $sql_b);
                        $amount_tasks = mysqli_num_rows($result_b);
                        $loop = 0;
                        while($loop < $amount_tasks) {
                            $task = mysqli_fetch_assoc($result_b);
                            ?>
                            <tr>
                                <td><?php echo $loop+1 ?></td>
                                <td>
                                    <!-- Кнопка вызова модального окна для просмотра Задание -->
                                    <a href="/board.php?board=<?php echo $_GET["board"]?>&card=<?php echo $cardN["id"]?>&task=<?php echo $task["id"]?>&showTask" type="button" class="btn btn-primary btn-sm"><?php echo $task["name"]; ?></a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <?php
                                        $sql = "SELECT type FROM `cards` WHERE `id` = ". $cardN["id"] . "";
                                        $type = mysqli_fetch_assoc(mysqli_query($connect, $sql));
                                        $sql = "SELECT access FROM `board_users` WHERE `board_id` = " . $_GET["board"] . " AND `user_id` = " . $_COOKIE["user_id"] . "";

                                        $access = mysqli_fetch_assoc(mysqli_query($connect, $sql));
                                        $sql = "SELECT type_access FROM `cards` WHERE `id` = ". $cardN["id"] . "";
                                        $type_access = mysqli_fetch_assoc(mysqli_query($connect, $sql));
                                        $sql_i = "SELECT card_index FROM `board_cards` WHERE `card_id` = ". $cardN["id"] ."";
                                        $indexNow = mysqli_fetch_assoc(mysqli_query($connect, $sql_i));
                                        $nextIndex = $indexNow["card_index"] + 1;
                                        $sql_in = "SELECT * FROM `board_cards` WHERE `board_id` = " . $_GET["board"] . "  AND `card_index` = " . $nextIndex . "";
                                        $row_in = mysqli_num_rows(mysqli_query($connect, $sql_in));
                                        // $row_in = $row_in[""]
                                        if ($row_in == 1){
                                            if($access["access"] == $type_access["type_access"] && $type["type"] != 2 || $access["access"] == 3 && $type["type"] != 2){
                                                ?>
                                                <a href="options/move.php?board=<?php echo $_GET["board"]?>&card=<?php echo $cardN["id"]?>&moveTask=<?php echo $task["id"]; ?>" type="button" class="btn btn-secondary btn-sm">Move</a>
                                            <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        $sql = "SELECT access FROM `board_users` WHERE `board_id` = " . $_GET["board"] . " AND `user_id` = " . $_COOKIE["user_id"] . "";

                                        $access = mysqli_fetch_assoc(mysqli_query($connect, $sql));
                                        $sql = "SELECT type_access FROM `cards` WHERE `id` = ". $cardN["id"] . "";
                                        $type_access = mysqli_fetch_assoc(mysqli_query($connect, $sql));
                                        if($access["access"] == $type_access["type_access"] && $type_access["type_access"] == 2 ||$access["access"] == 3 && $type_access["type_access"] == 2){
                                          ?>
                                            <a href="options/back.php?board=<?php echo $_GET["board"]?>&card=<?php echo $cardN["id"]?>&moveTask=<?php echo $task["id"]; ?>" type="button" class="btn btn-secondary btn-sm">Back</a>
                                            <?php
                                        }
                                        ?>
                                        <!-- Кнопка вызоа модального окна редактирования задание -->
                                        <?php
                                        $sql = "SELECT access FROM `board_users` WHERE `board_id` = " . $_GET["board"] . " AND `user_id` = " . $_COOKIE["user_id"] . "";

                                        $access = mysqli_fetch_assoc(mysqli_query($connect, $sql));
                                        if($access["access"] == 3){
                                            ?>
                                            <a href="/board.php?board=<?php echo $_GET["board"]?>&card=<?php echo $cardN["id"]?>&task=<?php echo $task["id"]?>&editTask" type="button" class="btn btn-secondary btn-sm">Edit</a>
                                            <!-- ============================================================== -->
                                            <!-- ============= Кнопка удаления задание ============ -->
                                            <a href="/board.php?board=<?php echo $_GET["board"]?>&card=<?php echo $cardN["id"]?>&task=<?php echo $task["id"]?>&deleteTask" type="button" class="btn btn-secondary btn-sm">Delete</a>
                                            <!-- ================================================================== -->
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            $loop = $loop + 1;
                        }
                        ?>

                    </tbody>


                </table>

            </div>
            <?php
            $sql = "SELECT access FROM `board_users` WHERE `board_id` = ". $_GET["board"] ." AND `user_id` = ". $_COOKIE["user_id"] ."";
            $access = mysqli_fetch_assoc(mysqli_query($connect, $sql));
            if($access["access"] == 3){
                ?>
            <a href="/board.php?board=<?php echo $_GET["board"]?>&card=<?php echo $cardN["id"]?>&delCard" type="button" class="btn btn-secondary btn-sm">Удалить карточку</a>
            <?php
            }
            ?>


        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php
include "task.php";
?>
