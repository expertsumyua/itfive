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
            $sql_comments = "SELECT * FROM comments WHERE `task_id` =" . $taskID ."";
            $result_comments = mysqli_query($connect, $sql_comments);
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
                            $sql_users = "SELECT * FROM users WHERE id=" . $comment["user_id"];
                            // выполняю SQL запрос
                            $result_users = mysqli_query($connect, $sql_users);
                            // записываем в переменную массив с данными пользователя
                            $user = mysqli_fetch_assoc($result_users);
    ?>
                            <div class = "avatar" >
                                <img src= "<?php echo $user["photo"]; ?>" >
                            </div>
                            <h4><?php echo $user["name"]; ?></h4>
                            <p><?php echo  $comment["comment"]; ?></p>
                            <div class ="time"><?php echo $comment["date_time"]; ?></div>

                        </li>
    <?php
                    $i++;
            }
        }

    ?>

</ul>
