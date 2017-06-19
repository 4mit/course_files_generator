<?php
$uploadedStatus = 0;
if ( isset($_POST["submit"]) ) 
{
	if ( isset($_FILES["file"])) 
	{

		if ($_FILES["file"]["error"] > 0) 
		{
			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
		else {
			// if (file_exists($_FILES["file"]["name"])) {
			// unlink($_FILES["file"]["name"]);
			// }
			// $storagename = "discussdesk.xlsx";
			// move_uploaded_file($_FILES["file"]["tmp_name"],  $storagename);
			// $uploadedStatus = 1;

			define ("DB_HOST", "localhost"); // set database host
			define ("DB_USER", "root"); // set database user
			define ("DB_PASS","nsl"); // set database password
			define ("DB_NAME","dummy"); // set database name

			$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
			$db = mysqli_select_db($link,DB_NAME) or die("Couldn't select database");

			$databasetable = "file";


			set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
			include 'PHPExcel/IOFactory.php';

			// This is the file path to be uploaded.
			$inputFileName = $_FILES["file"]["tmp_name"];//'discussdesk.xlsx'; //$_FILES["filename"]["tmp_name"]

			try {
				$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			} catch(Exception $e) {
				die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
			}


			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


		for($i=2;$i<=$arrayCount;$i++){
			$userName = trim($allDataInSheet[$i]["A"]);
			$userMobile = trim($allDataInSheet[$i]["B"]);


			/*$query = "SELECT name FROM YOUR_TABLE WHERE name = '".$userName."' and email = '".$userMobile."'";
			$sql = mysql_query($query);
			$recResult = mysql_fetch_array($sql);
			$existName = $recResult["name"];*/
			$k="";
			if($k=="") {
				$insertTable= mysqli_query($link,"insert into file (id, name) values('".$userName."', '".$userMobile."');");


				$msg = 'Record has been added. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
			} else {
				$msg = 'Record already exist. <div style="Padding:20px 0 0 0;"><a href="">Go Back to tutorial</a></div>';
			}
		}
		echo "<div style='font: bold 18px arial,verdana;padding: 45px 0 0 500px;'>".$msg."</div>";
}
} else {
	echo "No file selected <br />";
}
}

?>



<html>

<head>
	<title>Demo </title>


</head>

<body>

	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
		<input type="file" name="file" id="file" /></td>
		<input type="submit" name="submit" /></td>

		<?if($uploadedStatus==1){

			echo 'File Uploaded';

		}?>



	</form>


</body>

</html>
