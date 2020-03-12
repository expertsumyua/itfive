<?php

/*============ Базовый фукционал: база данных ============*/
    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
/*========================================================*/

/*================== Это Шапка сайта =====================*/
include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
/*========================================================*/

?>

<?php
    $sql = "SELECT * FROM categories";
    $result = $connect->query($sql);
    // Выводим циклом вайл по одному каждый продукт
    while ($row = mysqli_fetch_assoc($result)) {
        include $_SERVER['DOCUMENT_ROOT'] . '/parts/cat_card.php';
    }
?>

</div> <!-- НЕ ТРОГАТЬ!!!-->

<?php
/*================== Это ФУТЕР сайта =====================*/
include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
/*========================================================*/
?>
