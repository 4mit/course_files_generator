<!DOCTYPE>
<html>
	<head>
		<?php 	
		include_once('chkadmin.php');
			include_once('db_connect.php');
			
			
			//include_once('login.php');
	include_once ('header_admin.php');
					if (isset($_POST['submit']))
						{
						$sql_insert = " INSERT INTO assign VALUES
						('$_POST[cid]',
						'$_POST[fid]')";
						
						$queryStatus=mysqli_query($db,$sql_insert);
						/*if($queryStatus==TRUE)
								echo "\nRecord Inserted Successfully";
						else
						echo "Record Not Inserted ";*/
						}			
		?>
	</head>
	<body >
		<div class="container">
  			<div class="row">
   				 <div class="col-sm-8 col-md-8" style="left : 15%; border-radius: 25px;box-shadow:0px 0px 15px #211926;background-color:#CCCCCC">
		<form action="assign.php" method="POST">
			<fieldset>
				<center>
					<H1> Assign Course to Faculty</H1><br>
				</center>
			</fieldset><center>
					
						<table>
						<tr>
						<td width="30%">Select Course:</td>
							<td width="120%">
								<?php
								  $result =mysqli_query($db,"select * from course where c_id not in (select c_id from assign)");
									echo "<select name='cid' required>";
									while ($row =mysqli_fetch_assoc($result)) 
									{
										echo '<option value="'.$row['c_id'].'">'.$row['c_id'].' '.$row['name'].'</option>';
									}
									echo "</select>"; 
								?><br><br>
							</td>
						</tr>
						<tr>
							<td>Select Faculty:</td>
							<td><?php
								  $result =mysqli_query($db,"select * from faculty ");
									echo "<select name='fid' required>";
									while ($row =mysqli_fetch_assoc($result)) 
									{
										echo '<option value="'.$row['f_id'].'">'.$row['name'].'</option>';
									}
									echo "</select>"; 
								?><br><br>
							</td>
						</tr></table>
							<center><input type="submit" name="submit" value="Assign" /></center>
						
					</center>
		</form>
	</br>
	</div>
	</div>
</div>
	</body>
</html>