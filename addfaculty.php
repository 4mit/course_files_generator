<html>
	<body>
<?php 	
include_once('chkadmin.php');
include_once('db_connect.php');
//include_once('login.php');
	include_once ('header_admin.php');

	//echo 'Connection OK<BR>'; 
		if (isset($_POST['submit']))
		{
		$sql_insert = " INSERT INTO faculty VALUES
		('$_POST[n1]',
		'$_POST[n2]','','','','$_POST[n1]')";
		
		$queryStatus=mysqli_query($db,$sql_insert);
		if($queryStatus==TRUE)
				{
				?>
			<div class="container">
  				<div class="row">
   				 <div class="col-sm-8 col-md-8" style="left:30%;height:30%;left : 15%; border-radius: 10px;border:block;">
   				 	<center><h1>Success!!<h1><h4>Faculty Inserted <br><h4></center></br></br>
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
   				 	<center><h1>Error<h1><h4> Cannot insert Data <br>Faculty with this ID exist<h4></center></br></br>
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
		<fieldset>
				<center>
					<H1>Faculty Details</H1><br>
				</center>
			</fieldset>
					<center><form action="addfaculty.php" method="POST">
						<fieldset>
							<table>
								<tr><td>Faculty ID:</td> <td><input type="text" name="n1" size="50" title = "pattern is XXXX OR XX0000" pattern = "([A-Za-z]{1,4})|([A-Za-z]{2}[0-9]{4})" required><br><br></td></tr>
								<tr><td>Faculty Name :</td> <td><input type="text" name="n2" size="50" pattern="[a-z A-Z]{3,}" title="Required Format: Characters Only" required><br><br></td></tr>
							</table>
							<center><input type="submit" name="submit" value="ADD" /></center>
						</fieldset>
						</form>
						</center>
					
				</br>
			
		</div>
	</div>
</div>
		</body>
</html>