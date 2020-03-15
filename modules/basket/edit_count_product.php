<?php

    if( isset($_COOKIE['basket']) ){

        $basket = $_COOKIE['basket'];
        $basket = json_decode($_COOKIE['basket'], true);

        for($i = 0; $i < count($basket['basket']); $i++) {
            if($basket['basket'][$i]['service_id'] == $_POST['id']){
                $basket['basket'][$i]['count'] = $_POST['count'];
                $edit_count = $basket['basket'][$i]['count'];      
                           
            }
        }
        //Преобразование массива в json формат
        $jsonProduct = json_encode($basket);
        // очищаем куки
        setcookie("basket", "", 0, "/");
        // Добаляем куки
        setcookie("basket", $jsonProduct, time() + 60*60, "/");
        
        echo $jsonProduct;
        

    }
?>