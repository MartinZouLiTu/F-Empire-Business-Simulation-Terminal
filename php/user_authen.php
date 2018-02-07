<?php
include('db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$input = json_decode(file_get_contents("php://input"),true);
$sql='select user_id from company_info where username ="'.$input['username'].'"and password ="'.$input['password'].'"';
$result = mysqli_query($db,$sql);
print(mysqli_num_rows($result)==1 ? 1 : 0);