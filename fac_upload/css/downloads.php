<?php
if(isset($_GET['cid'] )&& isset($_GET['fid'])) 
{
// if id is set then get the file with the id from database

	include_once('db_connect.php');
	$cid    = $_GET['cid'];
	$fid    = $_GET['fid'];
        //$time = $_GET['date'];
	$query = "SELECT name, type, size, content FROM generatedfiles WHERE f_id like '$fid' and c_id like '$cid' order by generatedate desc limit 1 ";

	$result = mysqli_query($db,$query) or die('Error, query failed');
	list($name, $type, $size, $content) = mysqli_fetch_array($result);

	header("Content-length: $size");
	header("Content-type: $type");
	header("Content-Disposition: attachment; filename=$name");
	echo $content;

	 
	
}

//echo $time;
?>
<script>
			 document.body.innerHTML = '';
				location.href = '/~m140374ca/cfg/download.php';
</script>