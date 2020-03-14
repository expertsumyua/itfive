<?php

/*============ Базовый фукционал: база данных ============*/
    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
/*========================================================*/

/*================== Это Шапка сайта =====================*/
include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
/*========================================================*/

?>

    <div class="infoServices p-3">

    <?php
        if (isset($_GET['id']) && $_GET['id']!="") {

            $sql_categories = "SELECT * FROM categories WHERE id =" . $_GET['id'];
            $result_categories = $connect->query($sql_categories);
            $categories = mysqli_fetch_assoc($result_categories);

            ?>
                <h2 class="text-left"><?php echo $categories['title'] ?></h2><hr/>

                <div class="row row-cols-3 pb-5"> <!--НАЧАЛО Блока вывода УСЛУГ -->

                    <?php
                        $sql = "SELECT services.short_description, services.cost, services.img, services.id FROM services 
                        INNER JOIN category_services ON services.id = category_services.service_id 
                        INNER JOIN categories ON categories.id = category_services.category_id
                        WHERE categories.id =" . $categories['id'];
                    
                        $result = $connect->query($sql);
                        // Выводим циклом вайл по одному каждый продукт
                        while ($row = mysqli_fetch_assoc($result)) {
                            include $_SERVER['DOCUMENT_ROOT'] . '/parts/service_card.php';
                        }
                    ?>

                </div> <!--КОНЕЦ Блока вывода УСЛУГ -->

            <?php

        } else {

            ?>
            <h3 class="text-center pl-5">Наши товары</h3>
            <?php

            $sql_categories = "SELECT * FROM categories";
            $result_categories = $connect->query($sql_categories);

            while ($categories = mysqli_fetch_assoc($result_categories)) {
        ?>

                <h2 class="text-left"><?php echo $categories['title'] ?></h2><hr/>

                <div class="row row-cols-3 pb-3"> <!--НАЧАЛО Блока вывода УСЛУГ -->

                    <?php
                        $sql = "SELECT services.short_description, services.cost, services.img FROM services INNER JOIN category_services ON services.id = category_services.service_id INNER JOIN categories ON categories.id = category_services.category_id WHERE categories.id =" . $categories['id'];
                        $result = $connect->query($sql);
                        // Выводим циклом вайл по одному каждый продукт
                        while ($row = mysqli_fetch_assoc($result)) {
                            include $_SERVER['DOCUMENT_ROOT'] . '/parts/service_card.php';
                        }
                    ?>

                </div> <!--КОНЕЦ Блока вывода УСЛУГ -->
                <div class="d-flex justify-content-end pr-3">
                    <a href="info-cat.php?id=<?php echo $categories['id'] ?>" type="button" class="btn btn-outline-secondary rounded-0" >Подробнее</a>
                </div><hr/>

        <?php
            }
        }
    ?>


    </div>


</div> <!-- НЕ ТРОГАТЬ!!!-->
<?php
/*================== Это ФУТЕР сайта =====================*/
include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
/*========================================================*/
?>
