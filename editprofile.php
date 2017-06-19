<html>
	<body >
<?php 	
		include_once('chkfaculty.php');
		include_once('db_connect.php');
		include_once('header_faculty.php');
		?>
		<div class="container">
  			<div class="row">
   				 <div class="col-sm-8 col-md-8" style="left : 15%; border-radius: 25px;border: double;">
   		<?php
		
		if (isset($_POST['submit']))
		{
		$sql_insert = "update faculty set name='$_POST[fname]', department='$_POST[fdept]',designation='$_POST[fdesign]',email='$_POST[email]' where f_id='$_POST[fid]'";
		
		$queryStatus=mysqli_query($db,$sql_insert);
		//if($queryStatus==TRUE)
				//echo "\n updated Successfully";
		//else
		//echo "Record Not Inserted ";
		}
		
		$id =  $_COOKIE['id'];
		//echo $id;
		$sql = "select * from faculty where f_id like '$id'";
		$queryStatus = mysqli_query($db,$sql);
		$row=$queryStatus->fetch_assoc();		
?>

		<fieldset>
				<center>
					<H1>Faculty Details</H1><br>
				</center>
			</fieldset>
		<span style="border:true ;position:absolute;left:20%;top:30%" >
		<form action="editprofile.php" method="POST">
		<fieldset>
		<table>
			<tr><td>Faculty Id:</td><td><input type="text" name="fid" size="50" value = "<?php echo $row['f_id']?>" ><br><br></td></tr>
			<tr><td>Faculty Name:</td> <td><input type="text" name="fname" size="50" value = "<?php echo $row['name']?>"><br><br></td></tr>
			<tr><td>Department:</td><td><input type="text" name="fdept" size="50" value = "<?php echo $row['department']?>"><br><br></td></tr>
			<tr><td>Designation:</td><td><input type="text" name="fdesign" size="50" value = "<?php echo $row['designation']?>"><br><br></td></tr>
			<tr><td>Email:</td><td><input type="email" name="email" size="50" value = "<?php echo $row['email']?>"><br><br></td></tr>
		</table>
			<center><input type="submit" name="submit" value="ADD" /></center>
			</fieldset></form>
			</span>	
			</div>
			</div>
			</div>	
	</body>
</html>