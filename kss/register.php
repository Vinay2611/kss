<?php include_once "head.php";
if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
    $referrer=$_SERVER['HTTP_REFERER'];
    $_SESSION['register_referrer']=$referrer;
}else{
}
?>
<div class="kss-container">
    <div class="kss-home">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded"></div>
            <div class="kss-header">
                <div class="col-md-3 col-sm-3 col-xs-6">
                   <a href="index.php"> <img src="images/logo.png" alt="Kss" title="Logo"></a>
                </div>
                <div class="pull-right">
                    <a class="kss-home-btn" style="position: relative;" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="form-horizontal register-page col-sm-10 col-sm-offset-2">
                <form class="form-horizontal" id="RegisterForm">
                    <div class="col-sm-3 col-sm-offset-4" style="font-size: 18px;">CREATE YOUR ACCOUNT</div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >YOU ARE </label>
                        <div class="col-sm-6">
                            <select name="role" id="role" required>
                                <option value="">SELECT ONE </option>
                                <option value="parent">PARENT/GUARDIAN</option>
                                <option value="principle-assistance-pta">PRINCIPAL/ ASSISTANCE PRINCIPAL/ PTA</option>
                                <option value="bussiness">BUSINESS</option>
                                <option value="staff">STAFF</option>
                                <option value="administration">ADMINISTRATOR</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Email</label>
                        <div class="col-sm-3">
                            <input type='email' name='email' id='email' required maxlength="50" placeholder="Email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Child Name</label>
                        <div class="col-sm-3">
                            <input type='text' name='firstname' id='fname' required maxlength="50" placeholder="First Name"/>
                        </div>
                        <div class="col-sm-3">
                            <input type='text' name='lastname' id='lname' required maxlength="50" placeholder="Last Name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >PASSWORD</label>
                        <div class="col-sm-3">
                            <input type='password' minlength="6" name='password' id='password' required maxlength="50" placeholder="PASSWORD"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >CONFIRM<br> PASSWORD</label>
                        <div class="col-sm-3">
                            <input type='password' minlength="6" name='conf_password' id='conf_password' required maxlength="50" placeholder="confirm password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Age</label>
                        <div class="col-sm-6">
                            <input type="number" name="age" required id="age" maxlength="10" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Sex/Gender</label>
                        <div class="col-sm-6">
                            <select name="sex" required id="sex">
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Medical Condition</label>
                        <div class="col-sm-6">
                            <input type="text" name="medical_condition" required id="medical_condition" maxlength="250" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" >SELECT A SECURITY QUESTION </label>
                        <div class="col-sm-6">
                            <select name="question" required id="question">
                                <option value="">SELECT ONE </option>
                                <option value="childhood-name">Your Childhood Name</option>
                                <option value="friend-name">Your Friend Name</option>
                                <option value="first-company-name">Your First Company Name </option>
                                <option value="first-school-name">Your First School Name</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >SECURITY ANSWER</label>
                        <div class="col-sm-6">
                            <input type="text" name="answer" required id="answer" maxlength="50" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-3">
                            <input type="checkbox" required title="term and conditions"> I Accept the Terms and conditions<br>
                            <a target="_blank" href="terms-conditions.php" class="adv-btn">Terms and <br> Conditions</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-3">
                            <input type="hidden" name="reqtype" value="Register">
                            <input type="submit" class="save-btn SubmitBtn" value="Save">
                        </div>
                    </div>
                </form>
            </div>
            <div class="kss-home-r3" style="margin-top: 50px;">
                <div class="col-sm-12">Kss programs © <span style="text-transform: lowercase">all right reserved</span></div>
            </div>
            <div class="clearfix"></div>
            <div class="kss-footer">
                <?php include_once "footer.php";?>
            </div>
        </div>

        <div class="kss-col2 col-md-2 col-sm-12 col-xs-12 ">

                <?php include_once "adv_section.php"?>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php include_once "include_bottom.php"?>
<script>
 $("#password").focusout(function()
    {
		
		var pswd=$("#password").val();
		 if(pswd.length<6)
	   {
			$("#password").focus();
		    $.toaster({ priority : 'warning', title : 'Error', message : "password Should be 6 characters long..!"}); 
	   }
	});
    $("#conf_password").focusout(function()
    {
       var pswd=$("#password").val();
       var cnfpswd=$("#conf_password").val();
	  
       if(pswd==cnfpswd) {
			
           $("#question").focus();

       }else
       {	
		$("#password").focus();
           $.toaster({ priority : 'warning', title : 'Error', message : "Password do not match!"});
		   
       }
    });
</script>
