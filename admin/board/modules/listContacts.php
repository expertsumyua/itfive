<?php
// echo "<pre>";
// var_dump($number_of_users);
// echo "</pre>";
// die();
?>

<ul>

	<?php
		if (isset($_COOKIE["user_id"])) {
			// прописал строку (текст) для получения списка всех пользователей кроме авторизированного
			$sql_board_users = "SELECT * FROM `board_users` WHERE board_id=" . $_GET["board"];
			// mysqli_query - выполнить sql запрос
			// 2 параметра: 1 - подключение к БД, 2 - sqlскрипт
			$result_board_users = mysqli_query($connect, $sql_board_users);
			//  mysqli_num_rows - получить количество результатов
			$number_of_board_users = mysqli_num_rows($result_board_users);
			// $i - счетчик для подсчёта количества пользователей
			$i = 0;
			// пока в переменной i хранится занчение меньше чем количество пользователе
			while ($i < $number_of_board_users) {
				
				// mysqli_fetch_assoc - преобразовывает полученные данные (результирующй ряд или строку из таблицы) пользователя в массив				
				$user_in_board = mysqli_fetch_assoc($result_board_users);
				
				$sql_u = "SELECT * FROM `users` WHERE id=" . $user_in_board["user_id"];

				// mysqli_query - выполнить sql запрос
				// 2 параметра: 1 - подключение к БД, 2 - sqlскрипт
				$result_u = mysqli_query($connect, $sql_u);
				$user = mysqli_fetch_assoc($result_u);
				$sql_b_users = "SELECT * FROM board_users WHERE board_id=" . $_GET["board"] . " AND user_id=" . $user["id"];
				$result_b_users = mysqli_query($connect, $sql_b_users);
				$user_in_b = mysqli_fetch_assoc($result_b_users);
				if ($user_in_b["access"] == 1) {
					$rights = "Разработчик";
				} else if ($user_in_b["access"] == 2) {
					$rights = "Тестировщик";
				} else if ($user_in_b["access"] == 3) {
					$rights = "Модератор";
				}
	?>
				<li>

					<a href="http://doska.local/options/addmember.php?board=<?php echo $_GET["board"]?>&addmember&user= <?php echo $user["id"] ?> ">
						<div class = "avatar">
								<img src=' ../<?php echo $user["photo"]; ?> '>
							</div>
						<h2><?php echo $user["name"] ?></h2>
						<span><?php echo $user["email"] ?></span>						
						<!-- <div class = "time">09:10</div> -->
						<p><?php echo $rights ?></p>						
					</a>
				</li>
	<?php
				$i++;
			}
		}
	?>
</ul>