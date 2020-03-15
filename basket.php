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
        </div>
    </div>
</div>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/parts/footer.php';
?>