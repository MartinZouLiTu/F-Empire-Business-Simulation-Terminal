<?php
include('db.php');
$ranking_sql = 'select id,uid,yid,pid,score from score_table where yid=year_now() order by pid ASC , score DESC ';
$ranking_stmt = $db ->prepare($ranking_sql);
$ranking_stmt->execute();
$result = $ranking_stmt->get_result();
$output = $result->fetch_all(MYSQLI_ASSOC);
$ranking_stmt->close();
print(json_encode($output));