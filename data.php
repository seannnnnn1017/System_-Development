<?php
$db_host = "140.134.53.57";
$db_username = "root";
$db_password = "ahT?o7ah";
$database = "op23756778"; 

$con = mysqli_connect("$db_host", "$db_username", "$db_password", "$database");

if(!$con)
{
	die("連線失敗!!!!!");

	$ssql = "set names utf8";
	mysqli_query($con,$ssql);
}
?>