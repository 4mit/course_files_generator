<?php 	
include_once('chkfaculty.php');
include_once('db_connect.php');
include_once('header_faculty.php');
		if (isset($_POST['submit']))
		{
		$sql_insert = " INSERT INTO events(title,description,date) VALUES
		('$_POST[n1]',
		'$_POST[n2]','$_POST[d1]')";
		
		$queryStatus=mysqli_query($db,$sql_insert);
		if($queryStatus==TRUE)
				echo "\nRecord Inserted Successfully";
		else
		echo "Record Not Inserted ";
		}
?>

<html>
	<body >
		<form action="schedule.php" method="POST">
		<fieldset>
				<center>
					<H1>Schedule for Current Semester</H1><br>
				</center>
			</fieldset>
			<span style="border:true ;position:absolute;left:20%;top:30%" >
		<fieldset>
		<table>
		<tr>
			<td>Title:</td> <td><input type="text" name="n1" size="50"><br><br></td></tr>
			<tr><td>Description:</td> <td><input type="text" name="n2" size="50"><br><br></td></tr>
			<tr><td>Date:</td>   <td><input type="date" name="d1" size="50"><br><br></td></tr>
		</table>
			<center><input type="submit" name="submit" value="upload" /></center>
			</fieldset></form>
			</span>
	</body>
</html>
