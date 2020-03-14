<?php

if (isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_COOKIE['basket'])){
        $basket = $_COOKIE['basket'];
        $basket = json_decode($_COOKIE['basket'], true);

        for($i = 0; $i < count($basket['basket']); $i++) {
            if($basket['basket'][$i]['service_id'] == $_POST['id']){
                unset($basket['basket'][$i]);
                sort($basket['basket']);
            }
        }
        //Преобразование массива в json формат
        $jsonProduct = json_encode($basket);
        // очищаем куки
        setcookie("basket", "", 0, "/");
        // Добаляем куки
        setcookie("basket", $jsonProduct, time() + 60*60, "/");
        var_dump($_COOKIE['basket']);
        echo $jsonProduct;

    }
}
?>