
 <div class ="modal fade" id="Sign1" role="dialog">
	          			<div class ="modal-dialog">
	          				<div class ="modal-content">
	          						<div class ="modal-header" class="panel-title">
	          						<h4><color="Green">Change Password</h4>
	          						
	          			<form method="POST" action="changePassword.php">
								
                                <div style="padding: 5%;">
                                <div class="form-group">
                                    <label for="oldPassword" class="col-md-3 control-label">Old Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id = "oldPassword" name="oldPassword" placeholder="Old Password" required autofocus>
                                    </div>
                                </div>
                                </div>
                                 <div style="padding: 5%;">
                                <div class="form-group">
                                    <label for="newPassword" class="col-md-3 control-label">New Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id = "newPassword" name="newPassword" placeholder="New Password" required autofocus>
                                    </div>
                                </div>
                                </div>
                                <div style="padding: 5%;">
                                <div class="form-group">
                                    <label for="rePassword" class="col-md-3 control-label">Re enter Password</label>
                                    <div class="col-md-9">
                                        <input type="password" onblur="if($('#newPassword').val()!=$('#rePassword').val()){alert('password does not match');}" class="form-control" id = "rePassword" name="RePasswd" placeholder="RePassword" required autofocus>
                                    </div>
                                </div>
								<P id="msg"></p>
                                </div>
                                <div style="padding: 5%;">
                                 <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="submit" name="submit"
										 class="btn btn-info" ><i class="icon-hand-right"  > </i> &nbsp;Change Password</button>
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
	       

