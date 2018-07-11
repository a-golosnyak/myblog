<?php	//Example 26-7: login.php

require_once  'functions.php' ; 

//=== Обратотка процесса входа. Он у нас в выпадающем окне, потому это нужно делать всегда ==============
$user = $pass = "";

	if(isset($_POST['user']))
	{
		$user = sanitizeString($_POST['user']);
		$pass = sanitizeString($_POST['pass']);

		if ($user == "" || $pass == "")
			echo "Заполните пожалуйста все поля<br>";
		else
		{
			$query = "SELECT * FROM users WHERE user='$user' AND password=$pass";
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
					setcookie('user', $user, time() + 60*60*24*366);
				}

				$_SESSION['user'] = $user;
				$status =  "Вход выполнен пользователем";

				$signin_message = "
				<div class='alert alert-success' role='alert' style='width: 100%; margin-bottom: 0;'>
					<div class='container'>
						<strong>$status</strong>$userstr
					</div>
				</div>";						// Выведем его под навбаром

//				echo '<meta http-equiv="refresh" content="0" url="http://myblog/">';    
//				die();
			}    
		}       
	}

//=== Проверка осуществлен ли вход ======================================================================
	$userstr = '(Guest)';
	$userLoggedIn = FALSE;

	if (isset($_SESSION['user']))
	{
		$user     = $_SESSION['user'];
		$userLoggedIn = TRUE;
		$userstr  = "($user)";
	}
	else if (isset($_COOKIE['user']))
	{
		$user = $_COOKIE['user'];
		$_SESSION['user'] = $user;
		$userLoggedIn = TRUE;
		$userstr  = "($user)";
	}
?>