<?php
include('db.php');
$query = 'SELECT current_year FROM su_table';
$year = mysqli_fetch_array(mysqli_query($db,$query),MYSQLI_ASSOC)['current_year'];
$fetch_query = 'SELECT * FROM year_table WHERE year_id='.$year;
$year_profile = mysqli_fetch_array(mysqli_query($db,$fetch_query),MYSQLI_ASSOC);
print(json_encode($year_profile));