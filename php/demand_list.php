<?php
include('db.php');
$demand_sql = 'select * from demand where pid=year_now()';
$demand_stmt = $db ->prepare($demand_sql);
$demand_stmt->execute();
$result = $demand_stmt->get_result();
$output = $result->fetch_all(MYSQLI_ASSOC);
$demand_stmt->close();
print(json_encode($output));