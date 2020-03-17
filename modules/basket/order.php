<?php
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/configs/configs.php';
include $_SERVER['DOCUMENT_ROOT'] . '/modules/telegram/send-message.php';

// Прооверка для отправки заказа
if (isset($_POST) and $_SERVER["REQUEST_METHOD"]=="POST" and !isset($_COOKIE['customers_id'])) {

    $sql = "SELECT * FROM customers WHERE phone LIKE  '" . $_POST['phone'] . "'";
    $customer_id = 0;
    $result = $connect->query($sql);

    if($result->num_rows > 0) {
        $customer = mysqli_fetch_assoc($result);
        $customer_id = $customer['id'];

    } else {
        $sql = "INSERT INTO customers (first_name, last_name, phone, email) VALUES ('" . $_POST['first_naame'] . "', '" . $_POST['last_name'] . "', '" . $_POST['phone'] . "', '" . $_POST['email'] . "')";

        if($connect->query($sql)) {

            $customer_id = $connect->insert_id;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $basket = $_COOKIE['basket']; 
    $basket = json_decode($_COOKIE['basket'], true);

    $sql = "INSERT INTO orders (customer_id, service) VALUES ('" . $customer_id . "', '" . $_COOKIE['basket'] . "')";

    if($connect->query($sql)) {
        setcookie("basket", "", 0, "/");
        header("Location: /index.php");
        // Отправить сообщение о новом заказе в телеграм
        foreach (TELEGRAM_TOKEN as $chatid => $token) {
            message_to_telegram('New order!!!', $chatid, $token);
            }
        }
} else {
    $basket = $_COOKIE['basket']; 
    $basket = json_decode($_COOKIE['basket'], true);

    $sql = "INSERT INTO orders (customer_id, service) VALUES ('" . $_COOKIE['customers_id'] . "', '" . $_COOKIE['basket'] . "')";

    if($connect->query($sql)) {
        $basket = json_decode($_COOKIE['basket'], true);
        for($i = 0; $i < count($basket['basket']); $i++) {
            $sql = "SELECT * FROM services WHERE id=" . $basket['basket'][$i]['service_id'];
            $result = $connect->query($sql);
            $row = mysqli_fetch_assoc($result);
            $sum[$i] = $row['cost'] * $basket['basket'][$i]['count'];
        }
        $sum_order = ('Новый заказ на сумму ' .  array_sum($sum) . '$');

        setcookie("basket", "", 0, "/");
        header("Location: /index.php");
        // Отправить сообщение о новом заказе в телеграм
        foreach (TELEGRAM_TOKEN as $chatid => $token) {
        message_to_telegram($sum_order , $chatid, $token);
        }
    }
}
?>