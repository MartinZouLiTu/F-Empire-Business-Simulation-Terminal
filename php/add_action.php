<?php
include('db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
if(!isset($_SESSION['login_user'])){
    print('no_session');
}
else{
    $input = json_decode(file_get_contents("php://input"),true);
    $check_sql='select check_save(?,?) as isSave';
    $check_stmt=$db->prepare($check_sql);
    $check_stmt->bind_param('ii',$_SESSION['login_user'],$input['pid']);
    $check_stmt->bind_result($isSave);
    $check_stmt->execute();
    $check_stmt->fetch();
    if($isSave==0){
        $check_stmt->close();
        $deduct_sql = 'update company_info set cash=cash-? where user_id=?';
        $deduct_stmt = $db -> prepare($deduct_sql);
        $deduct_stmt ->bind_param('ii',$input['totalCost'],$_SESSION['login_user']);
        $deduct_stmt ->execute();
        $deduct_stmt ->close();
        $insert_sql='insert into action (uid, yid, pid, price, add_ads, service_level, pkg, qty) VALUES (?,year_now(),?,?,?,?,?,?)';
        $insert_stmt=$db->prepare($insert_sql);
        $insert_stmt->bind_param('iiiiiii',$_SESSION['login_user'],$input['pid'],$input['sellcode'],$input['adverts'],$input['selService'],$input['packaging'],$input['qty']);
        if($insert_stmt->execute()){
            print (1);
        }
        else{
            print (0);
        }
    }
    else{
        print (0);
    }

}