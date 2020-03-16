<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
//устанавливаем страницу
$page = "Изменить пользователя";


if(isset($_POST['submit'])) {

    if ($photo = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']))) {

         $sql = "UPDATE customers SET first_name = '". $_POST['first_name'] ."', last_name= '". $_POST['last_name'] ."', email= '". $_POST['email'] ."', rights= '". $_POST['rights'] ."', photo = '$photo' WHERE customers . id =" . $_GET['id'];

    } else {

        $sql = "UPDATE customers SET first_name = '". $_POST['first_name'] ."', last_name= '". $_POST['last_name'] ."', email= '". $_POST['email'] ."', rights= '". $_POST['rights'] ."' WHERE customers.id =" . $_GET['id'];

    }

    // $sql = "UPDATE customers SET first_name = '". $_POST['first_name'] ."', last_name= '". $_POST['last_name'] ."', email= '". $_POST['email'] ."', rights= '". $_POST['rights'] ."' WHERE customers . id =" . $_GET['id'];
    //$sql = "UPDATE customers SET photo = '$photo' WHERE customers.id =" . $_GET['id'];
    // var_dump($sql);
    // die();
    if($connect->query($sql)){
        header("Location: /admin/user-profile.php");
    } else {
        echo "Error";
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
                <form method="POST" enctype="multipart/form-data">    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    
                                        <div class="row">
                                           <?php
                                                $sql = "SELECT * FROM customers WHERE id=" . $_GET['id'];
                                                $result = $connect->query($sql);
                                                $data = mysqli_fetch_assoc($result);
                                                ?>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Имя</label>
                                                    <input name="first_name" type="text" class="form-control" placeholder="" value="<?php echo $data["first_name"]; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Фамилия</label>
                                                    <input name="last_name" type="text" class="form-control" placeholder="Короткое писание" maxlength="60" value="<?php echo $data["last_name"]; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">

                                                    <label>Почта</label>
                                                    <textarea name="email" type="text" class="form-control" value=""><?php echo $data["email"]; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Права</label>
                                                        <select class="form-control" name="rights" style="width: 200px;">
                                                            <?php
                                                            if($data['rights'] == 1){
                                                            ?>
                                                            <option value="1">Разработчик</option>
                                                            <?php } ?>
                                                            <option value="0">Пользователь</option>
                                                            <?php
                                                            if($data['rights'] == 0){
                                                            ?>
                                                            <option value="1">Разработчик</option>
                                                            <?php } ?>


                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button name="submit" value="1" type="submit" class="btn btn-outline-success btn-fill pull-right">Изменить данные пользователя</button>
                                        <a class="btn btn-outline-secondary btn-fill pull-right ml-3" href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/admin/user-profile.php"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                            Отмена
                                        </a>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Фото Разработчика -->
                        <div class="col-xl-4 col-lg-7">
                            <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <h3 class="m-0 font-weight-bold text-primary">Фото Разработчика</h3>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body d-flex justify-content-center">
                                   <?php $show_img = base64_encode($data['photo']) ?>
                                    <!-- <img class="bottom-img" src="data:image/jpeg;base64,<?=$show_img ?>"> -->
                                    <img class="img-profile rounded-circle " src="data:image/jpeg;base64,<?=$show_img ?>" style="max-width: 250px">
                                </div> 
    <!--                             <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <h3 class="m-0 font-weight-bold text-primary">Фото Разработчика</h3>
                                </div> -->
                                <div class="form-group mx-3">
                                    <label>Загрузить фотограффию</label><br>
                                    <input type="file" name="img_upload" class="">
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
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
<script src="/admin/assets/js/products_options.js"></script>

</body>

</html>
