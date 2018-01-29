<?php
	include('su_session.php');
	require_once('mDetect/Mobile_Detect.php');
		$detect = new Mobile_Detect;
		if($detect -> isMobile()){
			header("location: su_dashboard_mobile.php");
		}
	if($_SERVER["REQUEST_METHOD"] == "POST") { 
      $updated_year = mysqli_real_escape_string($db,$_POST['updated_year']);
      
      if($updated_year >= 1 && $updated_year <= 4) {
         
         $year_change_cmd = "update company.su_table set current_year='$updated_year'";
		 mysqli_query($db,$year_change_cmd);
         
         header("location: su_dashboard.php");
		 
      }
		
   }
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link href="css/w3.css" rel="stylesheet" type="text/css">
<script language="JavaScript" Type="text/javascript">
<!--
function popupMsg(theMsg) {
alert(theMsg);
}

//-->
</script>

<title>SuperUser Dashboard</title>
</head>

<body>

	<pageheading>
    <div class="w3-container w3-red">
    <h1 align="center">SuperUser Dashboard</h1>
    </div>
    </pageheading>
    <navpanel>
    <div class="w3-navbar w3-card-4 w3-light-grey">
  		<li class="w3-left"><a class="w3-green" href="">SU Dashboard</a></li>
        <li class="w3-right"><a class="w3-hover-red" href="logout.php">Log out</a></li>
        <li class="w3-right"><a class="w3-hover-blue-grey" href="">Refresh</a></li>
        <li class="w3-left"><a class="w3-hover-light-grey">Welcome, Super_User!</a></li>
	</div>
    <br>
    </navpanel>
    
    <div class="w3-container w3-red w3-center">
    <h3>Current Year<br>
    <?php echo($year); ?></h3>
    </div><br>
    
    <div class="w3-container w3-blue-grey">
    <h3 class="w3-center">Decision for All</h3>
    <div class="w3-container w3-quarter">
    <!--empty div-->
    </div>
    <div class="w3-container w3-center w3-half">
    	<a class="w3-btn-block w3-border w3-border-grey w3-round-xlarge w3-light-grey w3-hover-green w3-half" href="allow.php"><h4>Allow</h4></a>
        <a class="w3-btn-block w3-border w3-border-grey w3-round-xlarge w3-light-grey w3-hover-red w3-half" href="disallow.php"><h4>Deny</h4></a><br><br><br><br>
        </div><br>
    </div>
    <div class="w3-container w3-quarter">
    <!--empty div-->
    </div><br>

	<div class="w3-container w3-red w3-card-8">
    <h3 class="w3-center">User Data</h3>
    <div class="w3-container w3-white w3-round-medium"><br>
<table border="1" class="w3-table w3-table-all" width="100%">
	<thead>
		<tr>
			<th>user_id</th>
			<th>username</th>
			<th>cash</th>
			<th>loan</th>
			<th>decision_allowed</th>
			<th>Dbutton</th>
		</tr>
	</thead>
	<tbody>
		<?php
			while($row = mysqli_fetch_array($info_table)){
				echo '<tr>
					<td>'.$row['user_id'].'</td>
					<td>'.$row['username'].'</td>
					<td>'.$row['cash'].'</td>
					<td>'.$row['loan'].'</td>
					<td>'.$row['decision_allowed'].'</td>';
					echo
					'<td><a class="w3-btn w3-border w3-border-grey w3-round-xlarge w3-light-grey w3-hover-green" href="allow.php?'.$row['user_id'].'">Allow</a>
        			<a class="w3-btn w3-border w3-border-grey w3-round-xlarge w3-light-grey w3-hover-red" href="disallow.php?'.$row['user_id'].'">Deny</a>
				</td></tr>';
			}
		?>
	</tbody>
    <tfooter>
    	<tr>
        <td colspan="4">
        <form action = "" method = "POST">
      <label>Current Year :</label><input type = "text" name = "updated_year" class = "box"/>
      <input type = "submit" value = "Submit"/><br />
      </form>
        </td>
        </tr>
    </tfooter>
</table><br>
	</div><br>
    </div><br>

	<div class="w3-container w3-black">
    <h3 class="w3-center">Debugging</h3>
    <p>
	<?php
	echo ("<p>Column: $info_column</p>");
	echo ("<p>Row: $info_row</p>");
	?>
    </p>
    </div>


</body>
</html>





