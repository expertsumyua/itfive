<?php


	if ($page == "Категории" || $page == "Редактировать категорию" || $page == "Удалить категорию" || $page == "Заказы" || $page == "Услуги" || $page=="Добавить категорию" || $page == "Изменить категорию услуг" || $page == "Изменить услуги" || $page == "Добавить услуги") {

    ?>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 text-capitalize"><?php echo $page ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-muted" href="/admin/">Главная</a></li>
            <li class="breadcrumb-item active text-uppercase" aria-current="page"><a href="<?php echo $page ?>.php"> <?php echo $page ?></a></li>
        </ol>
    </div>
    <?php
}
?>