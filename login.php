<!--Login Form -->
           <div class="container">
	         <div class ="modal fade" id="login" role="dialog">
	          	<div class ="modal-dialog">
	          		<div class ="modal-content">
	          			<div class ="modal-header">
	          				<h4 Style="color:black"> User Sign In</h4>
	          			</div>
						<div id="error"></div>
	          			<form method="post" action="userlogin.php">
	          			 <div style="padding: 5%;">
	          			<div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
             				<input  type="text" class="form-control" id="id" name="id"  placeholder="ID" required autofocus >                   
             				</div>
          						
          				
          				<div style="margin-bottom: 25px" class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                       		<input  type="password" id="password" class="form-control" name="password" placeholder="password" required autofocus>
                        </div>
          						</div>
          						<div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 2px solid#888; padding-top:15px; font-size:85%" >
                                        <a href="#Sign" data-toggle="modal" onClick="$('#Sign').show();$('#login').hide()" data-dismiss = "modal">Forgot Password ?</a>
                                        
                                        </div>
                                    </div>
                                </div> 
          						
          						<div class="modal-footer">
          						<input type="submit" data-inline="true" id="loginBtn" class = "btn btn-success" value="Sign In">
	          					<a class = "btn btn-primary" data-dismiss = "modal">Close</a>
          						</div>
	          			</form>
	          		<div >
	          	</div>
	          </div>
			</div>
	       </div>
	         

<!-- modal dialog for sign up  -->
	       <div class ="modal fade" id="Sign" role="dialog">
	          			<div class ="modal-dialog">
	          				<div class ="modal-content">
	          						<div class ="modal-header" class="panel-title">
	          						<h4><color="Green">Forgot Password</h4>
	          						
	          			<form method="POST" action="recoveryPassword.php">
								
                                <div style="padding: 5%;">
                                 <div class="form-group">
                                    <label for="user_id" class="col-md-3 control-label" >User ID</label>
                                    <div class="col-md-9">
                                        <input type="text"  class="form-control" id = "UserId" name="UserId" placeholder="User ID" required autofocus title="characters only"><p id="check"></p>
                                    </div>
                                </div>
                                </div>
                                <div style="padding: 5%;">
                                 <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="submit" name="submit"
										 class="btn btn-info" ><i class="icon-hand-right"  > </i>Submit</button>
                                        <span style="margin-left:8px;">or</span> 
                                        <a class = "btn btn-primary" data-dismiss = "modal" onClick="$('#Sign').hide();"> &nbsp; Close</a> 
                                    </div>
                                </div>
                                </div>
                         </form>
                            </div>
                         </div>
                    </div>           
	            </div>
	       </div>
       
	       
<!-- jquery for login -->
<script>

    $(document).ready(function() {

        $('#loginBtn').click(function() {
                    
            var id=$("#id").val();
            var password=$("#password").val();
            var datastring = 'id='+id+'&password='+password;
			//alert(datastring);
		    if($.trim(id).length>0 && $.trim(password).length>0) {
				$.ajax({
                    type: "POST",
                    url: "userlogin.php",
                    data: datastring,
                    cache: false,
                    beforeSend: function(){ $("#loginBtn").val('Connecting...');},
                    success: function(data){
                        if(data) {
							//alert("login successful"+data);
							$("#loginBtn").val('loging you in');
							location.reload(true);
                        } else {
                            $('#loginBtn').shake();    //Shake animation effect.
                            $("#error").innerhtml("<span style='color:#cc0000'>Error:</span> Invalid username and password. ");
                        }
                    }

                });
            }
			$("#loginBtn").val('Sign in');
            return false;

        });    
		

    });
</script>