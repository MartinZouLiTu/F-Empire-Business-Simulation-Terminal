<?php
	include("su_session.php");
	if(empty($_SERVER["QUERY_STRING"])){
	mysqli_query($db,"update company.company_info set decision_allowed = 'YES'");
	header("location: su_dashboard.php");}
	else if($_SERVER['QUERY_STRING']<=$info_row and $_SERVER['QUERY_STRING']>=1){
		$selected_id = $_SERVER['QUERY_STRING'];
		mysqli_query($db,"update company.company_info set decision_allowed = 'YES' where user_id=$selected_id");
		header("location: su_dashboard.php");
	}
	else{header("location: su_dashboard.php");}
?>
<html>
	<head>
		<title>Allow</title>
	</head>
	<body>
		<?php
			echo "rewrite: ".$_GET["rewrite"];  
			echo "<br>SERVER_PORT: ".$_SERVER["SERVER_PORT"];  
			echo "<br>HTTP_HOST: ".$_SERVER["HTTP_HOST"];  
			echo "<br>SERVER_NAME: ".$_SERVER["SERVER_NAME"];  
			echo "<br>REQUEST_URI: ".$_SERVER["REQUEST_URI"];  
			echo "<br>PHP_SELF: ".$_SERVER["PHP_SELF"];  
			echo "<br>QUERY_STRING: ".$_SERVER["QUERY_STRING"];  
			echo "<br>HTTP_REFERER: ".$_SERVER["HTTP_REFERER"]."<br>";  
			echo empty($_SERVER["QUERY_STRING"]);
		?>
	</body>
</html>