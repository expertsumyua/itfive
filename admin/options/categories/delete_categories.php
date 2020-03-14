<?php
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

if(isset($_GET["id"])) {
    $sql = "DELETE FROM categories WHERE categories . id=" . $_GET["id"];
    
    mysqli_query($connect, $sql);
    //var_dump($conn, $sql);
    include $_SERVER['DOCUMENT_ROOT'] . "/admin/categories_table.php";
}
?>