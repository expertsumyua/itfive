<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
//устанавливаем страницу
$page = "Заказы"
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
            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
                <!--breadcrumb-->
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/breadcrumb.php"
                ?>

                <!-- Row -->
                <div class="row">
                    <!-- DataTable with Hover -->
                    <div id="" class="col-lg-12">
                        <div class="card mb-4 text-center">
                            <div class="card-body table-full-width table-responsive">
                                <table class="table" id="table_orders">
                                  <thead>
                                    <tr>
                                      <th scope="col">№</th>
                                      <th scope="col">Пользователь</th>
                                      <th scope="col">Дата заказа</th>
                                      <th scope="col">Статус</th>
                                    </tr>
                                  </thead>

                                        <tbody>
                                                <?php
                                                $sql = "SELECT orders.id, orders.status, orders.created_at, customers.first_name, customers.last_name, customers.`phone`, customers.`email`
                                                        FROM customers
                                                        INNER JOIN orders ON customers.id = orders.customer_id
                                                        ORDER BY orders.id ASC";
                                                $result = $connect->query($sql);
                                                while($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <tr>
                                                        <th><?php echo $row['id']; ?></th>
                                                        <td><a href="/admin/watch_order.php?id=<?php echo $row['id']; ?>">
                                                            <?php echo $row['first_name']; ?>,
                                                            <?php echo $row['last_name']; ?>,
                                                            <?php echo $row['phone']; ?>,
                                                            <?php echo $row['email']; ?>,
                                                        </a></td>
                                                        <td><?php echo $row['created_at']; ?></td>
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
                                                <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>

                            </div>
                    </div>
                </div>
                <!--Row-->
            </div>
            <!---Container Fluid-->
        </div>
    </div>

     <!-- Footer -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/footer.php" ?>
    <!-- Footer -->
    </div>
</div>

 

<script src="assets/js/changeStatus.js"></script>
</body>

</html>
