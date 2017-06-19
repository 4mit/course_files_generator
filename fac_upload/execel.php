<?php

	$link = new mysqli('localhost','root','','id172066_db_m140374ca');  
	$sep = "\t"; 
	$fp = fopen('FINAL_SHEET.xls', "w"); 
	$schema_insert_rows = "";
	$facultyId = $_COOKIE['id'];
	$sub_id='';
	$result =  mysqli_query($link,"SELECT `c_id` FROM `assign` WHERE f_id ='$facultyId'"); 
	 while($row2 = mysqli_fetch_assoc($result)){
			
			$sub_id = $row2['c_id'];
	}


	$count  	= mysqli_query($link,"SELECT count(co_id) as count  FROM course_outcome WHERE sub_id='$sub_id'");
	$row2 = mysqli_fetch_assoc($count);
	$co=$row2['count'];
	$count='';

	$count  	= mysqli_query($link,"SELECT count(s_id) as count  FROM student WHERE sub_id='$sub_id'");
	$row2 = mysqli_fetch_assoc($count);
	$stu_count=$row2['count'];
	
	$count  	= mysqli_query($link,"SELECT s_id,sname FROM student WHERE sub_id='$sub_id'");
	$stu_id=array();
	$name =array();
	$combin  =array();
	while($row2 = mysqli_fetch_assoc($count))
	{			
		array_push($stu_id, $row2['s_id']);
		array_push($name, $row2['sname']);	
	}
	array_push($combin,$stu_id);
	array_push($combin,$name);
	echo '<pre>';

	echo '</pre>';
	$temp="\t"."\t"."\t"."\t"."\t"."National Institute Of Technology\n\t\t\t\t\tDepartment Of Computer Science and Engineering\n\t\t\t\t\tDirect Assesment Of Attainment Of COs\n\t\t\t\t\tCourse :".$sub_id."\n\n";	
	fwrite($fp, $temp);
	$temp="\t\t\t\tMarks\t\t\t\t\t\t";
	for($j=1;$j<=$co;$j++)
		$temp=$temp.'CO'.$j."\t\t\t\t\t";
	$temp=$temp."\n\n\n";
	fwrite($fp, $temp);
	$temp="Roll Number\tName\tT1\tT2\tA1\tA2\tFE\tTOTAL";
	for($j=1;$j<=$co;$j++)
		$temp=$temp."\tT1\tT2\tA1\tA2\tFE";

	$temp=$temp."\n\n";
	fwrite($fp, $temp);
	for($i=0;$i<$stu_count;$i++)
	{


		$output="".$combin[0][$i]."\t".$combin[1][$i];

		$sql = "select t1,t2,a1,a2,fe FROM marks WHERE sub_id='$sub_id' and s_id='".$combin[0][$i]."'";
		$sum=0;
		$counts  = mysqli_query($link,$sql);
		while($row2 = mysqli_fetch_assoc($counts))
		{			  
			$sum=$sum+$row2['t1']+$row2['t2']+$row2['a1']+$row2['a2']+$row2['fe'];
			$output=$output."\t".$row2['t1']."\t".$row2['t2']."\t".$row2['a1']."\t".$row2['a2']."\t".$row2['fe']."\t".$sum;

		}

		for($j=1;$j<=$co;$j++)
		{
			$sql = "select t1,t2,a1,a2,fe FROM outcome WHERE sub_id='$sub_id' and s_id='".$combin[0][$i]."' and co_id='CO".$j."'";
			//echo $sql;
			//$sql  = "SELECT t1,t2,a1,a2,fe FROM course_outcome WHERE sub_id='$sub_id' and s_id='$combin[0][$i]' and co_id='CO".$j."'";
			
			$counts  = mysqli_query($link,$sql);
			
			while($row2 = mysqli_fetch_assoc($counts))
			{			  
				
				$output=$output."\t".$row2['t1']."\t".$row2['t2']."\t".$row2['a1']."\t".$row2['a2']."\t".$row2['fe'];

			}
			

		}

		$output=$output."\n";
		//echo $output.'<br>';

		fwrite($fp, $output);

	}
$total=6+$co*5;
$ch='C';
$temp="\n\nAVERAGE\tSCORES\t";
$av=$stu_count+11-1;$turn=0;
for($i=0;$i<$total;$i++)
{
	if($i>26&&$turn==0)
	{
		$ch='A';
		$turn=1;
	}
	if($ch<='Z')
	{
		$temp=$temp."=AVERAGE(".$ch."11:".$ch.$av.")\t";
		$ch++;
	}
	else
	{
		$temp=$temp."=AVERAGE(A".$ch."11:A".$ch.$av.")\t";
		$ch++;
	}

}


		fwrite($fp, $temp);

