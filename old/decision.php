<!doctype html>
<?php
	include('session.php');
	if($row['decision_allowed'] = 'NO'){
		header("location: error_not_available.php");
	}
?>
<html>
<head>
<meta charset="utf-8">
<title>Decision - <?php echo($row['username']);?></title>
</head>

<body>
<h1>Decision Form - <?php echo($row['username']);?></h1>
</body>
</html>