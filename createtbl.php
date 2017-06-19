<?php
	include_once('db_connect.php');

	if(isset($_POST['maketbl'])){

		$e = $_POST['number'];


		for($i=1;$i<=$e;$i++)
		{
			echo '<tr class="new_created" style="padding-top:90px;"><td>CO'; echo $i; 
			echo '</td><td>
						<input type ="text" pattern ="\w+" name="CO'.$i.'" class="form-control">
						</td></tr>';			
		}
	}



	if (isset($_POST['save']))
	{
		$query_course ="INSERT INTO `course` VALUES('".$_POST['n1']."','".$_POST['n2']."')";
		
		$queryStatus=mysqli_query($db,$query_course);
		


		$co = array();
		if(isset($_POST['CO1'])){
				array_push($co, $_POST['CO1']);
		}
		if(isset($_POST['CO2'])){
				array_push($co, $_POST['CO2']);	
		}
		if(isset($_POST['CO3'])){
				array_push($co, $_POST['CO3']);
		}
		if(isset($_POST['CO4'])){
				array_push($co, $_POST['CO4']);
		}
		if(isset($_POST['CO5'])){
				array_push($co, $_POST['CO5']);
		}
		if(isset($_POST['CO6'])){
				array_push($co, $_POST['CO6']);
		}
		if(isset($_POST['CO7'])){
				array_push($co, $_POST['CO7']);
		}


		for($i=0;$i<count($co);$i++)
		{
			$e = $i+1;	

			$query_course_out="INSERT INTO `course_outcome` VALUES('".$_POST['n1']."','CO".$e."','$co[$i]','n')";
		
			$queryStatus=mysqli_query($db,$query_course_out);


		}
		echo 'Course Addedd Successfully';
	}
?>	