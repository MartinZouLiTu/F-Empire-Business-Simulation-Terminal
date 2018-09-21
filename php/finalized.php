<?php
include('db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
if(!isset($_SESSION['login_user'])){
    print('no_session');
}
else {
    $final_sql = 'update company_info set finalized_allowed=0 where user_id=?';
    $final_stmt = $db -> prepare($final_sql);
    $final_stmt->bind_param('i',$_SESSION['login_user']);
    $final_stmt->execute();
    $final_stmt->close();

    $log_sql='insert into log (uid, yid, company_value) values (?,year_now(), (select (cash+20) from company_info where user_id=?))';
    $log_stmt=$db->prepare($log_sql);
    $log_stmt->bind_param('ii',$_SESSION['login_user'],$_SESSION['login_user']);
    $log_stmt->execute();
    $log_sql->close();
}