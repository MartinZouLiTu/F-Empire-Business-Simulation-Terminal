<?php
include('db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$result=mysqli_query($db,'select user_id, username, company_name, cash from company_info');
print(json_encode(mysqli_fetch_all($result,MYSQLI_ASSOC)));