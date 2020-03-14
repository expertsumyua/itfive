<?php
//устанавливаем страницу
$page = "index";
include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';

/*
 * 1. Перенести верстку шаблона входа пользователя
 * 2. Проверить данные в базе о пользователе (существование ползователя, верификацыю)
 * 3. Отправить для подтверждения письмо на пошту пользователю повторно если не верифицырован
 * */

if (isset($_GET['u_code'])) {
    $sql = "SELECT * FROM customers WHERE confirm_mail='" . $_GET['u_code'] . "'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        $sql = "UPDATE `customers` SET `verifided` = '1' WHERE `customers`.`id` =" . $user['id'];

        if ($connect->query($sql)) {
            echo "<div id='info' class='alert alert-success position-absolute' role='alert' style='top:2%'>
                    Пользователь верифицирован!</div>";
        }
    }
}

//авторизацыя пользователя
if (isset($_POST) and $_SERVER["REQUEST_METHOD"] == "POST") {
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM customers WHERE first_name='" . $_POST['login'] . "' AND password='" . $password . "'";

    $result = $connect->query($sql);
    $user = $result->fetch_assoc();
    if ($result->num_rows > 0 && $user['verifided'] == 1) {

        header('Location: http://itfive.local/');
        setcookie("customers_id", $user["id"], time() + 60*60, "/");
    }else{
        echo "<div id='info' class='alert alert-success position-absolute' role='alert' style='top:2%'>
        Вам на почту отправлено повторно письмо для подтверждения регистрации или пройдите регистрацию</div>";

        $u_code = randomString(20);
        $html = $_SERVER['HTTP_HOST'];
        if ($result->num_rows > 0 && $connect->query($sql)) {
            $sql = "UPDATE `customers` SET `confirm_mail` = '" . $u_code . "' WHERE `customers`.`first_name` ='" . $_POST['login'] . "'";
            $connect->query($sql);
            $link = "<a href= 'http://$html/login.php?u_code=$u_code'>Confirm</a>";
            mail($user['email'], 'Register', $link);
        }
    }
}

function randomString($length)
{
    $length = $length;
    $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $str = "";

    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[mt_rand(0, strlen($chars) - 1)];
    }

    return $str;
}

?>

    <div class="container">
        <div class="row justify-content-center">
            <img src="assets/img/loginBG.png" style="width: 100%;">
            <div class="row justify-content-center" style="background: white; width: 100%; height: 100%;">
                <div class="row justify-content-center">
                    <div class="col-12">


                        <div class="modal-dialog" role="document">
                            <div class="row justify-content-center">
                                <h2>С возвращением!</h2>
                            </div>

                            <div class="row justify-content-center mt-3">
                                <p>Рады видеть! Есть новые идеи?</p>
                            </div>

                            <div class="modal-content pt-5 pl-5 pr-5 pb-5">
                                <form method="POST">
                                    <div class="row justify-content-center pb-3">
                                        <h5 class="modal-title">Войти</h5>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="login" size="50" class="form-control" id="username"
                                               placeholder="Имя">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" size="50" class="form-control" id="password"
                                               placeholder="Пароль">
                                    </div>

                                    <div class="w-100">
                                        <button type="submit" class="btn btn-primary d-inline">
                                           Вход
                                        </button>
                                        <a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/register.php"
                                           class="float-right">Регистрация</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>