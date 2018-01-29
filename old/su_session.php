<?php
   
   session_start();
   if($_SESSION['login_user'] != 'super_user'){
      header("location: login.php");
   }
   else{
	include('config.php');
   $ses_sql = mysqli_query($db,"select current_year from company.su_table");
   
   $year_array = mysqli_fetch_array($ses_sql);
   
   $year = $year_array['current_year'];

   $info_table = mysqli_query($db,"select * from company.company_info");
   
   $info_column = mysqli_num_fields($info_table);
	$info_row = mysqli_num_rows($info_table);
   }
   
?>