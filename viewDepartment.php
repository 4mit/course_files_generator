<!DOCTYPE html>

<html>
<head>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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
include_once('chkadmin.php');
include_once('db_connect.php');
//include_once('login.php');
  include_once ('header_admin.php');
  ?>
  <div class="container">
        <div class="row">
           <div class="col-sm-8 col-md-8" style="left : 15%; border-radius: 25px;">
  <?php
		$sql="select * from department";
		$result=mysqli_query($db,$sql) or die(mysql_error());
		
		echo '<table class="table table-hover">';
		echo '<caption>'.'<center>'.'<b>'."List of Departments".'</b>'.'</center>'.'</caption>';
        echo '<thead>';
        echo '<tr>';
        echo '<th>'."DEPARTMENT'S NAME".'</th>';
        echo '</tr>';
        echo '</thead>';

       while ($row = mysqli_fetch_array($result)) {
		   
		   echo'<tr>';
           echo '<td>'.$row['name'].'</td>'; 
           echo'</tr>';
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
