<?php
$username = "root";
$password = "";
$database = "task";

if(!$con = mysqli_connect("localhost", $username, $password, $database))
{

	die("failed to connect!");
}


?>
