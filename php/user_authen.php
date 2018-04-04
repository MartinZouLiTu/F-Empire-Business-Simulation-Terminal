<?php
/*
 * method: POST
 * input: json_array{'username':username, 'password':password}
 * output: json_array{'id':id,'status':status}
 * status is 1 or 0
 * if status==0, id==0
 */
include('db.php');
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$input = json_decode(file_get_contents("php://input"),true);
$sql_prep='select user_id from company_info where username = ? and password = ?';
$stmt = $db -> prepare($sql_prep);
$stmt ->bind_param('ss',$input['username'],$input['password']);
if($stmt->execute()){
    $stmt->store_result();
    if($stmt->num_rows==1){
        $status=1;
        $stmt->bind_result($id_result);
        $stmt->fetch();
        $id=(int)$id_result;
        $_SESSION['login_user']=$id;
    }
    else{
        $status=0;
        $id=null;
    }
}
//if(
//    $stmt = mysqli_prepare($db,$sql_prep) and
//    mysqli_stmt_bind_param($stmt,'ss',$input['username'],$input['password']) and
//    mysqli_stmt_execute($stmt) and
//    mysqli_stmt_store_result($stmt)
//){
//    if(mysqli_stmt_num_rows($stmt)==1){
//        $status=1;
//        mysqli_stmt_bind_result($stmt, $id_result);
//        mysqli_stmt_fetch($stmt);
//        $id=(int)$id_result;
//        $_SESSION['login_user']=$id;
//    }
//    else{
//        $status = 0;
//        $id = null;
//    }
//
//}
$output = array('id'=>$id,'status'=>$status);
print(json_encode($output));