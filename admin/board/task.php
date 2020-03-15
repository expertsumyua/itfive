<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
//include "configs/settings.php";
/*==========================================*/
?>

<!-- Модальное окно добавления задания! -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Задание</h5>
        <a href="/board.php?board=<?php echo $board_id?>" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
        </div>

        <!-- <form method="POST"> --> <!-- action="http://doska.local/board.php?board=<?php //echo $board_id?>&create"> -->
        <form action="/admin/board/modules/saveTask.php" method="POST">
            <div class="modal-body">
                <input type="hidden" name="board_id"      value="<?php echo $board_id; ?>">
                <input type="hidden" name="card_id"       value="<?php echo $_GET["card"];  ?>">
                <input type="hidden" name="task_id"       value="<?php echo $_GET["task"];  ?>">
                <input type="hidden" name="task_status"   value="addTask">
                <input type="hidden" name="user_id"       value="<?php echo $user_id;  ?>">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Название задания</label>
                    <input name="taskname" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Введите название задания">
                  </div>

                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Описание задания</label>
                    <textarea name="description" type="text" class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Опишите задание"></textarea>
                  </div>

            </div>
            <div class="modal-footer">
            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>-->
             <a href="admin/board/board.php?board=<?php echo $board_id?>" type="button" class="btn btn-secondary">Отмена</a>
            <button type="submit" class="btn btn-primary">Сохранить задание</button>
            </div>
        </form>

    </div>
  </div>
</div>

<!-- Модальное окно отображения задания! -->
<div class="modal fade" id= "showTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Обзор задания</h5>
        <a href="/board.php?board=<?php echo $board_id?>" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
        </div>


            <div class="modal-body">
                <?php
                /*=============== Вывод задания на экран  ========================*/
                if (isset($_GET["showTask"])) {
                    $sql_tasks = "SELECT * FROM `tasks` WHERE id = " . $_GET["task"] . " AND card_id = " . $_GET["card"] ."";
                    $connect->query($sql_tasks);
                    $task = mysqli_fetch_assoc($connect->query($sql_tasks));
                    ?>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Название задания</label>
                        <input name="taskname" type="text" class="form-control" id="exampleFormControlInput1" placeholder="<?php echo $task["name"]?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Описание задания</label>
                        <textarea name="description" type="text" class="form-control" id="exampleFormControlTextarea1" rows="5" readonly><?php echo $task["description"]?></textarea>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Название задания</label>
                        <input name="taskname" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Введите название задания" readonly>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Описание задания</label>
                        <textarea name="description" type="text" class="form-control" id="exampleFormControlTextarea1" rows="5" readonly>Здесь пока нет описания задания!</textarea>
                    </div>
                    <?php
                }
                /*=================================================================*/
                ?>
                <div id="list-comments">
                    <?php 
                    // include - подключить файл список коментариев
                    include "modules/listComments.php";
                    ?>
                </div>
                  <form id = "form" action="http://doska.local/modules/sendComments.php" method="POST"><!-- action="http://doska.local/board.php?board=<?php //echo $board_id?>&create"> -->
                  <?php
                  //if (isset($_GET["task"])){
                  ?>
                      <div class="form-group">                             
                          <label for="exampleFormControlTextarea1">Коментарии</label>                          
                          <!-- <input type="hidden" name="board_id"  value="<?php //echo $board_id; ?>"> -->
                          <!-- <input type="hidden" name="card_id"   value="<?php// echo $_GET["card"];  ?>"> -->
                          <input type="hidden" name="task_id"   value="<?php echo $_GET["task"];  ?>">
                          <input type="hidden" name="user_id"   value="<?php echo $user_id;  ?>">
                          <textarea type="text" name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Оставте свои коментарии"></textarea>   
                                            
                      </div> 
                   <?php
                 // }
                  ?>

                  <div class="form-group"> 
                      <button type="submit" class="btn btn-success">Send</button>
                  </div> 
                  </form>              
            </div>
            <div class="modal-footer">
                <a href="/board.php?board=<?php echo $board_id?>" type="button" class="btn btn-secondary">Отмена</a>
              <a href="/board.php?board=<?php echo $board_id?>" type="button" class="btn btn-secondary">OK</a>
             <!--  <button type="button" class="btn btn-primary">OK</button> -->
            </div>
        

    </div>
  </div>
</div>

<!-- Модальное окно редактирования задания! -->
<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Редактор задания</h5>
        <a href="/board.php?board=<?php echo $board_id?>" type="button" class="close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
        </div>

        <form action="http://doska.local/modules/saveTask.php" method="POST"> <!-- action="http://doska.local/board.php?board=<?php //echo $board_id?>&create"> -->
            <div class="modal-body">
                <input type="hidden" name="board_id"      value="<?php echo $board_id; ?>">
                <input type="hidden" name="card_id"       value="<?php echo $_GET["card"];  ?>">
                <input type="hidden" name="task_id"       value="<?php echo $_GET["task"];  ?>">
                <input type="hidden" name="task_status"   value="editTask">
                <input type="hidden" name="user_id"       value="<?php echo $user_id;  ?>">
                <?php
                /*=============== Вывод задания на экран  ========================*/
                if (isset($_GET["editTask"])) {
                    $sql_tasks = "SELECT * FROM `tasks` WHERE id = " . $_GET["task"] . " AND card_id = " . $_GET["card"] ."";
                    $connect->query($sql_tasks);
                    $task = mysqli_fetch_assoc($connect->query($sql_tasks));
                    ?>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Название задания</label>
                        <input name="taskname" type="text" class="form-control" id="exampleFormControlInput1" value="<?php echo $task["name"]?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Описание задания</label>
                        <textarea name="description" type="text" class="form-control" id="exampleFormControlTextarea1" rows="5"><?php echo $task["description"]?></textarea>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Название задания</label>
                        <input name="taskname" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Введите название задания">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Описание задания</label>
                        <textarea name="description" type="text" class="form-control" id="exampleFormControlTextarea1" rows="5">Здесь пока нет описания задания!</textarea>
                    </div>
                    <?php
                }
                /*=================================================================*/
                ?>

            </div>
            <div class="modal-footer">
            <a href="/board.php?board=<?php echo $board_id?>" type="button" class="btn btn-secondary">Отмена</a>
            <button type="submit" class="btn btn-primary">Сохранить задание</button>
            </div>
        </form>

    </div>
  </div>
</div>


<?php
if (isset($board_id) && isset($_GET["card"]) && isset($_GET["addTask"])) {
    ?>
        <script> $(document).ready(function() {
            $("#addTaskModal").modal('show');
            });
        </script>
    <?php
} 
if (isset($board_id) && isset($_GET["card"]) && isset($_GET["editTask"])) {
    ?>
        <script> $(document).ready(function() {
            $("#editTaskModal").modal('show');
            });
        </script>
    <?php
}
if (isset($board_id) && isset($_GET["card"]) && isset($_GET["showTask"])) {
    ?>
        <script> $(document).ready(function() {
            $("#showTaskModal").modal('show'); 
            });
        </script>
    <?php
}

?>
<script src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/board/js/script.js"></script>