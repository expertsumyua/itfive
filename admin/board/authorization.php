<?php
/*==================   Окно  АВТОРИЗАЦИИ  =====================*/

if(isset($_POST["email_a"]) && isset($_POST["password_a"])
  && $_POST["email_a"] != "Введите свой Email" && $_POST["password_a"] != "Введите пароль") {

    $sql_a = "SELECT * FROM users WHERE `email` LIKE '" . $_POST["email_a"] . "' AND `password` LIKE '" . $_POST["password_a"] ."'";

    $result_a = mysqli_query($connect, $sql_a);
    //var_dump($result);
    $number_of_users = mysqli_num_rows($result_a);
    if($number_of_users == 1) {
      $user = mysqli_fetch_assoc($result_a);
      setcookie("user_id", $user["id"], time() +60*60*24*30);

      header("Location: /profile.php");
      //echo "<h2>Вы вошли в систему</h2>";

    } else {
      //echo "<h2>Логин и пароль введены не верно</h2>" . mysqli_error($connect);
      $link = "";
      $title = "Ошибка авторизации";
      $message_modal = "Email адрес и пароль введены не верно!";          
      include "parts_site/messageModal.php";
      ?>
      <script> $(document).ready(function() {
        $("#messageModal").modal('show'); 
        });
      </script>
      <?php
    }    
}
/*==================   Окно  АВТОРИЗАЦИИ  =====================*/

?>

<!---------- Модальное окно для авторизации --------------------------------------------------->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Авторизация</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form method="POST">

              <div class="modal-body">
                  <h4 class="card-title">Авторизуйтесь пожалуйста</h4>
                 
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email адрес</label>
                      <input type="email" name="email_a" class="form-control" id="exampleInputEmail1" placeholder="Введите свой Email" aria-describedby="emailHelp">
                      <small id="emailHelp" class="form-text text-muted">Мы никогда не передадим вашу электронную почту кому-либо еще.</small>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Пароль</label>
                      <input type="password" name="password_a" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
                    </div>                  

              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Отмена</button>
                  <a href="registration.php" class="btn btn-outline-secondary btn-lg" role="button" aria-pressed="true">Регистрация</a>
                  <button type="submit" class="btn btn-success btn-lg" role="button" aria-pressed="true">Авторизоваться</button>
              </div>

          </form>    

        </div>
      </div>
</div>
<!---------- Модальное окно для авторизации --------------------------------------------------->