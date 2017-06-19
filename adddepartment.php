<html>
	<head>
	</head>
	<body>
<?php 	
include_once('chkadmin.php');
//	include_once('login.php');
	include_once ('header_admin.php');
	include_once('db_connect.php');

	
	//echo 'Connection OK<BR>'; 
		if (isset($_POST['submit']))
		{
		$sql_insert = " INSERT INTO department VALUES
		('$_POST[n1]')";
		
		$queryStatus=mysqli_query($db,$sql_insert);
		if($queryStatus==TRUE)
				{
				?>
			<div class="container">
  				<div class="row">
   				 <div class="col-sm-8 col-md-8" style="left:30%;height:30%;left : 15%; border-radius: 10px;border:block;">
   				 	<center><h1>Success!!<h1><h4>Department Added <br>  <h4></center></br></br>
   				 </div>
   				</div>
   				</div>
			<?php
		}
		else
				{?>
				<div class="container">
  				<div class="row">
   				 <div class="col-sm-8 col-md-8" style="left:30%;height:30%;left : 15%; border-radius: 10px;border:block;">
   				 	<center><h1>Error<h1><h4> Cannot insert Data <br>Department exist<h4></center></br></br>
   				 </div>
   				</div>
   				</div>
			<?php
		}
		}
?>

	 
	<div class="container">
  			<div class="row">
   				 <div class="col-sm-8 col-md-8" style="left : 15%; border-radius: 25px;box-shadow:0px 0px 15px #211926;background-color:#CCCCCC">
			<center><H1>Department Details</H1><br></center>
		<center>
		<form action="adddepartment.php" method="POST">
			<fieldset>
				<table>
					<tr><td>Department Name: &nbsp;&nbsp;&nbsp;</td> <td><input type="text" name="n1" size="40"title = "pattern is XXXX" pattern = "[A-Z a-z]{3,}" required><br><br></td></tr>
				</table>
				<center><input type="submit" name="submit" value="ADD" /></center>
			</fieldset>
		</form></center>
		<br>
		</div>
	</div>
</div>
		</body>
</html>
