<?php
$server_address='localhost:3306';
$sql_user='admin';
$sql_password='picontrol';
$db_name='company';
$db=mysqli_connect($server_address,$sql_user,$sql_password,$db_name) or die('Error connecting to server');
mysqli_set_charset($db, "utf8");
?>