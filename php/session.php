<?php
session_start();
if(!isset($_SESSION['login_user'])){
    print('no_session');
}
else{
    $currentID=$_SESSION['login_user'];
    include('db.php');
    $query = 'SELECT username,company_name,cash,loan,decision_allowed FROM company_info WHERE user_id='.$currentID;
    $user_profile=mysqli_fetch_array(mysqli_query($db,$query),MYSQLI_ASSOC);
    print(json_encode($user_profile));
}