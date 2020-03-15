<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
// Проверяем, был ли отправлен ПОСТ запрос
if (isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){

/*$sql = "SELECT * FROM services WHERE id=" . $_POST['id'];
        $result = $connect->query($sql);
        $row = mysqli_fetch_assoc($result); */
    $sql = "SELECT services.id, category_services.category_id
                        FROM services 
                        INNER JOIN category_services ON services.id = category_services.service_id 
                        INNER JOIN categories ON categories.id = category_services.category_id
                        WHERE services.id =" . $_POST['id'];
    $result = $connect->query($sql);
    $row = mysqli_fetch_assoc($result);
    // Добавление в корзину
     if(isset($_COOKIE['basket'])) { // если в корзине уже что то есть
        $basket = json_decode($_COOKIE['basket'], true);

        $basket['sum_count'][0]['count'] = $_POST['sum_count'];

        $issetProduct = 0;
        for($i = 0; $i < count($basket['basket']); $i++) {
            if( $basket['basket'][$i]["service_id"] == $row['id'] ) {
                 $basket['basket'][$i]['count']++;
                 $issetProduct = 1;
            }
        }

        if ($issetProduct != 1) {
            $basket["basket"][] = [
                "service_id" => $row['id'],
                "category_id" => $row['category_id'],
                "count" => 1
            ];
        }

        

    } else { // если корзина пустая
        $basket = [ "basket" => [ 
            ["service_id" => $row['id'],
                "category_id" => $row['category_id'],
                "count" => 1 ]
        ]
    ];
    } 
    //Преобразование массива в json формат
    $jsonProduct = json_encode($basket); 
    
     // очищаем куки
    setcookie("basket", "", 0, "/");
    // Добаляем куки из данных джейсона
    setcookie("basket", $jsonProduct, time() + 60*60, "/"); 

    echo $jsonProduct;

    
}
?>