<?php
include('db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
if(!isset($_SESSION['login_user'])){
    print('no_session');
}
else {

    $output=array();
    $input = json_decode(file_get_contents("php://input"),true);

    $deduct_sql = 'update company_info set cash=cash-? where user_id=?';
    $deduct_stmt = $db -> prepare($deduct_sql);
    $deduct_stmt ->bind_param('ii',$input['globalCost'],$_SESSION['login_user']);
    $deduct_stmt ->execute();
    $deduct_stmt ->close();



    $temp_sql = 'insert into factory(uid, type, qty) values (?,year_now()+1,?)';
    $temp_stmt=$db->prepare($temp_sql);
    $temp_stmt->bind_param('ii',$_SESSION['login_user'],$input['factory_rent']);
    if($temp_stmt->execute()){$output['temp']=1;}
    else{$output['temp']=0;}
    $temp_stmt->close();
}