$total=$co*5;
$ch='I';
$temp="\n\nPERCENTAGE\tCOs\t\t\t\t\t\t\t";
$av=$stu_count+11-1;$turn=0;
for($i=0;$i<$total;$i++)
{
	if($i+5>26&&$turn==0)
	{
		$ch='A';
		$turn=1;
	}
	if($ch<='Z'&&$turn==0)
	{
		$K=$stu_count*3;
		$temp=$temp."=SUM(".$ch."11:".$ch.$av.")/".$K."*100\t";
		$ch++;
	}
	else
	{
		$K=$stu_count*3;
		$temp=$temp."=SUM(A".$ch."11:A".$ch.$av.")/".$K."*100\t";
		$ch++;
	}

}


fwrite($fp, $temp);

//header('location:excelf.php');
	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php
	//include_once('../download.php');
    include_once('../chkfaculty.php');
    include_once('../db_connect.php');
    include_once('../css_js.php');
    //include_once('../header_faculty.php');
    


    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<style>
    tr:nth-child(even) {background: #CCC}
    tr:nth-child(odd) {background-color: rgba(36, 138, 138, 0.4); }
    th{background-color: rgba(36, 37, 138, 0.4);}

    table{box-shadow:0px 0px 7px #030000;}
    body{
      
    }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-slide-dropdown">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Course File Generator</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-slide-dropdown">
        <ul class="nav navbar-nav">
            <li class="active"><a href="../faculty.php">Home</a></li>
             

              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Upload<span class="caret"></span></a>
                <ul class="dropdown-menu">       
                  <li><a href="../addSchedule.php">File</a></li>
                
                  <li><a href="../upload_course.php">Course Outcome</a></li>
                </ul>
              </li>


              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Course File<span class="caret"></span></a>
                <ul class="dropdown-menu">       
                  <li><a href="../PDFMerger/fpdf/tuto3.php">Generate Course File</a></li>
                  <li><a href="execel.php">Generate PO Attainment</a></li>
                  <li role="separator" class="divider"></li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile<span class="caret"></span></a>
                <ul class="dropdown-menu">       
                  <li><a href="../showProfile.php">View profile</a></li>
                  <li role="separator" class="divider"></li>
              <li><a href="../newEditProfile.php">Edit profile</a></li>
                </ul>
              </li>
          
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#Sign1" data-toggle="modal" >Change Password</a></li>
              <li><a>Logged in as <?php echo ucwords($facultyId); ?></a></li>
              <li><a href = "../logout.php">Logout</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="row">
  <div class="container">
        
           <div class="col-sm-11 col-md-11">
            <?php




$query = "SELECT f.name fname,c.c_id cid,c.name cname,generatedate FROM generatedfiles g,faculty f,course c where g.f_id = '$facultyId' and f.f_id = g.f_id and c.c_id = g.c_id order by generatedate desc LIMIT 1";

$result = mysqli_query($db,$query) or die('Error, query failed');

	
		echo '<table class="table table-hover">';
		echo '<caption>'.'<center>'.'<b>'."Course Files Created By You".'</b>'.'</center>'.'</caption>';
    echo '<thead>';
    echo '<tr>';
		echo '<th>'."Faculty Name".'</th>';
    echo '<th>'."Course Name".'</th>';
		echo '<th>'."Generation Date".'</th>';
		echo '<th>'."Download".'</th>';
    echo '</tr>';
    echo '</thead>';

    while ($row = mysqli_fetch_array($result)) 
    {
      echo '<tr>
              <td>'.$row['fname'].'</td>
              <td>'.$row['cname'].'</td>
              <td>'.$row['generatedate'].'</td>
              <td>'.'<a href="../downloads.php?'.'cid='.$row['cid'].'&fid='.$facultyId.'"><button type = "button" class="btn btn-success" id="po_a_down" data-toggle="tooltip" title="click to download file  !"><i class="fa fa-download" aria-hidden="true"></i></button></a>'.
                    '&nbsp;<a href="FINAL_SHEET.xls" class="btn btn-info" data-toggle="tooltip" title="click for PO attainment !" id="po_a"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>'; 
           
		}
    echo "</table>";
    if($result->num_rows == 0)
      echo "<center><h4>Nothing to show </h4></center>"; 
	?>
</div>
</div>
</div>

</body>
</html>

