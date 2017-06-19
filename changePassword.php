<?php 	
include_once('db_connect.php');	
//print_r($POST);
if(!empty($_COOKIE['id']))
{
	$id=$_COOKIE['id'];
	$pass=$db->real_escape_string($_POST['oldPassword']);
	$npass=$db->real_escape_string($_POST['newPassword']);
	if($id=='admin')
	{
		//echo "Hello";
		$result = $db->query("SELECT password FROM admin WHERE password='$pass'");
	if($count = $result->num_rows)
	{
		if($count==1) {
						$db->query("update admin set password='$npass' where password='$pass'");
						?>
						<script type="text/javascript">
						alert("Password Changed");
						window.location="admin.php";
						</script>
						<?php
				      }
					  else
					  {
						?>
						<script type="text/javascript">
						alert("Invalid Credential");
						window.location="admin.php";
						</script>
						<?php  
					  }
	}
	else
	{
		?>
						<script type="text/javascript">
						alert("Invalid Credential");
						window.location="admin.php";
						</script>
						<?php
	}
	}
	else
	{
	$result = $db->query("SELECT email,password FROM faculty WHERE f_id='$id' and password='$pass'");
	if($count = $result->num_rows)
	{
		if($count==1) {
						$db->query("update faculty set password='$npass' where f_id='$id'");
						?>
						<script type="text/javascript">
						alert("Password Changed");
						window.location="faculty.php";
						</script>
						<?php
				      }
					  else
					  {
						?>
						<script type="text/javascript">
						alert("Invalid Credential");
						window.location="faculty.php";
						</script>
						<?php  
					  }
	}
	else
	{
		?>
						<script type="text/javascript">
						alert("Invalid Credential");
						window.location="faculty.php";
						</script>
						<?php
	}
}
}
?>