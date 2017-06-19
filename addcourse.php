<?php 	
include_once('chkadmin.php');
include_once('db_connect.php');
//include_once('login.php');
include_once ('header_admin.php');
	
?>

<html>

<head>
	<style>
		.new_created{
			margin-top:70px !important;
			height:60px;


		}
	</style>
</head>
	<body>
		<div class="container">
  			<div class="row">
   				 <div class="col-sm-8 col-md-8" style="left : 15%; border-radius: 25px;box-shadow:0px 0px 15px #211926;background-color:#CCCCCC">
	<center>
			<H1>Course Details</H1><br>
		</center>
		<center>
		<form  method="POST" class="form" id="save_out">
			<fieldset>
				<table id="tbl">
					<tr><td>Course ID:</td> <td><input type="text" name="n1" size="50" title = "pattern is XX0000" pattern = "[A-Za-z]{2}[0-9]{4}" required class="form-control"><br><br></td></tr>
					<tr><td>Course Name:</td> <td><input type="text" name="n2" size="50" pattern="[a-z A-Z]{4,}" title="Required Format: Characters Only" required class="form-control"><br><br></td></tr>


					<!-- outcome -->

					<tr>
						<td>Course Outcome &nbsp;&nbsp;</td> 
						<td>
						<select name="course_outcome" class="form-control" id="c_out"> 
							
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
								<option>6</option>
								<option>7</option>
						</select>
						</td>
					</tr>
					<br/>
				</table>
				<br/>
				<center><input type="submit" name="submit" value="ADD" class="btn btn-success" id="save_btn" /></center>
			</fieldset>
		</form>
		</center>
		<br>
		</div>
	</div>
</div>
<script>

	$('#c_out').change(function(e){

		

				var str = 'maketbl=true&number='+$('#c_out').val();
				$('.new_created').remove();
				console.log(str);
				$.ajax({
					url :'createtbl.php',
					method:'POST',
					data:str,
					success:function(r){

						$('#tbl').append(r);
					},
					error:function(r){
						alert('Something Went Wrong ..');
					}
				});

				
	});

	$('#save_btn').click(function(e){
		e.preventDefault();
		var sss = 'save&'+$('#save_out').serialize();
	
		console.log(sss);
		$.ajax({
			url :'createtbl.php',
			method:'POST',
			data:sss,
			success:function(r){

				alert(r);
				location.reload();
			},
			error:function(r){
				alert('Something Went Wrong ..'+r);
			}
		});
	});


</script>
	</body>
</html>