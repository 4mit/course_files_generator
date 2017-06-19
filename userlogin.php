<?php
   
    include("db_connect.php");
	
    session_start();
	//print_r($_POST);
	if(!empty($_POST['id']) && !empty($_POST['password'])) 
	{

        $id = $db->real_escape_string($_POST['id']);
        $password = $db->real_escape_string($_POST['password']);
		//echo strtoupper($id);
		$ad = 'admin';
        if($id == 1)
        {
			
			$result = $db->query("SELECT * FROM admin WHERE password='$password'");
			if($count = $result->num_rows)
			{
				if($count==1) {
					setcookie("id","admin",time()+7200,"/");
					?>
					<script type="text/javascript">
					window.location = 'admin.php';
					</script>
					<?php
				}
				
			}
			else
			{
					?>
			<script type="text/javascript">
			alert('Invalid credentials');
			window.location ='index.php';
			</script>
			<?php
			}
		}
		else
		{
			$result = $db->query("SELECT name,f_id,password FROM faculty WHERE f_id='$id' and password='$password'");
					

			if($count = $result->num_rows)
			{
				if($count==1) {
					$row=$result->fetch_assoc();
					$_SESSION['login_user']=$row['name'];
					setcookie("id",$row['f_id'],time()+7200,"/");
					?>
					<script type="text/javascript">
					window.location = 'faculty.php';
					</script>
					<?php
				}
				
			}
			else
			{//echo "hiiiii";
					?>
			<script type="text/javascript">
			alert('Invalid credentials');
			window.location ='index.php';
			</script>
			<?php
			}
		}
         
        
        
	}
		
	
?>