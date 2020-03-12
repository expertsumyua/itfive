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
    <li class="nav-item <?php if ($page == "home"){echo 'active';}?>">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span>
        </a>
    </li>
    <li class="nav-item <?php if ($page == 'users'){echo 'active';}?>">
        <a class="nav-link" href="users.php">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span>
        </a>
    </li>
    <li class="nav-item <?php if ($page == 'products'){echo 'active';}?>">
        <a class="nav-link collapsed" href="products.php">
            <i class="fab fa-fw fa-product-hunt"></i>
            <span>Products</span>
        </a>
    </li>
    <li class="nav-item <?php if ($page == 'categories'){echo 'active';}?>">
        <a class="nav-link" href="categories.php">
            <i class="fas fa-fw fa-folder"></i>
            <span>Categories</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Settings
    </div>
    <li class="nav-item mt-2">
        <a class="nav-link" href="login.html">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>Logout</span>
        </a>
    </li>
</ul>
