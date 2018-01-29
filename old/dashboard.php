<?php
   include('session.php');
?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
<title><?php echo($row['username']); ?> | Dashboard</title>
<link href="css/w3.css" rel="stylesheet" type="text/css">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<script language="JavaScript" Type="text/javascript">
<!--
function popupMsg(theMsg) {
alert(theMsg);
}
//-->
</script>
</head>

<body>
	<pageheading>
    <div class="w3-container w3-indigo">
    <h1 align="center">User Dashboard</h1>
    </div>
    </pageheading>
    <navpanel>
    <div class="w3-navbar w3-card-4 w3-light-grey">
  		<li><a class="w3-green" href=""><i class="fa fa-home"></i></a></li>
        <li><a class="w3-hover-light-grey">Welcome, <?php echo($row['username']); ?>!</a></li>
        <li class="w3-right"><a class="w3-hover-blue-grey" href="dashboard.php">Refresh</a></li>
        <li><a href="http://www.desheng-school.com/">Desheng School</a></li>
        <li class="w3-right"><a class="w3-hover-red" href="logout.php">Log out</a></li>
	</div>
    <br>
    </navpanel>
	
    <content>    
    <div class="w3-container w3-indigo">
<h3 align="center">Current News</h3></div>

<div class="w3-container w3-blue"><br>
<div class="w3-container w3-white">
	<p>  Current Year: <?php echo $year;?></p>
    <p><?php echo $news;?></p>
        <br><br>
</div><br>
</div>
    
    <div class="w3-container w3-indigo">
<h3 align="center">Company Information</h3></div>

<div class="w3-container w3-blue"><br>
<div class="w3-container w3-white">
	<div class="w3-container w3-center">
		<h5>Company Name	:</h5>	<?php echo($row['company_name']); ?>
        <h5>Company Value	:</h5>	USD <?php echo($row['cash']); ?>
        <h5>Debt			:</h5>	USD <?php echo($row['loan']); ?>
        <h5>Real Value		:</h5>	USD <?php echo($row['real_cash']); ?>
    </div>
        <br>
</div><br>
</div>
    </div>
    
	<a class="w3-btn-block w3-green w3-padding-16" href="decision.php">
    Next	
    <i class="fa fa-arrow-circle-right"></i>
    </a>
</div>
	</content><br>   

<pagefooter>
<div class="w3-container w3-indigo" style="width:100%"><br>

    <div style="color:white; font:9px" align="center">
    Copyright 2017 - All Rights Reserved
    <br>
    Developed by 
    <a href="mailto:martyzou20010126@outlook.com">Martin Zou</a> (MoniView Studio) 
    and 
    <a href="mailto:josephthen3320@outlook.com">Joseph M Thenara</a> (JT Studio)
    </div><br>
    
    </div>
 </pagefooter>


<script>
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>
