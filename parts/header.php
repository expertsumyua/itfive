<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>It-five</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'] ?>/assets/css/style.css">
</head>
<body>
<div class="it-five container bg-white">
    <header class="it-five__header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="#"></a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="/"><span class="text-warning">IT</span>five</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="btn btn-sm btn-outline-secondary ml-2" href="#">Войти</a>
                <a class="btn btn-sm btn-outline-secondary ml-2" href="#">Выйти</a>
                <a class="btn btn-sm btn-outline-secondary ml-2" href="#">Регистацыя</a>
                <a class="basket d-flex flex-column justify-content-center align-items-center text-decoration-none position-relative" href="#">
                    <img class="w-15" src="assets/img/cart.svg" alt="cart">
                    Корзина
                    <span class="badge badge-pill badge-success position-absolute">
                    0
                    </span>

                </a>
            </div>
        </div>
    </header>
    <hr>
    <div class="nav-scroller py-1 mb-2">
        <nav class="it-five__nav nav d-flex justify-content-center text-decoration-none">
            <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="/">Главная</a>
            <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="cat.php">Услуги</a>
            <a class="it-five__link p-2 text-muted ml-2 text-decoration-none" href="#">Заказы</a>
        </nav>
    </div>
    <hr>

