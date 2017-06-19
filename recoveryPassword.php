<?php 	
include_once('db_connect.php');	
if(isset($_POST['fid']))
{
	$id = $db->real_escape_string($_POST['fid']);
	$result = $db->query("SELECT email,password FROM faculty WHERE f_id='$id'");
	if($count = $result->num_rows)
	{
		if($count==1) {
					$row=$result->fetch_assoc();
					
				$to=$row['email'];
				$pass=$row['password'];
$subject='Password Recovery';
$message='Your Password Is: '.$pass;
$from="National Institute of Technology, Calicut";
$headers="From:".$from;
mail($to,$subject,$message,$headers); 

?>
						<script type="text/javascript">
						alert("Check Your Email");
						window.location="index.php";
						</script>
						<?php
				      }
	}
	else
	{
		?>
						<script type="text/javascript">
						alert("Invalid Credential");
						window.location="index.php";
						</script>
						<?php
	}
}	
?>