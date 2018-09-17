<?php	//Example 26-7: login.php\
	require_once  'functions.php' ; 
	//=== Обратотка процесса входа. Он у нас в выпадающем окне, потому это нужно делать всегда ==============
	$mail = $pass = "";
	
	if(isset($_POST['usermail']))
	{
		$mail = sanitizeString($_POST['usermail']);
		$pass = sanitizeString($_POST['pass']);

		if ($mail == "" || $pass == "")
			echo "Заполните пожалуйста все поля<br>";
		else
		{
			$query = "SELECT * FROM users WHERE usermail='$mail' AND password=$pass";
			$result = $connection->query($query);

			if($result->num_rows == 0)
			{
				$status =  "Пользователь не зарегистрирован";

				$signin_message = "										
				<div class='alert alert-danger' role='alert' style='width: 100%; margin-bottom: 0;'>
					<div class='container'>
						<strong>$status</strong>
					</div>
				</div>";						// Выведем его под навбаром.
			}
			else
			{
				if (isset($_POST['remember']))
				{
					$status = "Галочку remember влупили. ";
					setcookie('usermail', $mail, time() + 60*60*24*366);
				}

				$_SESSION['usermail'] = $mail;
				$status =  "Вход выполнен пользователем ";

				$signin_message = "
				<div class='alert alert-success' role='alert' style='width: 100%; margin-bottom: 0;'>
					<div class='container'>
						<strong>$status</strong>$mail
					</div>
				</div>";						// Выведем его под навбаром

//				echo '<meta http-equiv="refresh" content="0" url="http://myblog/">';    
//				die();
			}    
		}       
	}

//=== Проверка осуществлен ли вход ======================================================================
	require_once  'log.php' ; 
?>