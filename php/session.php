<?php
session_start();
if(!isset($_SESSION['login_user'])){
    print('no_session');
}
else{
    $currentID=$_SESSION['login_user'];
    include('db.php');
    $currentYear = mysqli_fetch_array(mysqli_query($db,'select year_now() as year'))['year'];
    $query = 'SELECT username,company_name,cash,loan,decision_allowed,total_fac(???,0) as perm_fac, total_fac(???,!!!) as total_fac, year_now() as year,news_now() as news FROM company_info WHERE user_id=???';
    $query = str_replace('???',$currentID,$query);
    $query = str_replace('!!!',$currentYear,$query);
    $user_profile=mysqli_fetch_array(mysqli_query($db,$query),MYSQLI_ASSOC);
    print(json_encode($user_profile));
}