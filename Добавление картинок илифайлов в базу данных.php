<?php

$server = $_SERVER['SERVER_ADDR'];
$username = 'root';
$password = '';
$dbname = 'img_upld';
$charset = 'utf8';

$connection = new mysqli($server, $username, $password, $dbname);

if($connection->connect_error){
	die("Ошибка соединения".$connection->connect_error);
}

if(!$connection->set_charset($charset)){
	echo "Ошибка установки кодировки UTF8";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Загрузка картинки в БД</title>
</head>

<body>
<form action="index.php" method="post" enctype="multipart/form-data">
<p>Загрузить картику</p>
<input type="file" name="img_upload"><input type="submit" name="upload" value="Загрузить">
<?php
	
if(isset($_POST['upload'])){
	$img_type = substr($_FILES['img_upload']['type'], 0, 5);
	$img_size = 2*1024*1024;
	if(!empty($_FILES['img_upload']['tmp_name']) and $img_type === 'image' and $_FILES['img_upload']['size'] <= $img_size){ 
	$img = addslashes(file_get_contents($_FILES['img_upload']['tmp_name']));
	$connection->query("INSERT INTO images (img) VALUES ('$img')");
	}
}
?>
</form>
<?php
	
	$query = $connection->query("SELECT * FROM images ORDER BY id DESC");
	while($row = $query->fetch_assoc()){
		$show_img = base64_encode($row['img']);?>
		<img src="data:image/jpeg;base64, <?=$show_img ?>" alt="">
	<?php } ?>
</body>
</html>