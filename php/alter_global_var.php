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

    $deduct_sql = 'update company_info set cash=cash-?+? where user_id=?';
    $deduct_stmt = $db -> prepare($deduct_sql);
    $deduct_stmt ->bind_param('iii',$input['globalCost'],$input['loanAdd'],$_SESSION['login_user']);
    $deduct_stmt ->execute();
    $deduct_stmt ->close();

    $loan_sql = 'update company_info set loan=loan+? where user_id=?';
    $loan_stmt = $db->prepare($loan_sql);
    $loan_stmt->bind_param('ii',$input['loanAdd'],$_SESSION['login_user']);
    if($loan_stmt->execute()){$output['loan']=1;}
    else{$output['loan']=0;}
    $loan_stmt->close();

    $perm_sql = 'insert into factory values (?,0,?)';
    $perm_stmt=$db->prepare($perm_sql);
    $perm_stmt->bind_param('ii',$_SESSION['login_user'],$input['factory_buy']);
    if($perm_stmt->execute()){$output['perm']=1;}
    else{$output['perm']=0;}
    $perm_stmt->close();

    $temp_sql = 'insert into factory values (?,year_now(),?)';
    $temp_stmt=$db->prepare($temp_sql);
    $temp_stmt->bind_param('ii',$_SESSION['login_user'],$input['factory_rent']);
    if($temp_stmt->execute()){$output['temp']=1;}
    else{$output['temp']=0;}
    $temp_stmt->close();
}