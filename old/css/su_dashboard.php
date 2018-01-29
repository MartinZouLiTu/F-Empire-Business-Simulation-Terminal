<?php
	include('su_session.php');
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
<meta charset="utf-8">
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

	<div class="w3-container w3-red w3-card-8"><br>
    <div class="w3-container w3-white w3-round-medium">
    <h1>
Welcome to the Superuser Dashboard! Current Year:
<?php
		
	echo($year);
?>
	</h1>
<?php
	$info_column = mysqli_num_fields($info_table);
	$info_row = mysqli_num_rows($info_table);
	echo ("<p>Column: $info_column</p>");
	echo ("<p>Row: $info_row</p>");
	?>
<table border="1" class="w3-table w3-table-all">
	<thead>
		<tr>
			<th>user_id</th>
			<th>username</th>
			<th>cash</th>
			<th>loan</th>
			<th>decision_allowed</th>
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
					<td>'.$row['decision_allowed'].'</td>
				</tr>';
			}
		?>
	</tbody>
    <tfooter>
    	<tr>
        <td colspan="4">
        <form action = "" method = "POST">
      <label>Current Year :</label><input type = "text" name = "updated_year" class = "box"/>
      <input type = "submit" value = "Submit"/><br />
      <input type = "button" name "updated_year" value="1"/>
      </form>
        </td>
        </tr>
        <tr>
        <td>
        <a href="allow_all.php"><p>Allow Decision For All</p></a>
        <a href="disallow_all.php"><p>Deny Decision For All</p></a>
        
        </td>
        </tr>
    </tfooter>
</table><br>
	</div><br>
    </div>



<!--<form action = "" method = "POST">
      <label>Current Year :</label><input type = "text" name = "updated_year" class = "box"/>
      <input type = "submit" value = "Submit"/><br />
</form>-->
</body>
</html>
