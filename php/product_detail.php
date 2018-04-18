<?php
include('db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
if(!isset($_SESSION['login_user'])){
    print('no_session');
}
else {
    $user= $_SESSION['login_user'];
    $output = array();
    $data_sql_prep = 'SELECT *, max_sl(?,?) as maxService, check_save(?,?) as isSave FROM product WHERE pid=?';
    $demand_sql_prep = 'SELECT demand FROM year_table WHERE year_id = year_now()';
    $demand_stmt = $db->prepare($demand_sql_prep);
    $demand_stmt->execute();
    $demand_stmt->bind_result($demand);
    $demand_stmt->fetch();
    $d = explode(',', $demand);
    $demand_stmt->close();
    for ($i = 0; $i < count($d); $i++) {
        $pid = $i + 1;
        $item = (int)$d[$i];
        if ($item != 0) {
            $stmt = $db->prepare($data_sql_prep);
            $stmt->bind_param('iiiii', $user,$pid,$user,$pid,$pid);
            $stmt->execute();
            $result = $stmt->get_result();
            $result_array = $result->fetch_array(MYSQLI_ASSOC);
            $priceArray = array();
            foreach (explode(',', $result_array['priceLevel']) as $priceItem) {
                array_push($priceArray, (int)$priceItem);
            }
            $result_array['priceLevel'] = $priceArray;
            $stmt->close();

            array_push($output, $result_array);
        }
    }
    print(json_encode($output));
}