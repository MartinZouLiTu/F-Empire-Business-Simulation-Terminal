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


    $log_sql='insert into log (uid, yid, company_value) values (?,year_now(), (select (cash+20) from company_info where user_id=?))';
    $log_stmt=$db->prepare($log_sql);
    $log_stmt->bind_param('ii',$_SESSION['login_user'],$_SESSION['login_user']);
    $log_stmt->execute();
    $log_sql->close();


}