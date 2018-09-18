<?php
include('db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
if(!isset($_SESSION['login_user'])){
    print('no_session');
}
else {

    $output = array();
    $input = json_decode(file_get_contents("php://input"), true);

    $occu_sql = 'update demand set occu=1 where id=?';
    $occu_stmt = $db -> prepare($occu_sql);
    $occu_stmt->bind_param('i',$input['id']);
    $occu_stmt->execute();
    $occu_stmt->close();
    $output[0]=1;


    $insert_sql='insert into action (uid, yid, pid, price, add_ads, service_level, pkg, qty) VALUES (?,year_now(),?,?,0,0,0,?)';
    $insert_stmt=$db->prepare($insert_sql);
    $insert_stmt->bind_param('iii',$_SESSION['login_user'],$input['pid'],-$input['id'],-$input['qty']);
    $insert_stmt->execute();
    $insert_stmt->close();
    $output[1]=1;

    $alter_sql='update company_info set cash=cash+current_price(?,?)*?, decision_allowed=0 where user_id=? ';
    $alter_stmt=$db->prepare($alter_sql);
    $alter_stmt->bind_param('iiii',$_SESSION['login_user'],$input['pid'],$input['qty'],$_SESSION['login_user']);
    $alter_stmt->execute();
    $alter_sql->close();
    $output[2]=1;

    print(json_encode($output));
}