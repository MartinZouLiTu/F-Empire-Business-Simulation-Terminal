<?php
include('db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
$output=array();
$data_sql_prep='select * from product where pid=?';
$demand_sql_prep='select demand from year_table where year_id in (select current_year from su_table where user_id=99)';
$demand_stmt = $db->prepare($demand_sql_prep);
$demand_stmt->execute();
$demand_stmt->bind_result($demand);
$demand_stmt->fetch();
$d=explode(',',$demand);
$demand_stmt->close();
for ($i=0;$i<5;$i++){
    $pid=$i+1;
    $item=(int)$d[$i];
    if($item!=0){
        $stmt=$db->prepare($data_sql_prep);
        $stmt->bind_param('i',$pid);
        $stmt->execute();
        $result= $stmt->get_result();
        array_push($output,$result->fetch_array(MYSQLI_ASSOC));
    }
}
print(json_encode($output));