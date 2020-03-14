<?php
/*==================   Шапка Сайта   =====================*/
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <a class="navbar-brand mb-0 h1" href="/"><img src="http://doska.local/img/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">JobBoard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <?php
    if(isset($_COOKIE["user_id"])) {
    ?>
      <li class="nav-item">
            <h7 class="nav-link">==></h7>
        </li>
      <li class="nav-item active">
         <a class="nav-link" href="/profile.php">Мои доски<span class="sr-only">(current)</span></a>       
      </li>
    <?php
    }            
    ?>
    <?php
    if(isset($_GET["board"]) && !isset($_GET["delete"])) {
        $sql_boards = "SELECT * FROM boards WHERE id=" . $_GET["board"];
        $result_boards = mysqli_query($connect, $sql_boards);
        $board = mysqli_fetch_assoc($result_boards);
        ?>
        <li class="nav-item">
            <h7 class="nav-link">==></h7>
        </li>       
        <li class="nav-item active">
          <a class="nav-link" href ="http://doska.local/board.php?board=<?php echo $_GET["board"]?>"> <?php echo $board["name"];?> <span class="sr-only">(current)</span>
          </a>     
        </li>
        <?php
    }
    if (isset($_GET["board"]) &&isset($_GET["addmember"])) {
      ?>
        <li class="nav-item">
            <h7 class="nav-link">==></h7>
        </li>       
        <li class="nav-item active">
          <a class="nav-link" href="http://doska.local/options/addmember.php?board=<?php echo $_GET["board"]?>&addmember"> Список участников <span class="sr-only">(current)</span>
          </a>     
        </li>  
      <?php
    }
    ?>
    </ul>
  </div>

    <form class="form-inline my-0 my-lg-0">
        <!-- <input class="form-control mr-sm-2" type="search" placeholder="Поиск..." aria-label="Search">
        <button class="btn btn-outline-success my-0 mr-sm-2" type="submit">Найти</button> -->

        <?php
            if(isset($_COOKIE["user_id"])) {
                  // вывести всю строку по указаннму id
                  $sql_u = "SELECT * FROM users WHERE id=" . $_COOKIE["user_id"];
                  // выполняю SQL запрос
                  $result_u = mysqli_query($connect, $sql_u);
                  // записываем в переменную массив с данными пользователя 
                  $user = mysqli_fetch_assoc($result_u);
                  ?>
                  <a href="http://doska.local/exit.php" class="btn btn-outline-danger my-2 my-sm-0">
                    <?php echo $user["name"];?> &#187;</a> <!-- Выйти -->
                    <?php
              } else {
                  ?>
                  <button type="button" class="btn btn-outline-danger my-2 my-sm-0" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal">
                      Войти
                  </button> <!-- Войти -->
                  <?php
              }
        ?>

    </form>
  </div>
</nav>