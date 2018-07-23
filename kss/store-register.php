<?php include_once "head.php";
if(isset($_SERVER['HTTP_REFERER'])){
    $back_url=$_SERVER['HTTP_REFERER'];
}else{
    $back_url="store.php";
}
?>
<style>
    .input-group .icon-addon .form-control {
        border-radius: 0;
    }

    .icon-addon {
        position: relative;
        color: #555;
        display: block;
    }

    .icon-addon:after,
    .icon-addon:before {
        display: table;
        content: " ";
    }

    .icon-addon:after {
        clear: both;
    }

    .icon-addon.addon-md .glyphicon,
    .icon-addon .glyphicon,
    .icon-addon.addon-md .fa,
    .icon-addon .fa {
        position: absolute;
        z-index: 2;
        right: 10px;
        font-size: 16px;
        width: 20px;
        margin-right: -2.5px;
        text-align: center;
        padding: 10px 0;
        top: 0px
    }
    .icon-addon.addon-md .form-control,
    .icon-addon .form-control {
        padding-right: 30px;
        float: right;
        font-weight: normal;
    }

    .icon-addon .form-control:focus + .glyphicon,
    .icon-addon:hover .glyphicon,
    .icon-addon .form-control:focus + .fa,
    .icon-addon:hover .fa {
        color: #2580db;
    }
</style>
<style>
    .btn-yellow{
        background: yellow;
        background-color: yellow!important;
    }

    .stepwizard-step p {
        margin-top: 10px;
        font-size: 16px;
        font-weight: 700;
        color: #353333;
    }

    .stepwizard-row {
        background: rgba(194, 194, 194, 0.32);
        display: table-row;
        border-radius: 10px;
    }

    .stepwizard {
        display: table;
        width: 73%;
        position: relative;
        margin-top: -40px;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .wired:after{
        bottom: 15px;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .wired_last:after{

        bottom: 15px;
        position: absolute;
        content: " ";
        width:65%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .btn.disabled, .btn[disabled], fieldset[disabled] .btn{
        opacity: 1;
    }


    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    form td,th{
        padding: 10px;
        font-size: 16px;
    }
    form th{
        color: #3e3d3f;
        font-weight: 700;
    }
    form table{
        background: rgba(137, 137, 137, 0.51);
        margin-bottom: 20px;
    }
    form table td,a{
        color: white;
    }
   .a-form{
        background-color: rgba(255, 255, 255, 0.26);
        border-radius: 22px;
        alignment: none;
    }
    .verticleline{
        border-left: thick solid #000000;
    }
</style>
<div class="kss-container">
    <div class="kss-store">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded">
            </div>
            <div class="kss-header">
                <div class="col-md-3 col-sm-3 col-xs-4 logo">
                    <a href="store.php"><img src="images/product/storelogo.png" alt="Kss Store" title="Logo"></a>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-8 pull-right kss-user">
                    <div class="pull-right">
                        <a class="kss-home-btn" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </div><div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <?php if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
                            ?>
                            <span style="font-weight: 700;"><?php echo $_SESSION['username']; ?></span>&nbsp;&nbsp;
                            <?php
                        } else { ?>
                            <a href="store-register.php">Sign In</a>/<a href="store-register.php">Join</a> &nbsp;
                        <?php }?>

                        <img width="35px;" src="images/flag.png">&nbsp;&nbsp;
                        <a href="javascript:void(0);" class="back-btn BackClick">Back</a>
                    </div>
                </div>
                <div class="hidden col-xs-2 pull-right" style="cursor:pointer;margin-top: 3%;"><i class="fa fa-bars" style="font-size: 35px;" aria-hidden="true"></i></div>
                <div class="clearfix"></div>

            </div>
            <div class="clearfix"></div>
            <br>
            <!---->
            <div class="col-sm-11 col-sm-offset-1 store-register">
                <br>
                <div class="col-md-5">
                    <label class="control-label col-sm-12 col-xs-12">LOGIN IN REGISTERED USERS</label>
                    <span class="control-label col-sm-12 col-xs-12" style="margin: 7px 0px 5px 0px;">ENTER YOUR EMAIL AND PASSWORD BELOW TO ACCES YOUR ORDER STATUS</span>
                    <div class="clearfix"></div>
                    <form class="form-horizontal LoginForm">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Email</label>
                            <div class="col-sm-9">
                                <input type="email" name="username" required class="kss-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" required class="kss-input">
                                <input type="hidden" name="reqtype" value="Login" required class="kss-input">
                                <input type="hidden" name="back_url" value="<?php echo $back_url;?>" required class="kss-input">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-9">
                                <a href="forget-password.php" style="color: black;">forgot your password?</a>
                            </div>
                        </div>
                        <br>
                        <div class="form-group text-center">
                           <button class="g-btn"> Log-in</button>
                        </div>
                    </form>
                </div>
                <div class="visible-xs"><br><br></div>

                <form class="form-horizontal" id="RegisterForm">
                    <div class="col-md-7 form-horizontal r-frm" style="    border-left: 1px solid #989696;">
                    <div class="form-group">
                        <label class="control-label col-sm-6"><b>New Users</b></label>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">First Name</label>
                        <div class="col-sm-6">
                            <input type="text" required name='firstname' id="firstname" class="kss-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">Last Name</label>
                        <div class="col-sm-6">
                            <input type="text" required name='lastname' id='lastname' class="kss-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">Date of birth</label>
                        <div class="col-sm-6">
                            <input type="date" required name="dob" id="dob" class="kss-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">Email</label>
                        <div class="col-sm-6">
                            <input type="email" required name='email' id='email' class="kss-input">
                        </div>
                    </div>
                   <!-- <div class="form-group">
                        <label class="control-label col-sm-6">Confirm Email</label>
                        <div class="col-sm-6">
                            <input type="text" class="kss-input">
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="control-label col-sm-6">Password</label>
                        <div class="col-sm-6">
                            <input type="password" minlength="6" required name='password' id='password' class="kss-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">Confirm Password</label>
                        <div class="col-sm-6">
                            <input type="password" minlength="6" required name='conf_password' id='conf_password' class="kss-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6"></label>
                        <div class="col-sm-6">
                            <input type="checkbox" required title="term and conditions"> I Accept the Terms and Conditions <a target="_blank" href="terms-conditions.php" class="adv-btn">Terms and conditions</a>
                            
                        </div>
                        
                    </div>    
                    <div class="visible-xs"><br></div>
                    <div class="form-group">
                        <label class="control-label col-sm-6">
                        <input type="hidden" name="reqtype" value="Register">
                        <input type="hidden" name="referrer" value="Store">
                        <!--<button class="g-btn"> Register</button>-->
                        <input type="submit" class="save-btn SubmitBtn g-btn" value="Register">
                        </label>

                    </div>
                    <div class="form-group">
                        <a href="privacy-policy.php"><label class="control-label col-sm-6">Privacy policy</label></a>
                    </div>
                </div>
                </form>
            </div>
            <!---->
            <div class="clearfix"></div>
            <div class="visible-xs"><br><br></div>
            <div class="clearfix"></div>
            <div class="kss-footer">
                <?php include_once "store_footer.php";?>
            </div>
        </div>
        <div class="kss-col2 col-md-2 col-sm-12 col-xs-12 ">
            <?php include_once "adv_section.php";?>
        </div>
        <div class="clearfix"></div>
    </div><!--kss store-->
</div><!--container-->

<?php include_once "include_bottom.php"?>