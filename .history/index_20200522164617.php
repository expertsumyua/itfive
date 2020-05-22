<?php
//устанавливаем страницу
// ТЕСТ
$page = "index";
include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
?>
    <div class="it-five__jumbotron jumbotron p-4 p-md-5 text-white rounded bg-dark position-relative">
        <div class="col-md-6 px-0">
            <h1 class="font-italic">Отличные результаты</h1>
            <p class="lead my-3">Мы генерируем нестандартные решения, и готовы воплощать в жизнь Ваши самые дерзкие и сумасшедшие идеи. Мы создаем лучшие сайты, и делаем сайты лучше.</p>
            <ul class="lead mb-0 list-unstyled">
                <li class="text-white font-weight-bold">Корпоративные сайты</li>
                <li class="text-white font-weight-bold">Интернет магазин</li>
                <li class="text-white font-weight-bold">Мобильные приложения</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="card-info col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary">Каталог услуг</strong>
                    <p class="card-info__description card-text mb-auto">Мы разрабатываем интернет-магазины с 2006 года, и за это время сформулировали четкую систему того, как сделать ваш бизнес в сети успешным с помощью качественного веб-ресурса, и дальнейшего  продвижения интернет магазина</p>
                    <a href="cat.php" class="stretched-link">Перейти в раздел</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img src="assets/img/service-index.png" height="223" width="171"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="card-info col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-success">Заказать</strong>
                    <p class="card-info__description  mb-auto">В зависимости от целей, ниши и других факторов возможно разное распределение бюджета между перечисленными пунктами. Также стоит учесть, что требования поисковых систем постоянно меняются.</p>
                    <a href="services.php" class="stretched-link">Перейти в раздел</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img src="assets/img/orders-index.png" height="231" width="136"/>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container bg-white px-0 pt-5">
    <h2 class="text-center pb-5">Довольные клиенты :)</h2>
    <div class="row">
        <div class="col-12">
             <img class="img-fluid" src="assets/img/mainImg.jpg">
        </div>
    </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>