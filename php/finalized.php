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
}