<?php	//Example 26-7: login.php
//=== Проверка осуществлен ли вход ======================================================================
	$userstr = '(Guest)';
	global $userLoggedIn;
	$userLoggedIn = FALSE;

	if (isset($_SESSION['usermail']))
	{
		$usermail     = $_SESSION['usermail'];
		$userLoggedIn = TRUE;
		$userstr  = "($usermail)";
	}
	else if (isset($_COOKIE['usermail']))
	{
		$usermail = $_COOKIE['usermail'];
		$_SESSION['usermail'] = $usermail;
		$userLoggedIn = TRUE;
		$userstr  = "($usermail)";
	}
?>