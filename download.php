<?php
include_once('chkfaculty.php');
include_once('db_connect.php');
include_once('header_faculty.php');
$id = $_COOKIE['id'];


?>


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

<div class="row">
  <div class="container">
        
           <div class="col-sm-11 col-md-11">
            <?php




$query = "SELECT f.name fname,c.c_id cid,c.name cname,generatedate FROM generatedfiles g,faculty f,course c where g.f_id = '$id' and f.f_id = g.f_id and c.c_id = g.c_id order by generatedate desc LIMIT 1";

$result = mysqli_query($db,$query) or die('Error, query failed');

	
		echo '<table class="table table-hover">';
		echo '<caption>'.'<center>'.'<b>'."Course Files Created By You".'</b>'.'</center>'.'</caption>';
    echo '<thead>';
    echo '<tr>';
		echo '<th>'."Faculty Name".'</th>';
    echo '<th>'."Course Name".'</th>';
		echo '<th>'."Generation Date".'</th>';
		//echo '<th>'."Download".'</th>';
    echo '</tr>';
    echo '</thead>';

    while ($row = mysqli_fetch_array($result)) 
    {
      echo '<tr>
              <td>'.$row['fname'].'</td>
              <td>'.$row['cname'].'</td>
              <td>'.$row['generatedate'].'</td>
              <td>'.'<a href="downloads.php?'.'cid='.$row['cid'].'&fid='.$id.'"><button type = "button" class="btn btn-success" id="po_a_down" data-toggle="tooltip" title="click to download file  !"><i class="fa fa-download" aria-hidden="true"></i></button></a>'.
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