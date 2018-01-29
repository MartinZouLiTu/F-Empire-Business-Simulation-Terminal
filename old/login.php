<?php
	include('config.php');
	session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT user_id FROM company.company_info WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         $_SESSION['login_user'] = $myusername;
         
         header("location: dashboard.php");
		 
      }else {
         $error = "Your Login Name or Password is invalid";
		 
      }
   }

?>


<html>
   
   <head>
      <title>Login</title>
      <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
      <link href="css/w3.css" rel="stylesheet" type="text/css">
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
    <h1 align="center">User Login</h1>
    </div>
    </pageheading>
    <navpanel>
    <div class="w3-navbar w3-card-4 w3-light-grey">
  		<li><a href="index.php">Home</a></li>
  		<li class="w3-right"><a class="w3-blue" href="">Login</a></li>
        <li><a href="http://www.desheng-school.com/">Desheng School</a></li>
        <li><a class="w3-hover-light-grey" href="su_login.php"></a></li>
	</div>
    <br>
    </navpanel>
        
        <div class="w3-container w3-blue w3-card-4">
				
            <div class="w3-container" align="center"><br>
            <div class="w3-container w3-pale-blue" style="width:100%;">
               <h4>F-Empire User Account Login</h4><br>
               <img src="img/anoavatar.png" width="20%"><br><br>
              
               <form action = "" method = "POST">
                  
                  <label class="w3-container">Username</label><input class="w3-container" type = "text" name = "username" class = "box"/><br /><br />
                  <label class="w3-container">Password</label><input class="w3-container" type = "password" name = "password" class = "box"/><br/><br />
                  <input class="w3-light-grey w3-hover-green" type = "submit" value = " Submit "/><br />
               </form>
               
               <div><?php echo $error; ?></div><br>
               </div><br>
	  		</div>
		</div>
   </body>
</html>