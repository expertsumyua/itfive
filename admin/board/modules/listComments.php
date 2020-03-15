<ul>

    <?php
        //    Если в запросе есть выбраный пользователь
        if (isset($_GET["task"]) || isset($task_id)){
            $user_toWhom = null;
            if(isset($_GET["task"])) {
                $taskID = $_GET["task"];
            } else {
                $taskID = $task_id;
            }
            // получаем все сообщения которые были отправлены пользователю
            $sql_comments = "SELECT * FROM board_comments WHERE `task_id` =" . $taskID ."";
            $result_comments = $connect->query($sql_comments);
            // mysqli_fetch_assoc - преобразовывает полученные данные
            //(результирующй ряд или строку из таблицы) пользователя в массив
            $number_of_comments = mysqli_num_rows($result_comments);
            $i = 0;
            while ($i < $number_of_comments) {
                    $comment = mysqli_fetch_assoc($result_comments);
    ?>
                        <li>
    <?php
                            // вывести всю строку по указаннму id
                            $sql_users = "SELECT * FROM customers WHERE id=" . $comment["developer_id"];
                            // выполняю SQL запрос
                            $result_users = $connect->query($sql_users);
                            // записываем в переменную массив с данными пользователя
                            $user = mysqli_fetch_assoc($result_users);
    ?>
                            <div class = "avatar" >
                                <img src= "../../../assets/img/user_icon4.png" style="width: 50px;">
                            </div>
                            <h4><?php echo $user["first_name"]; ?></h4>
                            <p><?php echo  $comment["comment"]; ?></p>
                            <div class ="time"><?php echo $comment["date_time"]; ?></div>

                        </li>
    <?php
                    $i++;
            }
        }

    ?>

</ul>
