<?php
//устанавливаем страницу
$page = "index";
include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';

/*
 * 1. Перенести верстку шаблона регистрацыи
 * 2. Отправить данные в базу о пользователе
 * 3. Отправить для подтверждения письмо на пошту пользователю
 * 4. сделать страницу подтверждения
 * */

if (isset($_GET['u_code'])) {
    $sql = "SELECT * FROM customers WHERE confirm_mail='" . $_GET['u_code']. "'";
    $result = $connect->query($sql);

    if ($result->num_rows>0){
        $user = mysqli_fetch_assoc($result);
        $sql = "UPDATE `customers` SET `verifided` = '1' WHERE `customers`.`id` =" . $user['id'];

        if ($connect->query($sql)){
            echo "Пользователь верифицирован!";
        }
    }
}

//регистрацыя пользователя
if (isset($_POST) and $_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['password1'] == $_POST['password2']) {
        $password = md5($_POST['password1']);
        $u_code = randomString(20);
        $sql = "INSERT INTO customers(first_name, last_name, phone, email, password, confirm_mail) VALUES ('" .
            $_POST['first-name'] . "', '" . $_POST['last-name'] . "',  '" . $_POST['phone'] . "', '" .
            $_POST['email'] . "', '" . $password . "', '" . $u_code . "')";


        $html = $_SERVER['HTTP_HOST'];
        if ($connect->query($sql)) {
            echo
            "<div id='info' class='alert alert-success position-absolute' role='alert' style='top:2%'>Пользователь 
            зарегистрирован на пошту отправлено письмо для аторизации</div>";

            $link = "<a href= 'http://$html/login.php?u_code=$u_code'>Confirm</a>";
            mail($_POST['email'], 'Register', $link);
        }
    }else{
        echo "<div id='info' class='alert alert-danger position-absolute' role='alert' style='top:2%'>Пароли не совпадают</div>";
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
        <div class="row justify-content-center ">
            <img src="assets/img/register_img.png" style="width: 1100px">
            <div class="row justify-content-center" style="background: #fff; width: 1100px ">
                <div class="row justify-content-center ">
                    <div class="col-12">
                        <div>
                            <div class="modal-dialog" role="document">
                                <div class="row justify-content-center flex-column ">
                                    <div class="row justify-content-center">
                                        <h6 class="modal-title">Хочешь себе крутой проект?</h6>
                                    </div>
                                    <div class="row justify-content-center ">
                                        <p class="modal-title text-alighn-center ">Всё просто: регистрируйся, оставляй
                                            свою заявку и пожелания,</p>
                                        <p class="modal-title ">мы всё выполним быстро и качественно!</p>
                                    </div>
                                </div>

                                <div class="modal-content mt-3 pl-5 pr-5 pb-4 pt-1">
                                    <div class="row justify-content-center mb-4 mt-3">
                                        <h5 class="modal-title">Регистрация</h5>
                                    </div>

                                    <div class="modal-body p-1">
                                        <form method="POST">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <input name="first-name" type="text" class="form-control"
                                                           id="inputName" placeholder="Имя">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input name="last-name" type="text" class="form-control"
                                                           id="inputName2" placeholder="Фамилия">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input name="email" type="email" class="form-control " id="inputEmail"
                                                       placeholder="Почта">
                                            </div>
                                            <div class="form-group">
                                                <input name="phone" type="text" class="form-control " id="inputPhone"
                                                       placeholder="Телефон">
                                            </div>
                                            <div class="form-group">
                                                <input name="password1" type="password" class="form-control"
                                                       id="inputPassword" placeholder="Пароль">
                                            </div>
                                            <div class="form-group">
                                                <input name="password2" type="password" class="form-control"
                                                       id="inputPassword2" placeholder="Повторить пароль">
                                            </div>
                                            <div class="w-100">
                                                <button type="submit" class="btn btn-primary d-inline">
                                                    Зарегистрироватся
                                                </button>
                                                <a href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/login.php"
                                                   class="float-right">войти</a>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
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