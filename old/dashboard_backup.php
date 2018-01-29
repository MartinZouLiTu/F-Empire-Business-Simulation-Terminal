<?php
   include('session.php');
?>
<html>
   
   <head>
      <title><?php echo($row['username']); ?> - Dashboard</title>
   </head>
   
   <body>
      
      <table width="100%">
      	
        <div class="header">
        <tr align="center">
        	<td colspan="3">
            <h1>Participant Dashboard</h1>
            </td>
        </tr>
        <tr align="center">
        	<td width="10%" align="center">
            Welcome, <?php echo($row['username']); ?>!
            </td>
            <td width="80%" align="center">
            <h3>View your status here!</h3>
            </td>
            <td width="10%" align="center">
            <a href="logout.php">Sign Out</a>
            </td>
        </tr>
        </div>
        <div class="content">
        <div class="news">
        <tr align="center">
        	<td colspan="3">
            <h2>Current News</h2>
            </td>
        </tr>
        <tr>
        	<td>
            <?php
			echo($news['news']);
			?>
            </td>
        </tr>
        </div>
        <div class="compinfo">
        <tr align="center">
        	<td colspan="3">
            <h2>Company Info</h2>
            </td>
        </tr>
        <tr>
        	<td>
            <h3>Company Name</h3>
            </td>
            <td>
            <?php echo($row['username']); ?>
            </td>
        </tr>
        </div>
        
      </table>
      
<?php /*?>      <h1>Your Dashboard, <?php echo($row['username']); ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
      <div>
      <table>
      	<tr>
      	<h2>News Center</h2>
      	<p>News content: No content right now #usemysql</p>
		  </tr>
     
      <tr>
      	<h2>Company Information</h2>
      	<p>Cash: $<?php echo($row['cash']);?></p>
      </tr>
      </table>
	  </div>
<?php */?>	   
      
      
      
      
   </body>
   
</html>