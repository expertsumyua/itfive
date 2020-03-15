<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

/*Функционал удаления досок, карточек и заданий*/
include $_SERVER['DOCUMENT_ROOT'] . "/admin/board/options/delete.php";
/*=============================================*/


//устанавливаем страницу
$page = "Доска";
?>

<?php

$board_id = 0;
if (isset($_GET["board"])) {
    $board_id = $_GET['board'];
}
if (isset($_GET['order'])) {
    $sql = "SELECT * FROM boards WHERE order_id=" . $_GET['order'];
    if ($row = mysqli_fetch_assoc($connect->query($sql))) {
        $board_id = $row['id'];
        // echo $board_id;
        // die();
    }
}

$boardindex = 0;
if (isset($_POST["cardname"])&& $_POST["cardname"]!="") {
    $sql = "INSERT INTO `cards` (`id`, `name`, `date_time`, `type_access`, `type`) VALUES (NULL, '" . $_POST["cardname"] . "', current_timestamp(), '" . $_POST["type_access"] . "', '" . $_POST["type_card"] . "');";
    mysqli_query($connect, $sql);

//    $sql = "INSERT INTO `board_cards` (`board_id`, `card_id`, `card_index`) VALUES ('" . $board_id . "', '1', '1');";

    $sql_m = "SELECT * FROM `cards` WHERE `name` = '" . $_POST["cardname"] . "' ORDER BY `id` DESC";
    $cards = mysqli_fetch_assoc($connect->query($sql_m));
    $cards["id"];

    $sql = "INSERT INTO `board_cards` (`board_id`, `card_id`, `card_index`) VALUES ('" . $board_id . "', '" . $cards["id"] . "', '" . $boardindex ."');";
    mysqli_query($connect, $sql);
    $sql_n = "SELECT * FROM `board_cards` WHERE board_id = " . $board_id . "";
    $amount = mysqli_num_rows($connect->query($sql_n));
    $sql = "UPDATE `board_cards` SET `card_index` = '" . $amount . "' WHERE `board_cards`.`board_id` = " . $board_id . " AND `board_cards`.`card_id` = " . $cards["id"] . ";";
    $connect->query($sql);
} else if (isset($_POST["cardname"])&& $_POST["cardname"]=="") {
    $link = "";
    $title = "Ошибка ввода";
    $message_modal = "Пожалуста введите наименование карты и повторите попытку снова!";
    include "parts_site/messageModal.php";
    ?>
    <script> $(document).ready(function() {
    $("#messageModal").modal('show');
    });
    </script>
    <?php
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/head.php" ?>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/nav.php" ?>
    <!-- Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/top-bar.php"
                ?>
            </nav>
            <!-- Topbar -->

            <!-- -->

            <div class="container-fluid" style="height: 80%;">

    <div class="row m-2">
       <?php
        // $sql = "SELECT access FROM `board_developers` WHERE `board_id` = ". $board_id ." AND `user_id` = ". $_COOKIE["user_id"] ."";
        // $access = mysqli_fetch_assoc($connect->query($sql));
        // if($access["access"] == 3){
        ?>
            <button type="button" class="btn btn-dark my-2 my-sm-0 border-0 rounded-0" role="button" aria-pressed="true" data-toggle="modal" data-target="#createCardModal">
              Добавить карточку
            </button>
<!--
            <a href="options/addmember.php?board=<?php echo $board_id?>&addmember" type="button" class="btn btn-dark my-2 my-sm-0 m-2" role="button" aria-pressed="true">
            Список участников
            </a>
-->
        <?php
        // }
        ?>
    </div>
    <div class="row m-2" style="
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    height: 100%;
    ">
    <?php
    if (isset($board_id)) {
        // выбираем все доски где учавствует авторизоываный пользователь
        $sql ="SELECT * FROM `board_cards` WHERE `board_id` = " . $board_id ."";
        $result = $connect->query($sql);
        $amountcards = mysqli_num_rows($result);
        $currentLoop = 0;

        while($currentLoop < $amountcards){
          $card = mysqli_fetch_assoc($result);
          $boardindex = $boardindex + 1;
         include $_SERVER['DOCUMENT_ROOT'] . "/admin/board/card.php";
          $currentLoop = $currentLoop + 1;
        }
    }
    ?>
    </div>

</div>

<div class="modal fade" id="createCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Создание карточки</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST">

                <div class="modal-body">
                    <h4 class="card-title">Создание карточки</h4>

                      <div class="form-group">
                        <label for="exampleInputName">Название карточки:</label>
                        <input name="cardname" type="text" class="form-control" id="exampleInputName" placeholder="Введите название карточки">
                      </div>
                      <div class="form-group">
                        <label>Доступ к карточке:</label>
                              <select class="form-control" name="type_access" id="">
                                  <option value="1">Для разработчиков</option>
                                  <option value="2">Для тестировщиков</option>
                                  <option value="3">Для Модераторов</option>


                              </select>
                      </div>
                      <div class="form-group">
                        <label>Тип карточки:</label>
                              <select class="form-control" name="type_card" id="">
                                  <option value="1">Начальная</option>
                                  <option value="2">Конечная</option>


                              </select>
                      </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-success btn-lg" role="button" aria-pressed="true">Создать</button>
                </div>

            </form>

        </div>
    </div>
</div>

            <!-- -->

            <!-- Container Fluid-->
            <div class="container-fluid d-none" id="container-wrapper">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="./">Главная</a></li>
                    </ol>
                </div>

                <div class="row mb-3">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                            <span>Since last month</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                            <span>Since last years</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New User Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                                            <span>Since last month</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                            <span>Since yesterday</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Area Chart -->
                    <div class="col-xl-8 col-lg-7">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                         aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pie Chart -->
                    <div class="col-xl-4 col-lg-5">
                        <div class="card mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Month <i class="fas fa-chevron-down"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                         aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Select Periode</div>
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">Week</a>
                                        <a class="dropdown-item active" href="#">Month</a>
                                        <a class="dropdown-item" href="#">This Year</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="small text-gray-500">Oblong T-Shirt
                                        <div class="small float-right"><b>600 of 800 Items</b></div>
                                    </div>
                                    <div class="progress" style="height: 12px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="small text-gray-500">Gundam 90'Editions
                                        <div class="small float-right"><b>500 of 800 Items</b></div>
                                    </div>
                                    <div class="progress" style="height: 12px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="small text-gray-500">Rounded Hat
                                        <div class="small float-right"><b>455 of 800 Items</b></div>
                                    </div>
                                    <div class="progress" style="height: 12px;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="small text-gray-500">Indomie Goreng
                                        <div class="small float-right"><b>400 of 800 Items</b></div>
                                    </div>
                                    <div class="progress" style="height: 12px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="small text-gray-500">Remote Control Car Racing
                                        <div class="small float-right"><b>200 of 800 Items</b></div>
                                    </div>
                                    <div class="progress" style="height: 12px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a class="m-0 small text-primary card-link" href="#">View More <i
                                            class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Example -->
                    <div class="col-xl-8 col-lg-7 mb-4">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                                <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
                                            class="fas fa-chevron-right"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Item</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="#">RA0449</a></td>
                                        <td>Udin Wayang</td>
                                        <td>Nasi Padang</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">RA5324</a></td>
                                        <td>Jaenab Bajigur</td>
                                        <td>Gundam 90' Edition</td>
                                        <td><span class="badge badge-warning">Shipping</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">RA8568</a></td>
                                        <td>Rivat Mahesa</td>
                                        <td>Oblong T-Shirt</td>
                                        <td><span class="badge badge-danger">Pending</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">RA1453</a></td>
                                        <td>Indri Junanda</td>
                                        <td>Hat Rounded</td>
                                        <td><span class="badge badge-info">Processing</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">RA1998</a></td>
                                        <td>Udin Cilok</td>
                                        <td>Baby Powder</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                    <!-- Message From Customer-->
                    <div class="col-xl-4 col-lg-5 ">
                        <div class="card">
                            <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
                            </div>
                            <div>
                                <div class="customer-message align-items-center">
                                    <a class="font-weight-bold" href="#">
                                        <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
                                    </a>
                                </div>
                                <div class="customer-message align-items-center">
                                    <a href="#">
                                        <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
                                        </div>
                                        <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
                                    </a>
                                </div>
                                <div class="customer-message align-items-center">
                                    <a class="font-weight-bold" href="#">
                                        <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                        </div>
                                        <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
                                    </a>
                                </div>
                                <div class="customer-message align-items-center">
                                    <a class="font-weight-bold" href="#">
                                        <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                                            ducimus qui blanditiis
                                        </div>
                                        <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
                                    </a>
                                </div>
                                <div class="card-footer text-center">
                                    <a class="m-0 small text-primary card-link" href="#">View More <i
                                                class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Row-->

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin"
                                                                                class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
                    </div>
                </div>

            </div>
            <!---Container Fluid-->
        </div>
        <!-- Footer -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/footer.php"?>
        <!-- Footer -->
    </div>


</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/scripts.php"

?>
 <script src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
 <script src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/assets/js/ruang-admin.min.js"></script>
</body>

</html>
