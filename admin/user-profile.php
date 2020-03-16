<?php
//подключаем базу даних
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";


//устанавливаем страницу
$page = "Профиль"
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/head.php" ?>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/nav.php" ?>
    <!-- Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/top-bar.php" ?>
            </nav>
            <!-- Topbar -->

            <!-- Container Fluid-->
            <div class="container-fluid" id="container-wrapper">
                <!--breadcrumb-->
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/breadcrumb.php"
                ?>
<!--                 <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><a href="./">Главная</a></li>
                    </ol>
                </div> -->

                <div class="row mb-3 d-none">
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                            <span>Since last month</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Earnings (Annual) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                            <span>Since last years</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New User Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                                            <span>Since last month</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        <div class="mt-2 mb-0 text-muted text-xs">
                                            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                            <span>Since yesterday</span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>














<!-- ================================== ДАННЫЕ разработчика ===================================================== -->
               <!-- <div class="container-fluid"> -->
        <?php 

            if(isset($_COOKIE["customers_id"])){
                //$customers = $_COOKIE["customers_id"];
                $sql = "SELECT * FROM customers WHERE id=" . $_COOKIE["customers_id"];
                if ($row = mysqli_fetch_assoc( $connect->query($sql))) {
                    $customers = $row;
                }
            }

        ?>

            <!-- ID -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">ID Разработчика <?php echo $customers['id']; ?></h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- LOGIN -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">LOGIN</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $customers['login'] ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Имя и Фамилия -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Имя</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $customers['first_name'] ?></div><br/>
                          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Фамилия</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $customers['last_name'] ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Телефон -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Телефон</div>
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $customers['phone'] ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Email -->
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Email</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $customers['email'] ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

            </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class="m-0 font-weight-bold text-primary">Таблица проктов разработчика</h5>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <table class="table table-striped table-light table-hover">
        
                        <thead>
                            <!-- Шапка таблицы -->
                            <tr class="table-active">
                              <th scope="col">№ Проекта</th>
                              <th scope="col">Наименвание/корткое описание</th>
                              <th scope="col">Описание</th>
                              <th scope="col">Общее количество проектов</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Выводим по одному данные в таблицу из Куки
                                // if (isset($order['products'])) {
                                //     $basket = json_decode($order['products'], true);
                                //     //var_dump($basket);
                                //     for($i = 0; $i < count($basket['products']); $i++) {
                                //         $sql = "SELECT * FROM `products` WHERE id=" . $basket['products'][$i]['product_id'];
                                //         $result = $conn->query( $sql );
                                //         $product = mysqli_fetch_array( $result );
                                        ?>
                                            <tr>
                                                <td><?php //echo $product['id'] ?></td>
                                                <td><?php //echo $product['title'] ?></td>

                                                <td><?php //echo $basket['products'][$i]['count']; ?></td>

                                                <td><?php //echo $basket['products'][$i]['costs']; ?></td>                                
                                            </tr>
                                        <?php
                                    // }
                                // }
                            ?>           

                        </tbody>
                        <caption>
                            <tr class="table-active">
                                <th>Total cost</th>
                                <th></th>
                                <th></th>           
                                <th id="total-costs"><?php //echo $basket["total_costs"] ?></th>
                            </tr>
                        </caption>
                    </table>

                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h3 class="m-0 font-weight-bold text-primary">Фото Разработчика</h3>
                  <div class="dropdown no-arrow">
<!--                     <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="text-gray-400">Change</i>
                    </a> -->
<!--                     <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header d-n">Change status:</div>                      
                        <?php 
                            if ($order['status'] != 'NEW') {
                            ?>
                            <div onclick="changeStatus('NEW', <?php echo $order['id']; ?>)" class="dropdown-item">
                            <i class="fa fa-clock-o fa-1x text-danger"></i>NEW
                            </div>
                            <?php
                        }
                        ?>
                        <?php 
                            if ($order['status'] != 'Processing') {
                            ?>
                            <div onclick="changeStatus('Processing', <?php echo $order['id']; ?>)" class="dropdown-item">
                            <i class="fa fa-refresh fa-spin fa-1x fa-fw text-warning"></i>Processing
                            </div>
                            <?php
                        }
                        ?>
                        <?php 
                            if ($order['status'] != 'Sent') {
                            ?>
                            <div onclick="changeStatus('Sent', <?php echo $order['id'] ?>)" class="dropdown-item">
                            <i class="fa fa-truck fa-1x fa-fw text-success"></i>Sent
                            </div>
                            <?php
                        }
                        ?>
                    </div> -->
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body d-flex justify-content-center">
                               <?php $show_img = base64_encode($customers['photo']) ?>
                                <!-- <img class="bottom-img" src="data:image/jpeg;base64,<?=$show_img ?>"> -->
                                <img class="img-profile rounded-circle " src="data:image/jpeg;base64,<?=$show_img ?>" style="max-width: 250px">

