<?php
/* Базовый фукционал: база данных, настройки*/
include "configs/db.php";
include "configs/settings.php";
/*==========================================*/

/*==== Это Шапка сайта, в ней находится
так жеи АВТОРИЗАЦИЯ =======================*/
include "parts_site/site_header.php";
include "authorization.php";
/*=========================================*/

if($user_id != null) {
 //header("Location: /profile.php");
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





      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
</body>
</html>
