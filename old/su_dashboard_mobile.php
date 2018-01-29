<?php
	include('su_session.php');
	if($_SERVER["REQUEST_METHOD"] == "POST") { 
      $updated_year = mysqli_real_escape_string($db,$_POST['updated_year']);
      
      if($updated_year >= 1 && $updated_year <= 4) {
         
         $year_change_cmd = "update company.su_table set current_year='$updated_year'";
		 mysqli_query($db,$year_change_cmd);
         
         header("location: su_dashboard_mobile.php");
		 
      }
   }
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<link href="css/w3.css" rel="stylesheet" type="text/css">
<!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"-->

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
    <div class="w3-container w3-red w3-animate-top">
    <h1 align="center">SuperUser Dashboard</h1>
    </div>
    </pageheading>
    <navpanel>
    <div class="w3-navbar w3-card-4 w3-light-grey ">
  		<li><a class="w3-green w3-animate-left" href=""><i class="fa fa-home"></i></a></li>
        <li class="w3-center w3-animate-right"><a class="w3-blue w3-center" href=""><i class="fa fa-refresh"></i></a></li>
        <li class="w3-right w3-animate-left"><a class="w3-text-red" href="logout.php"><i class="fa fa-sign-out"></i></a></li>
	</div>
    <br>
    </navpanel>

	<div class="w3-container w3-red w3-center w3-animate-right">
    <h3>Current Year<br></h3><h3 class=""><?php echo($year); ?></h3>
    </div><br>
	<div class="w3-container w3-red"><br>
    <div class="w3-container w3-white w3-round-medium">
<?php
	$info_column = mysqli_num_fields($info_table);
	$info_row = mysqli_num_rows($info_table);
	echo ("<p>Column: $info_column</p>");
	echo ("<p>Row: $info_row</p>");
	?>
    <div class="w3-container">
<table border="1" class="w3-table-all" width="100%">
		<thead>
		<tr>
			<th width="10%">user_id</th>
			<th width="30%">username</th>
			<th width="60%">information</th>
			
		</tr>
	</thead>
	<tbody>
		<?php
			while($row = mysqli_fetch_array($info_table)){
				echo '<tr>
					<td rowspan="3" width="10%"><p>'.$row['user_id'].'</p><br>
					<a class="w3-btn-block w3-border w3-border-grey w3-round-xlarge w3-light-grey w3-hover-green " href="allow.php?'.$row['user_id'].'">Allow</a>
        			<a class="w3-btn-block w3-border w3-border-grey w3-round-xlarge w3-light-grey w3-hover-red" href="disallow.php?'.$row['user_id'].'">Deny</a>
					</td>
					<td rowspan="3" width="30%"><p>'.$row['username'].'</p></td>
					<td width="60%"><p>Cash:</p><p>'.$row['cash'].'</p></td>
				</tr>
				<tr>
					<td>
					<p>Loan:</p><p>'.$row['loan'].'</p>
					</td>
				</tr>
					<td>
					<p>D Allowed:</p><p>'.$row['decision_allowed'].'</p>
					</td>
				<tr>
				
				</tr>';
			}
		?>
	</tbody>
	</table><br>
	</div>
    </div><br>
    </div><br>
    <div class="w3-container w3-blue w3-center"><br>
    <form action = "" method = "POST">
    <label>Change Year</label>
    <input class="w3-input w3-center" type = "text" name = "updated_year" class = "box"/>
    <label>(Currently: <?php echo($year); ?>)</label>
    <br><br>
    <input class="w3-btn-block w3-round-xlarge w3-padding-12 w3-hover-green w3-light-grey" type = "submit" value = "Submit"/>
    </form><br>
    </div><br>
    <div class="w3-container w3-red w3-center">
    <h3>Decision</h3>
        <a class="w3-btn-block w3-border w3-border-grey w3-round-xlarge w3-light-grey w3-hover-green" href="allow.php"><h4>Allow All</h4></a><br><br>
        <a class="w3-btn-block w3-border w3-border-grey w3-round-xlarge w3-light-grey w3-hover-red" href="disallow.php"><h4>Deny All</h4></a><br><br>
    </div>



</body>
</html>
