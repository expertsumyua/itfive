<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

//устанавливаем страницу
$page = "Пользователи"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/head.php" ?>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/nav.php"
    ?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/top-bar.php" ?>
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
                       <div class="card-header">
                            </div>
                        <div class="card mb-4 text-center">


                            <div class="card-body table-full-width table-responsive">
                                <table class="table" id="table_orders">
                                  <thead>
                                    <tr>
                                      <th scope="col">№</th>
                                      <th scope="col">Имя</th>
                                      <th scope="col">Фамилия</th>
                                      <th scope="col">Почта</th>
                                      <th scope="col">Статус</th>
                                    </tr>
                                  </thead>

                                        <tbody>
                                                <?php
                                                $sql = "SELECT * FROM customers";
                                                $result = $connect->query($sql);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>

                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['first_name']; ?></td>
                                                        <td><?php echo $row['last_name']; ?> </td>
                                                        <td><?php echo $row['email']; ?> </td>
                                                        <td><?php
                                                            if($row['rights'] == 0){
                                                                echo "Пользователь";
                                                            }
                                                            if($row['rights'] == 1){
                                                                echo "Разработчик";
                                                            } ?> </td>
                                                        <td>
                                                            <a class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="options/users/edit_user.php?id=<?php echo $row['id']; ?>"  class="btn btn-outline-info">Редактировать</a>
                                                                 <a href="options/users/delete_user.php?id=<?php echo $row['id']; ?>"  class="btn btn-outline-danger">Удалить</a>

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
                <!--Row-->
            </div>
            <!---Container Fluid-->
        </div>

        <!-- Footer -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/footer.php" ?>
        <!-- Footer -->
    </div>
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/scripts.php"
?>

<!-- Page level custom scripts -->
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable(); // ID From dataTable
        $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
</script>
</body>


</html>
