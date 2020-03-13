<?php
include '../../../configs/db.php';

if(isset($_GET["id"])) {
    $sql = "DELETE FROM categories WHERE categories . id=" . $_GET["id"];
    
    mysqli_query($connect, $sql);
    //var_dump($conn, $sql);
    include "../../products_table.php";
}
?>