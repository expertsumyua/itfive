<?php
      include "./configs/db.php";

    /*==== Это Шапка сайта, в ней находится
      так жеи АВТОРИЗАЦИЯ ================*/
      include "parts_site/site_header.php";
      include "authorization.php";
    /*====================================*/ 


    if(isset($_POST["email"]) && isset($_POST["password"])
      && $_POST["email"] != "Введите свой Email" && $_POST["password"] != "Введите пароль") {

      $sql_r = "INSERT INTO users (email, password, name, photo) VALUES ('" . $_POST["email"] . "', '" . $_POST["password"] ."','" .$_POST["name"]. "', 'img/user.png')";
      if(mysqli_query($connect, $sql_r)) {
        //echo "<h2>Пользователь добавлен!</h2>";
        $sql_a = "SELECT * FROM users WHERE `email` LIKE '" . $_POST["email"] . "' AND `password` LIKE '" . $_POST["password"] ."'";

        $result_a = mysqli_query($connect, $sql_a);
        //var_dump($result);
        $number_of_users = mysqli_num_rows($result_a);
        if($number_of_users == 1) {
          $user = mysqli_fetch_assoc($result_a);
          setcookie("user_id", $user["id"], time() +60*60*24*30);

          //header("Location: /profile.php");
          //echo "<h2>Вы вошли в систему</h2>";
          $link = "http://doska.local/profile.php";
          $title = "Поздравляем Вас с регистрацией!";
          $message_modal = "Вы успешно зарегистрировались и вошли в систему!";    
          include "parts_site/messageModal.php";
          ?>
          <script> $(document).ready(function() {
            $("#messageModal").modal('show'); 
            });
          </script>
          <?php

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
      } else {
          //echo "<h2>произошла ошибка!!!</h2>" . mysqli_error($connect);
          $link = "";
          $title = "Ошибка регистрации";
          $message_modal = "Этот Email уже зарегистрирован нашей системе!";          
          include "parts_site/messageModal.php";
          ?>
          <script> $(document).ready(function() {
            $("#messageModal").modal('show'); 
            });
          </script>
          <?php
      }   
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

      <div class="card" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); ">
        <h3 class="card-header" style="background-color: #343a40; color: #fff;">Регистрация</h3>
        <div class="card-body">

            <h4 class="card-title">Укажаите Email и пароль</h4>

            <form action="registration.php" method="POST">

              <div class="form-group">
                <label for="exampleInputName1">Имя</label>
                <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Введите своё имя" aria-describedby="nameHelp">
                <small id="nameHelp" class="form-text text-muted">Ваше имя необходимо для того, что бы к Вам могли обратиться.</small>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Email адрес</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Введите свой Email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Мы никогда не передадим вашу электронную почту кому-либо еще.</small>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Пароль</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
              </div>

              <div class="modal-footer">
                <a href="/" class="btn btn-secondary btn-lg" data-dismiss="modal">Отмена</a>
                <button type="button" class="btn btn-outline-secondary btn-lg" role="button" aria-pressed="true" data-toggle="modal" data-target="#exampleModal">Авторизация
                </button>
                <button type="submit" class="btn btn-success btn-lg" role="button" aria-pressed="true">Зарегистрироватся</button>
              </div>

            </form>          
         
        </div>
      </div>

  </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>