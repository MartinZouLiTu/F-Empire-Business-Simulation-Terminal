<?php
   
   session_start();
   if($_SESSION['login_user'] == 'super_user'){
	   header("location: index.php");
   }
	else if(!isset($_SESSION['login_user'])){
      header("location: login.php");
   }
	else{
		include('config.php');
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select `username`,`cash`,`loan`,`cash`-`loan` as `real_cash`, `decision_allowed`, `company_name` from company.company_info where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql);

   $ses_year_sql = mysqli_query($db,"select current_year from company.su_table ");
   
   $year_array = mysqli_fetch_array($ses_year_sql);
	$year = $year_array['current_year'];

   $ses_table_sql = mysqli_query($db,"select * from company.year_table where year_id = '$year'");
   
   $table_array = mysqli_fetch_array($ses_table_sql);
	$news = $table_array['news'];
   
   $login_session = $row['username'];
	}
   
	
?>