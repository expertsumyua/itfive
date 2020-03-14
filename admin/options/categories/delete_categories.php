<?php
include $_SERVER['DOCUMENT_ROOT'] . "/configs/db.php";

if(isset($_GET["id"])) {
	$sql = "SELECT * FROM category_services WHERE service_id =" . $_GET["id"];
	if(mysqli_query($connect, $sql)) {

		$sql_categories = "DELETE cs, s FROM category_services AS cs LEFT JOIN services AS s ON s.id = cs.service_id WHERE cs.service_id =" . $_GET["id"];
		mysqli_query($connect, $sql_categories);

	} else { 
		$sql_categories = "DELETE FROM categories WHERE categories . id=" . $_GET["id"];
		mysqli_query($connect, $sql_categories);
	}
    
    //var_dump($conn, $sql);
    include $_SERVER['DOCUMENT_ROOT'] . "/admin/categories_table.php";
}
?>