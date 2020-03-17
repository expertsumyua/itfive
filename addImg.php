<?php

// $server = $_SERVER['SERVER_ADDR'];
// $username = 'root';
// $password = '';
// $dbname = 'img_upld';
// $charset = 'utf8';

// $connection = new mysqli($server, $username, $password, $dbname);

// if($connection->connect_error){
// 	die("Ошибка соединения".$connection->connect_error);
// }

// if(!$connection->set_charset($charset)){
// 	echo "Ошибка установки кодировки UTF8";
// }

/*============ Базовый фукционал: база данных ============*/
    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
/*========================================================*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Загрузка картинки в БД</title>
</head>

<body>
<form action="addImg.php" method="post" enctype="multipart/form-data">
<p>Загрузить картику</p>
<input type="file" name="img_upload"><input type="submit" name="upload" value="Загрузить">
<?php
	
if(isset($_POST['upload'])){
	$img_type = substr($_FILES['img_upload']['type'], 0, 5);
	$img_size = 2*1024*1024;
	if(!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] <= $img_size){ 
		//$img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
		//$connect->query("INSERT INTO services (img) VALUES ('$img')");
		$wach_img = file_get_contents($_FILES['img_upload']['tmp_name']);
		//var_dump($img);
    	// Добаляем в куки данные
    	//setcookie("img", $img, time() + 60*60, "/"); 
		//	
	}
}
?>
</form>
<?php
	
	//$query = $connect->query("SELECT * FROM services ORDER BY id DESC");
	//while($row = $query->fetch_assoc()){
		//$show_img = base64_encode($row['img']);
	//if(isset($_COOKIE['img'])) {
//$img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
		$show_img = base64_encode($img);
		// var_dump($show_img);
		//setcookie("img", "", 0, "/");

?>
		<img src="data:image/jpeg;base64, <?=$show_img ?>" alt="">
<?php
	//} 
?>
</body>
</html>