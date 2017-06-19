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
error_reporting(E_ALL);
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
					
					$facultyId = $_COOKIE['id'];
					$eventID  = array();
					$eventFileType  = array();
					function show_excel_form(){

						echo '<form method="post" enctype="multipart/form-data" action="exlupload/upload.php">
								<table width="350" border="0" cellpadding="1" cellspacing="1" class="box table">
									<tr> 
										<td width="246">
											
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

					function get_eventId($facultyId)
					{
						//echo 'get_eventId'.$facultyId;
						$conn  =  new mysqli("localhost","root","","id172066_db_m140374ca");						
						$sql =  "SELECT * FROM `calendar`";
						$result  = $conn->query($sql);
						
						$d = array();
						while($events  = $result->fetch_assoc())
						{
							$d[] =  $events['id'];

							$type[]  = $events['ftype'];

						}				

						/*echo '<pre>';
						var_dump($d);
						echo '</pre>';
						*/
							for($r = 0 ;$r<count($d) ;$r++)
							 {
									$sqll =  "SELECT s_id FROM `file` WHERE s_id ='".$d[$r]."' AND f_id='".$facultyId."'";
									$result  = $conn->query($sqll);
								
									if($result->num_rows>0){

										echo '<br/>Submitted<br/><br/><br/><br/>';

									}else{

										$rr = "SELECT ftype FROM `calendar` WHERE id ='".$d[$r]."'";
										$result2 = $conn->query($rr);

										while($result22 = $result2->fetch_assoc()){

											if($result22['ftype'] ==".pdf"){

												echo '<br/><form method="post" enctype="multipart/form-data" action="upload.php">
														<table width="350" border="0" cellpadding="1" cellspacing="1" class="box table">
															<tr> 
																<td width="246">
																	
																	<input name="userfile" type="file" id="userfile"> 
																</td>
															
															</tr>
														</table>					
											      </td>
											      <td width="80"><input name="upload" type="submit" class="box btn btn-info" id="upload" value=" Upload PDF"></td></form>';
												
											}else{

												show_excel_form();
												//echo '<br/>excel file';
											}
										}

									}	
						    }		

						}

						

					get_eventId($facultyId);

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
