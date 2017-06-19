<html>
<head>
<title>Download File From MySQL</title>
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
<?php
include_once('chkfaculty.php');
include_once('db_connect.php');
include_once('header_faculty.php');
	?>
  <div class="container">
        <div class="row">
           <div class="col-sm-8 col-md-8" style="left : 15%; border-radius: 25px;">
            <?php

$id = $_COOKIE['id'];
$query = "SELECT f.name fname,c.c_id cid,c.name cname,generatedate FROM generatedfiles g,faculty f,course c where g.f_id = '$id' and f.f_id = g.f_id and c.c_id = g.c_id order by generatedate desc LIMIT 1";

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
        while ($row = mysqli_fetch_array($result)) {
		   
		   
           echo '<tr><td>'.$row['fname'].'</td><td>'.$row['cname'].'</td><td>'.$row['generatedate'].'</td><td>'.'<a href="downloads.php?'.'cid='.$row['cid'].'&fid='.$id.'"><input type = "button" value ="download"></a>'; 
           
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