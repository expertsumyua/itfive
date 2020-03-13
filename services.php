<?php

/*============ Базовый фукционал: база данных ============*/
    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
/*========================================================*/

/*================== Это Шапка сайта =====================*/
include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
/*========================================================*/

?>

<?php
	$sql_categories = "SELECT categories.`title` FROM categories WHERE id =" .$_GET['id'];
    $categories = mysqli_fetch_assoc($connect->query($sql_categories));

    
    // $result = $connect->query($sql);
    // //Выводим циклом вайл по одному каждый продукт
    // while ($row = mysqli_fetch_assoc($result)) {
    //     include $_SERVER['DOCUMENT_ROOT'] . '/parts/cat_card.php';
    // }
?>

    <div class="infoProduct">
        <h1 class="text-center"><?php echo $categories['title'] ?></h1>

        <div class="row row-cols-3 pb-5"> <!--НАЧАЛО Блока вывода УСЛУГ -->

            <?php
                $sql = "SELECT services.short_description, services.cost, services.img FROM services INNER JOIN category_services ON services.id = category_services.service_id INNER JOIN categories ON categories.id = category_services.category_id WHERE categories.id =" .$_GET['id'];
                $result = $connect->query($sql);
                // Выводим циклом вайл по одному каждый продукт
                while ($row = mysqli_fetch_assoc($result)) {
                    include $_SERVER['DOCUMENT_ROOT'] . '/parts/service_card.php';
                }
            ?>

        </div> <!--КОНЕЦ Блока вывода УСЛУГ -->


    </div>


</div> <!-- НЕ ТРОГАТЬ!!!-->
<?php
/*================== Это ФУТЕР сайта =====================*/
include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
/*========================================================*/
?>