<!--                   <div class="chart-pie text-center">
                    
                     
                        <?php 
                            if ($order['status'] == 'NEW') {
                            ?>
                                <div id="status-order">
                                    <span class="mr-5">
                                      <i class="fa fa-clock-o fa-5x text-danger"></i>
                                    </span>
                                    <div class="fa-3x text-danger text-center">NEW</div>
                                </div>
                            <?php
                        }
                        ?>
                        <?php 
                            if ($order['status'] == 'Processing') {
                            ?>  <div id="status-order">
                                    <span class="mr-5">
                                      <i class="fa fa-refresh fa-spin fa-5x fa-fw text-warning"></i>
                                    </span>
                                    <div class=" fa-3x text-warning text-center">Processing</div>
                                </div>                                
                            <?php
                        }
                        ?>
                        <?php 
                            if ($order['status'] == 'Sent') {
                            ?>  <div id="status-order">
                                    <span class="mr-5">
                                      <i class="fa fa-truck fa-5x fa-fw text-success"></i>
                                    </span>
                                    <div class="fa-3x text-success text-center">Sent</div>
                                </div>                                
                            <?php
                        }
                        ?>--> 

                  </div>       



<!--                   <div class="mt-4 text-center">
                    <span class="mr-2">
                      <i class="fa fa-clock-o fa-1x text-danger"></i> NEW
                    </span>        
                    <span class="mr-2">
                      <i class="fa fa-refresh fa-spin fa-1x fa-fw text-warning"></i> Processing
                    </span>
                    <span class="mr-2">
                      <i class="fa fa-truck fa-1x fa-fw text-success"></i> Sent
                    </span>
                  </div> -->

                </div>
              </div>
            </div>
            
          </div>

          <!-- <button onclick="changeStatus()" class="btn btn-danger">Delete</button> -->
<!-- ================================== ДАННЫЕ разработчика КОНЕЦ ===================================================== -->
















                    <!-- Invoice Example -->
                    <div class="col-xl-8 col-lg-7 mb-4 d-none">
                        <div class="card">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                                <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
                                            class="fas fa-chevron-right"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Item</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="#">RA0449</a></td>
                                        <td>Udin Wayang</td>
                                        <td>Nasi Padang</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">RA5324</a></td>
                                        <td>Jaenab Bajigur</td>
                                        <td>Gundam 90' Edition</td>
                                        <td><span class="badge badge-warning">Shipping</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">RA8568</a></td>
                                        <td>Rivat Mahesa</td>
                                        <td>Oblong T-Shirt</td>
                                        <td><span class="badge badge-danger">Pending</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">RA1453</a></td>
                                        <td>Indri Junanda</td>
                                        <td>Hat Rounded</td>
                                        <td><span class="badge badge-info">Processing</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">RA1998</a></td>
                                        <td>Udin Cilok</td>
                                        <td>Baby Powder</td>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                    <!-- Message From Customer-->
                    <div class="col-xl-4 col-lg-5 d-none">
                        <div class="card">
                            <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-light">Message From Customer</h6>
                            </div>
                            <div>
                                <div class="customer-message align-items-center">
                                    <a class="font-weight-bold" href="#">
                                        <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
                                    </a>
                                </div>
                                <div class="customer-message align-items-center">
                                    <a href="#">
                                        <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
                                        </div>
                                        <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
                                    </a>
                                </div>
                                <div class="customer-message align-items-center">
                                    <a class="font-weight-bold" href="#">
                                        <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                        </div>
                                        <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
                                    </a>
                                </div>
                                <div class="customer-message align-items-center">
                                    <a class="font-weight-bold" href="#">
                                        <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                                            ducimus qui blanditiis
                                        </div>
                                        <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
                                    </a>
                                </div>
                                <div class="card-footer text-center">
                                    <a class="m-0 small text-primary card-link" href="#">View More <i
                                                class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--Row-->

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin"
                                                                                class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
                    </div>
                </div>

            </div>
            <!---Container Fluid-->
        </div>
        <!-- Footer -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/footer.php"?>
        <!-- Footer -->
    </div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/admin/parts/scripts.php"

?>
</body>

</html>