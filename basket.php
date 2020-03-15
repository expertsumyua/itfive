<?php
//устанавливаем страницу
$page = "basket";
include $_SERVER['DOCUMENT_ROOT'] . '/parts/header.php';
?>
<div class="col-12" style="min-height: 400px">
    <div class="container">
        <div class="row" >
            <table class="table table-dark " >
                <thead>
                    <tr>
                        <th scope="col">Название</th>
                        <th scope="col">Количество</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Удалить</th>
                    </tr>
                </thead>
                <tbody >
                <?php
                     if( isset($_COOKIE['basket']) || isset($_POST['id'])) {
                        $basket = json_decode($_COOKIE['basket'], true);
                        for($i = 0; $i < count($basket['basket']); $i++) {
                            $sql = "SELECT * FROM services WHERE id=" . $basket['basket'][$i]['service_id'];
                            $result = $connect->query($sql);
                            $row = mysqli_fetch_assoc($result);
                           ?>
                            <tr>
                                <td><?php echo $row['title']; ?></td>

                                <!-- редактирование количества товара -->
                                <td>
                                        <input type="number" class="btn btn-outline-light col-2 edit_input" id="count<?php echo $row['id'];?>" min="1" value="<?php echo $basket['basket'][$i]['count'];?>" onchange="formEditCount(<?php echo $row['id']; ?>)">

                                </td>
                                <!-- Расчет стоимости заказа -->
                                <input id="start_price<?php echo $row['id'];?>" type="hidden" name="start_prise" value="<?php echo $row['cost'];?>" >

                                <td class="price" id="cost<?php echo $row['id'];?>"><?php echo ($row['cost'] * $basket['basket'][$i]['count']);?> $</td>
                                
                                <!-- Удаление товара из корзины -->
                                <td><button onclick="deleteProductBasket(this, <?php echo $row['id']; ?>)" class="btn btn-danger">Delete</button></td>
                            </tr>
                        <?php
                       }
                    }
                 ?>
                </tbody>
            </table>
            <div class="row w-100 no-gutters bg-light position-relative">
                <div class="col-md-6 w-75 position-static p-4 pl-md-0 text-center">
                </div>
                <div class="col-md-5 w-25 position-static p-2 m-3 text-white text-right">
                    <button class="btn btn-outline-primary"  data-toggle="modal" data-target="#exampleModal">Оформить заказ</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Оформление заказа</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="/modules/basket/order.php">
                <?php
                    if(isset($_COOKIE['customers_id'])){
                        ?>
                        <div class="modal-footer">
                            <button name="submit" value="1" type="submit" class="btn btn-primary">Отправить заказ на оформление</button>
                        </div>
                <?php
                    } else {
                ?>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input name="first_naame" type="text" class="form-control"  placeholder="Имя">
                            </div>
                            <div class="form-group col-md-6">
                                <input name="last_name" type="text" class="form-control"  placeholder="Фамилия">
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="email" type="email" class="form-control"  placeholder="Почта">
                        </div>
                        <div class="form-group">
                            <input name="phone" type="text" class="form-control"  placeholder="Телефон">
                        </div>

                        <div class="modal-footer">
                            <button name="submit" value="1" type="submit" class="btn btn-primary">Отправить заказ на оформление</button>
                        </div>
                    <?php
                    } 
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>

