<?php	//Example 26-7: login.php
//=== Проверка осуществлен ли вход ======================================================================

	global $userLoggedIn;
	$userLoggedIn = FALSE;

	if (isset($_SESSION['usermail']))
	{
//		$usermail     = $_SESSION['usermail'];
		$userLoggedIn = TRUE;
	}
	else if (isset($_COOKIE['usermail']))
	{
		global $usermail;
		$usermail = $_COOKIE['usermail'];
		$_SESSION['usermail'] = $usermail;
		$userLoggedIn = TRUE;
	}
?>