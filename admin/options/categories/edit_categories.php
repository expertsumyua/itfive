<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";
//устанавливаем страницу
$page = "Изменить категорию услуг";


if(isset($_POST['submit'])) {

    if ($img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']))) {
         

        $sql = "UPDATE categories SET title= '". $_POST['title'] ."' , description= '". $_POST['description'] ."' , cost= '". $_POST['cost'] ."' , img = '$img' WHERE categories . id =" . $_GET['id'];

    } else {

       $sql = "UPDATE categories SET title= '". $_POST['title'] ."' , description= '". $_POST['description'] ."' , cost= '". $_POST['cost'] ."' WHERE categories . id =" . $_GET['id'];

    }
    if($connect->query($sql)){
        header("Location: /admin/categories.php");
    } else {
        echo "Error";
    }


    // $sql = "UPDATE categories SET title= '". $_POST['title'] ."' , description= '". $_POST['description'] ."' , cost= '". $_POST['cost'] ."' WHERE categories . id =" . $_GET['id'];
    // if($connect->query($sql)){
    //     header("Location: /admin/categories.php");
    // } else {
    //     echo "Error";
    // }
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

            </nav>
            <!-- Topbar -->
            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
                    <!--breadcrumb-->
                        <?php
                        include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/breadcrumb.php"
                        ?>
                <!-- enctype="multipart/form-data ОБЯЗАТЕЛЬНО Без неё не рбаотает!-->   
                <form method="POST" enctype="multipart/form-data"> 
                    <!-- Row -->
                    <div class="row">

                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    
                                        <div class="row">
                                            <?php
                                                $sql = "SELECT * FROM categories WHERE id=" . $_GET['id'];
                                                $result = $connect->query($sql);
                                                $data = mysqli_fetch_assoc($result);
                                                ?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Название</label>
                                                    <input name="title" type="text" class="form-control" value="<?php echo $data["title"]; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Описание</label>
                                                    <textarea name="description" type="text" class="form-control" value=""><?php echo $data["description"]; ?> </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Цена</label>
                                                    <input name="cost" type="text" class="form-control" value="<?php echo $data["cost"]; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <button name="submit" value="1" type="submit" class="btn btn-outline-info btn-fill pull-right">Внести изменения</button>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Фото -->
                        <div class="col-xl-4 col-lg-7">
                            <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                  <h3 class="m-0 font-weight-bold text-primary">Изображение</h3>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body d-flex justify-content-center">
                                   <?php $show_img = base64_encode($data['img']) ?>
                                    <!-- <img class="bottom-img" src="data:image/jpeg;base64,<?=$show_img ?>"> -->
                                    <img class="img-profile" src="data:image/jpeg;base64,<?=$show_img ?>" style="max-width: 250px">
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


                    </div>
                    <!--Row-->
                </form>    
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
