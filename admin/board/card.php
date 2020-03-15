<?php
/* Базовый фукционал: база данных, настройки*/
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
//include "configs/settings.php";
/*==========================================*/

/*Функционал удаления досок, карточек и заданий*/
include $_SERVER['DOCUMENT_ROOT'] . "/admin/board/options/delete.php";
/*=============================================*/
?>

<div class="col-4 p-2">
    <div class="card strpied-tabled-with-hover">
        <?php
        // выбираем все данные про карточку которую мы сейчас выводим
        $sql = "SELECT * from cards WHERE id=" . $card["card_id"];
        // выполняем запрос
        $result_c = $connect->query($sql);
        // записываем в перемнную массив с данными пользователя
        $cardN = mysqli_fetch_assoc($result_c);
        ?>
        <div class="card-header border-0 rounded-0">
            <h4 class="card-title">
                <?php echo $cardN["name"]; ?>
                <?php
                if ($card["card_index"] < 2) {
                    ?>
                    <!-- Кнопка вызова модального окна Созадния задание -->
                    <a href="/admin/board/board.php?board=<?php echo $board_id?>&card=<?php echo $cardN["id"]?>&addTask" type="button" class="btn btn-primary border-0 rounded-0">Добавить задание</a>
                    <?php
                }
                ?>
            </h4>

            <div class="card-body table-full-width table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Options</th>
                    </thead>
                    <tbody>
                        <?php
                        /*========= Подкоючаемся к базе для вывод всех карточек=========*/
                        $sql_b = "SELECT * FROM `tasks` WHERE `card_id` = ". $cardN["id"] . "";
                        $result_b = $connect->query($sql_b);
                        $amount_tasks = mysqli_num_rows($result_b);
                        $loop = 0;
                        while($loop < $amount_tasks) {
                            $task = mysqli_fetch_assoc($result_b);
                            ?>
                            <tr>
                                <td><?php echo $loop+1 ?></td>
                                <td>
                                    <!-- Кнопка вызова модального окна для просмотра Задание -->
                                    <a href="/admin/board/board.php?board=<?php echo $board_id?>&card=<?php echo $cardN["id"]?>&task=<?php echo $task["id"]?>&showTask" type="button" class="btn btn-outline-primary border-0 rounded-0"><?php echo $task["name"]; ?></a>
                                </td>
                                <td>
                                    <div class="btn-group-vertical">

                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <?php
                                        // $sql = "SELECT type FROM `cards` WHERE `id` = ". $cardN["id"] . "";
                                        // $type = mysqli_fetch_assoc($connect->query($sql));
                                        // $sql = "SELECT access FROM `board_developers` WHERE `board_id` = " . $board_id . " AND `user_id` = " . $_COOKIE["user_id"] . "";

                                        // $access = mysqli_fetch_assoc($connect->query($sql));
                                        // $sql = "SELECT type_access FROM `cards` WHERE `id` = ". $cardN["id"] . "";
                                        // $type_access = mysqli_fetch_assoc($connect->query($sql));
                                        ?>

                                        <?php // кнопка НАЗАД
                                         $sql = "SELECT card_index FROM `board_cards` WHERE `board_id` = " . $board_id . " AND `card_id` = " . $cardN["id"] . "";

                                         $ind = mysqli_fetch_assoc($connect->query($sql));

                                         if($ind['card_index'] != 1){
                                          ?>
                                            <a href="/admin/board/options/back.php?board=<?php echo $board_id?>&card=<?php echo $cardN["id"]?>&moveTask=<?php echo $task["id"]; ?>" type="button" class="btn btn-outline-warning btn-sm rounded-0">Назад</a>
                                            <?php
                                         }
                                        ?>

                                        <?php // кнопка ВПЕРЁД
                                        $sql_i = "SELECT card_index FROM `board_cards` WHERE `card_id` = ". $cardN["id"] ."";
                                        $indexNow = mysqli_fetch_assoc($connect->query($sql_i));
                                        $nextIndex = $indexNow["card_index"] + 1;
                                        $sql_in = "SELECT * FROM `board_cards` WHERE `board_id` = " . $board_id . "  AND `card_index` = " . $nextIndex . "";
                                        $row_in = mysqli_num_rows($connect->query($sql_in));
                                        // $row_in = $row_in[""]
                                        if ($row_in == 1){
                                            // if($access["access"] == $type_access["type_access"] && $type["type"] != 2 || $access["access"] == 3 && $type["type"] != 2){
                                                ?>
                                                <a href="/admin/board/options/move.php?board=<?php echo $board_id?>&card=<?php echo $cardN["id"]?>&moveTask=<?php echo $task["id"]; ?>" type="button" class="btn btn-outline-success btn-sm rounded-0">Вперед</a>
                                            <?php
                                            //}
                                        }
                                        ?>

                                        </div>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        <!-- Кнопка вызоа модального окна редактирования задание -->
                                        <?php
                                        // $sql = "SELECT access FROM `board_developers` WHERE `board_id` = " . $board_id . " AND `user_id` = " . $_COOKIE["user_id"] . "";

                                        // $access = mysqli_fetch_assoc($connect->query($sql));
                                        // if($access["access"] == 3){
                                            ?>
                                            <a href="/admin/board/board.php?board=<?php echo $board_id?>&card=<?php echo $cardN["id"]?>&task=<?php echo $task["id"]?>&editTask" type="button" class="btn btn-outline-info btn-sm  rounded-0" style="max-width = 10px">Редак.</a>
                                            <!-- ============================================================== -->
                                            <!-- ============= Кнопка удаления задание ============ -->
                                            <a href="/admin/board/board.php?board=<?php echo $board_id?>&card=<?php echo $cardN["id"]?>&task=<?php echo $task["id"]?>&deleteTask" type="button" class="btn btn-outline-danger btn-sm rounded-0">Удалить</a>
                                            <!-- ================================================================== -->
                                        <?php
                                        // }
                                        ?>
                                    </div>
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
            // $sql = "SELECT access FROM `board_developers` WHERE `board_id` = ". $board_id ." AND `user_id` = ". $_COOKIE["user_id"] ."";
            // $access = mysqli_fetch_assoc($connect->query($sql));
            // if($access["access"] == 3){
                ?>
            <a href="/admin/board/board.php?board=<?php echo $board_id?>&card=<?php echo $cardN["id"]?>&delCard" type="button" class="btn btn-outline-danger btn-sm rounded-0">Удалить карточку</a>
            <?php
            //}
            ?>


        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/board/task.php";
?>
