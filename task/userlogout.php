<?php

session_start();

if(isset($_SESSION['UserId']))
{
	session_destroy();

}

header("Location: userlogin.php");
die;

?>