<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon">
            <img src="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/assets/img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Shop</div>
    </a>
    <hr class="sidebar-divider my-0">
    <div class="sidebar-heading mt-4 text-dark">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Сontrol</span>
    </div>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Menu
    </div>
    <li class="nav-item <?php if ($page == "Главная"){echo 'active';}?>">
        <a class="nav-link" href="http://<?php echo $_SERVER['HTTP_HOST']?>/admin">
            <i class="fas fa-fw fa-home"></i>
            <span>Главная</span>
        </a>
    </li>
    <li class="nav-item <?php if ($page == 'Заказы'){echo 'active';}?>">
        <a class="nav-link" href="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/orders.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Заказы</span>
        </a>
    </li>
    <li class="nav-item <?php if ($page == 'Пользователи'){echo 'active';}?>">
        <a class="nav-link" href="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/users.php">
            <i class="fas fa-fw fa-user"></i>
            <span>Пользователи</span>
        </a>
    </li>
    <li class="nav-item <?php if ($page == 'Категории'){echo 'active';}?>"> <!-- href="categories.php" -->
        <a class="nav-link collapsed" href="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/categories.php">
            <i class="fab fa-fw fa-product-hunt"></i>
            <span>Категории</span>
        </a>
    </li>
    <li class="nav-item <?php if ($page == 'Услуги'){echo 'active';}?>">
        <a class="nav-link" href="http://<?php echo $_SERVER['HTTP_HOST']?>/admin/services.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Услуги</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Опции
    </div>
    <li class="nav-item mt-2">
        <a href="http://itfive.local/" class="nav-link border-0 bg-transparent">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>На главный сайт</span>
        </a>
        <button class="nav-link border-0 bg-transparent" id="login-out">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>Выйти с аккаунта</span>
        </button>

    </li>
</ul>
