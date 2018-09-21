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
        $insert_stmt->execute();
        $insert_stmt->close();

        $adv_avg = $input['adverts']/$input['qty'];
        $adv_score = (int)(($adv_avg-1)/2*100);
        $sl_score=(int)($input['selService']/6*100);
        $pkg_score=$input['packaging']==3 ? 100 : 0;
        if($input['sellcode']==0){
            $price_score=100;
        }
        elseif ($input['sellcode']==1){
            $price_score=50;
        }
        elseif ($input['sellcode']==2){
            $price_score=0;
        }
        else{
            $price_score=0;
        }

        $rank_sql='insert into score_table(uid, yid, pid, advertisement, service_level, packaging, price, score) VALUES (?,year_now(),?,?,?,?,?,score_gen(?,?,?,?,?))';
        $rank_stmt=$db->prepare($rank_sql);
        $rank_stmt->bind_param('iiiiiiiiiii',$_SESSION['login_user'],$input['pid'],$adv_score,$sl_score,$pkg_score,$price_score,$input['pid'],$adv_score,$sl_score,$pkg_score,$price_score);
        $rank_stmt->execute();
        $rank_stmt->close();

    }


}