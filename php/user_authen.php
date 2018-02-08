<?php
/*
 * method: POST
 * input: json_array{'username':username, 'password':password}
 * output: json_array{'id':id,'status':status}
 * status is 1 or 0
 * if status==0, id==0
 */
include('db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$input = json_decode(file_get_contents("php://input"),true);
$sql='select user_id from company_info where username ="'.$input['username'].'"and password ="'.$input['password'].'"';
$result = mysqli_query($db,$sql);
$id = (int)mysqli_fetch_array($result,MYSQLI_ASSOC)['user_id'];
$status=mysqli_num_rows($result)==1 ? 1 : 0;
$output = array('id'=>$id,'status'=>$status);
print(json_encode($output));