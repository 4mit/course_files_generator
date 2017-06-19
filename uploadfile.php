<?php
	include_once('db_connect.php');
	include_once('css_js.php');
?>


<script type="text/javascript">
			$(window).load(function(){
				$('#upload').modal('show');
			});				
</script>

<div class="container">
	         <div class ="modal fade" id="upload" role="dialog">
	          	<div class ="modal-dialog">
	          		<div class ="modal-content">
	          			<div class ="modal-header">
	          				<h4 Style="color:red"> User Sign In</h4>
	          			</div>
						<div id="error"></div>
	          			<form method="post" enctype="multipart/form-data" action="upload.php">
	          			 <div style="padding: 5%;">
	          			<div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
             				<input  type="file" class="form-control" id="file" name="file"  required autofocus >                   
             				</div>
          				</div>
          						          						
          						<div class="modal-footer">
          						<input type="submit" data-inline="true" id="SubmitBtn" class = "btn btn-success" value="Upload">
	          					<a class = "btn btn-primary" data-dismiss = "modal">Close</a>
          						</div>
	          			</form>
	          		<div >
	          	</div>
	          </div>
			</div>
	       </div>