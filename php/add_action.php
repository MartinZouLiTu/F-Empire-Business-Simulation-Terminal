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
    $insert_sql='insert into action (uid, yid, pid, price, add_ads, service_level, pkg, qty) VALUES (?,year_now(),?,?,?,?,?,?)';
    $insert_stmt=$db->prepare($insert_sql);
    $insert_stmt->bind_param('iiiiiii',$_SESSION['login_user'],$input['pid'],$input['sellcode'],$input['adverts'],$input['selService'],$input['packaging'],$input['qty']);
    if($insert_stmt->execute()){
        print true;
    }
    else{
        print false;
    }

}