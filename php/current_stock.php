<?php
include('db.php');
$output=array();
session_start();
$currentID=$_SESSION['login_user'];
$request_sql = "select sum(qty) from `action` where uid=?";
$request_stmt = $db ->prepare($request_sql);
$request_stmt->bind_param('i',$currentID);
$request_stmt->execute();
$request_stmt->bind_result($result);
$request_stmt->fetch();
$result=$result==null ? 0 : $result;
array_push($output,(int)$result);
$request_stmt->close();
for($i=1;$i<=5;$i++){
    $request_sql = "select sum(qty) from `action` where uid=? and pid=?";
    $request_stmt = $db ->prepare($request_sql);
    $request_stmt->bind_param('ii',$currentID,$i);
    $request_stmt->execute();
    $request_stmt->bind_result($result);
    $request_stmt->fetch();
    $result=$result==null ? 0 : $result;
    array_push($output,(int)$result);
    $request_stmt->close();
}


print(json_encode($output));