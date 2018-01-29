<?php
	include('config.php');
	session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT user_id FROM company.su_table WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         $_SESSION['login_user'] = $myusername;
         
         header("location: su_dashboard.php");
		 
      }else {
         $error = "Your Login Name or Password is invalid";
		 
      }
   }

?>


<html>
   
   <head>
   <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
   <link href="css/w3.css" rel="stylesheet" type="text/css">
   <title>SU | Login</title>
   </head>
   
   <body>
   
   <pageheading>
    <div class="w3-container w3-red">
    <h1 align="center">SuperUser Login</h1>
    </div>
    </pageheading>
    <navpanel>
   <div class="w3-navbar w3-card-4 w3-light-grey">
  		<li><a href="index.php">Index</a></li>
	</div>
    <br>
    </navpanel>
    
    <content>
    <div class="w3-container w3-center"><br><br>
    <form action = "" method = "POST">
		<input class="w3-container w3-padding-8" type = "text" name = "username" class = "box"/><br>
        <label>Username</label><br /><br />
		<input class="w3-container w3-padding-8" type = "password" name = "password" class = "box"/><br>
        <label>Password</label>
        <br/><br />
        <input type = "submit" value = " Submit "/>
        <br />
	</form>
               
               <div><?php echo $error; ?></div>
    </div>
    </content>
    
   </body>
</html>