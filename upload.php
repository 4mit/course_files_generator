<?php
session_start();
$rrr = $_GET['sid'];
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!empty($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{

		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];

		$fp      = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		$content = addslashes($content);
		fclose($fp);


		$fileName = addslashes($fileName);

		include_once('db_connect.php');
	    if($fileType != "application/pdf")
		{	
				?>
				<script>
					alert("Please Upload file of pdf format");
					location.href = 'addSchedule.php';
				</script>
				exit();
			<?php
		}else if($fileSize >  1e+7 )
		{
			?>
				<script>
					alert("Please Upload file of size less than 16 MB");
					location.href = 'addSchedule.php';
				</script>
				exit();
			<?php
		}else{	

			    $e = $_COOKIE['id'];
				$sql="select * from assign where f_id = '$e'";

				//echo $e;
				
				$result=mysqli_query($db,$sql) or die("error");
				
				$cid = mysqli_fetch_assoc($result)['c_id'];
				$targetfolder = 'uploads/';

				  
				//Usage of basename() function
				 
				$targetfolder = $targetfolder . basename( $_FILES['userfile']['name']);
				if(move_uploaded_file($_FILES['userfile']['tmp_name'], $targetfolder));					
				

				$query = "INSERT INTO file(f_id,s_id,c_id,size,type,content,name) VALUES ('$e','$rrr','$cid', $fileSize, '$fileType', '$content','$fileName')";
				
				mysqli_query($db,$query) or die('Error, query failed'); 
				mysqli_error($db);

		}
}
?>
<script>
	location.href = document.referrer;
</script>s