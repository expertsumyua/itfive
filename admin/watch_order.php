<?php
// Подключаем базу даних.
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

?>

<?php


$sql = "SELECT * FROM orders where id =" . $_GET['id'];
$result = $connect->query($sql);
$row = mysqli_fetch_assoc($result);
$order_servise = $row['service'];

//echo $order_servise;
if (isset($_POST))
{
    //echo $order_servise;
    /// Создаем доску в таблице boards и добавляем связь пользователя с таблицей в board_users
        $sql = "SELECT * FROM boards WHERE order_id=" . $_GET['id'];
        if (!mysqli_fetch_assoc($connect->query($sql))) {

            $sql_boards = "INSERT INTO `boards` (order_id, order_servise) VALUES ('" . $_GET['id'] . "', '" . $order_servise . "');";
            mysqli_query($connect, $sql_boards);
            $sql_m = "SELECT * FROM `boards` WHERE `order_id` = " . $_GET['id'] . " ORDER BY `id` DESC";
            $boards = mysqli_fetch_assoc(mysqli_query($connect, $sql_m));
            $boards["id"];
        }

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

            </nav>
            <!-- Topbar -->
            <!-- <form method="POST"> -->
            <form action="/admin/board/board.php?order=<?php echo $_GET["id"]; ?>" method="POST">
                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <!-- Row -->
                    <div class="row">
                        <!-- DataTable with Hover -->
                        <div id="" class="col-lg-12">
                            <div class="card mb-4 text-center">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Подробности заказа</h6>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th>№</th>
                                          <th>Заказ</th>
                                          <th>Статус</th>
                                        </tr>
                                      </thead>

                                            <tbody>
                                                    <?php
                                                    $sql = "SELECT * FROM orders where id =" . $_GET['id'];
                                                    $result = $connect->query($sql);
                                                    $row = mysqli_fetch_assoc($result);
                                                    $order_servise = $row['service'];
                                                    ?>
                                                    <tr>
                                                    	<td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['service']; ?></td>
                                                        <td>
                                                            
                                                            <div id="status<?php echo $row['id']; ?>">
                                                                    
                                                                    <?php
                                                                    if($row['status'] == 0) {
                                                                        ?>
                                                                        <div class="btn btn-danger" onclick="statusNew(<?php echo $row['id']; ?>)">Новый</div>
                                                                    <?php 
                                                                    }

                                                                    if($row['status'] == 1) {
                                                                        ?>
                                                                        <div class="btn btn btn-success" onclick="statusSend(<?php echo $row['id']; ?>)">Отправлено</div>
                                                                    <?php
                                                                    }
                                                                    ?>

                                                                </div>
                                                        </td>
                                                    </tr>
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                        </div>
                        <!--Row-->
                    </div>
                    <!---Container Fluid-->
                </div>
                <button class="btn__progress">Прогресс</button>
            </form>
        
    </div>
    </div>
</div>



    <!-- Footer -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/footer.php" ?>
    <!-- Footer -->

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="assets/js/changeStatus.js"></script>
</body>

</html>