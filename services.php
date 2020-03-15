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
    if (isset($_GET['id']) && $_GET['id'] != "") {

        $sql_categories = "SELECT * FROM categories WHERE id =" . $_GET['id'];
        $result_categories = $connect->query($sql_categories);
        $categories = mysqli_fetch_assoc($result_categories);

        ?>
        <h2 class="text-left"><?php echo $categories['title'] ?></h2>
        <hr/>

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

    $sql_categories = "SELECT * FROM categories WHERE id";
    $result_categories = $connect->query($sql_categories);

    while ($categories = $result_categories->fetch_assoc()) {
    ?>


    <h2 class="text-left"><?php echo $categories['title'] ?></h2>
    <hr/>
    <div class="row row-cols-3 pb-3"> <!--НАЧАЛО Блока вывода УСЛУГ -->
        <?php
        $sql = "SELECT services.short_description, services.cost, services.img, services.id
                        FROM services 
                        INNER JOIN category_services ON services.id = category_services.service_id 
                        INNER JOIN categories ON categories.id = category_services.category_id
                        WHERE categories.id =" . $categories['id'];

        $result = $connect->query($sql);
        // Выводим циклом вайл по одному каждый продукт
        ?>

        <?php

        while ($row = $result->fetch_assoc()) {

            ?>

            <div class="col mt-3">
                <div class="px-3 h-100" style="background: #F2F2F2">
                    <div class="card border-0 rounded-0" style="background: #F2F2F2">
                        <div class="card-body row h-50">
                            <div class="col-7">
                                <p class="card-text d-inline"><?php echo $row['short_description'] ?></p>
                            </div>
                            <div class="col-5 d-flex align-items-center justify-content-center">
                                <?php $show_img = base64_encode($row['img']) ?>
                                <img class="img-fluid" src="data:image/jpeg;base64,<?= $show_img ?>">
                            </div>
                        </div>
                        <div class="card-footer" style="background: #F2F2F2">
                            <p class="order d-inline">Цена: <strong><?php echo $row['cost'] ?>$</strong></p>
                            <button onclick="addToBasket(this, <?php echo $categories['id']; ?>, <?php echo $row['id']; ?>)" 
                                    class="btn btn-outline-primary ml-5 justify-content-end">Заказать
                            </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>

<!--КОНЕЦ Блока вывода УСЛУГ -->
    <div class="d-flex justify-content-end pr-3">
        <a href="info-cat.php?id=<?php echo $categories['id'] ?>" type="button"
           class="btn btn-outline-secondary rounded-0">Подробнее</a>
    </div>
<hr/>

<?php
}
}
?>
</div>

</div>


</div> <!-- НЕ ТРОГАТЬ!!!-->
<?php
/*================== Это ФУТЕР сайта =====================*/
include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
/*========================================================*/
?>
