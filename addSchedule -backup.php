<!DOCTYPE html>
<html>
<head>
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
	<div class="container">
<?php
error_reporting(0);
include_once('chkfaculty.php');
include_once('db_connect.php');
include_once('css_js.php');
include_once('header_faculty.php');
		?>
		<div class="container">
  			<div class="row">
   				 <div class="col-sm-12 col-md-12" style="border-radius: 25px;">
			   		<?php
			   		date_default_timezone_set('Asia/calcutta');
					
					$fid = $_COOKIE['id'];
					$sql="select * from assign where f_id = '$fid'";


					$result=mysqli_query($db,$sql) or die(mysql_error());
						
						if(!($result->num_rows > 0))
						{
							die ("No Courses Assigned Yet");

						}

							$sql="select * from calendar";
							$result=mysqli_query($db,$sql) or die(mysql_error());
							
								if(isset($_GET['exupload']))
								{

									echo '<div class="alert alert-success alert-dismissable"><strong> Upload File done</strong></div>';
									
								}

								if(isset($_GET['errexupload'])){

									echo '<div class="alert alert-danger alert-dismissable"><strong>Cant Upload File </strong></div>';
								}

					
								echo '<table class="table table-hover table-responsive">';
								echo '<caption>'.'<center>'.'<b><h2>'."Schedule List".'</h2></b>'.'</center>'.'</caption>';
						        echo '<thead>';
						        echo '<tr>';
						        //echo '<th>'."S_ID".'</th>';
								echo '<th>'."Title".'</th>';
								echo '<th>'."Due Date".'</th>';
								echo '<th>'."File type".'</th>';
								//echo '<th>'."Upload Date".'</th>';
								echo '<th>'."Choose File".'</th>';
								echo '<th>'."Upload".'</th>';
								echo '<th>'."generate pdf ".'</th>';
								echo '<th>'."upload pdf ".'</th>';
						        echo '</tr>';
						        echo '</thead>';
			        

						       while ($row = mysqli_fetch_array($result)) 
						       {
									   echo'<tr>';
									  
									   session_start();
									  									  
									   $_SESSION['sid']  =  $row[id];

									   $sql="select * from file where s_id = '$row[id]' and f_id = '$fid'";
									   $resultt=mysqli_query($db,$sql) or die(mysql_error());
									   $roww = mysqli_fetch_assoc($resultt);

									   if($resultt->num_rows == 0)
									   {
										 
											 if($row['ftype'] ==".pdf" )
											 {
											 		echo '<td>'.$row['title'].'</td><td>'. $row['startdate'].'</td>';
											 		echo '<td>'.$row['ftype'].'</td>';
											 		echo '</td><td>---</td><td>
													 <form method="post" enctype="multipart/form-data" action="upload.php?sid='.$_SESSION['sid'].'">
														<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
															<tr> 
																<td width="246">
																	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
																	<input type="hidden" name="sid" value="'. $row['id'].'" >
																	<input type="hidden" name="fid" value="'. $_COOKIE['id'].'">
																	<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
																	<input name="userfile" type="file" id="userfile"> 
																</td>
															
															</tr>
														</table>					
											      </td>
											      <td width="80"><input name="upload" type="submit" class="box btn btn-info" id="upload" value=" Upload PDF"></td></form>';


											 }else{

											 		echo '<td>'.$row['title'].'</td><td>'. $row['startdate'].'</td>';
											 		echo '<td>'.$row['ftype'].'</td>';
											 		
											 		//echo $roww['up_date'];
											 		echo '<td>'.$roww['up_date'].'</td><td>';

											 		$dd = "select s_id from file where f_id= '".$row['title']."'";
											 		if(mysqli_query($db,$dd)){


											 			echo 'xlsfdfd----';
											 			echo 'submitted</td>';
											 			echo '<td></td>';
											 			echo '<td>---</td>';
											 			
											 		}else{

											 					echo 'not excel';
															 			echo '<form method="post" enctype="multipart/form-data" action="exlupload/upload.php">
																		<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
																			<tr> 
																				<td width="246">
																					<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
																					<input type="hidden" name="sid" value="'. $row['id'].'" >
																					<input type="hidden" name="fid" value="'. $_COOKIE['id'].'">
																					<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
																					<input name="image" type="file" id="userfile"> 
																				</td>
																			
																			</tr>
																		</table>					
															      </td>


															      <td width="80"><input name="upload" type="submit" class="box btn btn-info" id="upload" value=" Upload excel"></td>

															      </form>
															      <td>
															      		<form action="exlupload/test.php" method="POST" enctype="multipart/form-data">
							         
																         <button type="submit" name="test" id="de" class="btn btn-danger"/><i class="fa fa-file-pdf-o" aria-hidden="true">&nbsp;</i>Generate PDF</button>
							    										
							    										 <td><button type="button" id="fe" class="btn btn-primary" data-toggle="modal" data-target="#myModalNorm"/>processing..</button></td>
																      </form>
															      </td>';
															 		}	
											 }										 
										 
							        }else{
										$roww = mysqli_fetch_assoc($resultt);
										echo '<td>'.$row['title'].'</td><td>'.$row['startdate'].'</td><td>'.$row['ftype'].'</td><td>';//.$roww['up_date'].
										echo 	'</td><td>'."Submited".
											'</td><td></td><td>---</td>'; 
							           echo'</tr>';
									}
							   } //while ends here 
        echo "</table>";
		
?>


	</div>
	</div>
	</div>
	</div>





<!-- Modal -->
<div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Upload Downloaded File 
                </h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" action="upload.php">
					<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
						<tr> 
							<td width="246">
								<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
								<input type="hidden" name="sid" value="'. $row['id'].'" >
								<input type="hidden" name="fid" value="'. $_COOKIE['id'].'">
								<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
								<input name="userfile" type="file" id="userfile"> 
							</td>
						
						</tr>
					</table>					
				      </td>
				      <td width="80"><input name="upload" type="submit" class="box btn btn-info" id="upload" value=" Upload PDF"></td>
				</form>';
            </div>
        </div>
    </div>
</div>




	<script>
	//document.getElementById("ee").style.opacity ="0";
	$(".modal").css({
		"border":"0px",
		"boxShadow":"0px 0px 15px"
	});
	
	 $("#fe").hide();	
	document.getElementById("de").addEventListener("click",function(){
	
      	    //document.getElementById("ee").style.opacity ="1";
      	    document.getElementById("de").style.opacity ="0";
      	    $("#fe").show();	
	
	});
		
	function change(){
		document.getElementById("fe").innerHTML ="Upload Now ";	
	
	}
	
	setInterval(change,19000);

</script>


</body>
</html>
