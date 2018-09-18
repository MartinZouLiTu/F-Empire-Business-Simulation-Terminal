<?php
include('db.php');
$pid=$_GET['pid'];
$count_sql = 'select count(*), sum(qty) from action where yid=year_now() and pid=?';
$insert_sql = 'insert into demand(yid, pid, qty, occu) values (year_now(),?,?,0)';
$count_stmt = $db -> prepare($count_sql);
$count_stmt->bind_param('i',$pid);
$count_stmt->bind_result($count,$sum);
$count_stmt->execute();
$count_stmt->fetch();
$count_stmt->close();
$sum=(int)$sum;
$qty_array=array();
$count *= 2;
$sum *= 2;
//initiator of an array
for($n=0;$n<$count;$n++){
    $qty_array[$n]=1;
}

for($i=0;$i<($sum-$count);$i++){
    //Give sum to array_sum
    $array_sum=0;
    for($m=0;$m<$count;$m++){
        $array_sum += $qty_array[$m];
    }

    //Randomize
    $rand_num = rand(1,$array_sum);

    //Identify
    $array_clone=$qty_array;
    $index=0;
    for($num=1;$num<$rand_num;$num++){
        $array_clone[$index]--;
        if($array_clone[$index]==0){
            $index++;
        }
    }

    $qty_array[$index]++;


}

//insert
for($i=0;$i<count($qty_array);$i++){
    $insert_stmt = $db->prepare($insert_sql);
    $insert_stmt->bind_param('ii',$pid,$qty_array[$i]);
    $insert_stmt->execute();
    $insert_stmt->close();
}

echo json_encode($qty_array);

