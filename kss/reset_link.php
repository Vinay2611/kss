<?php include_once "head.php";?>
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
                <div class="kss-content">
                    <div class="form-horizontal register-page col-sm-10 col-sm-offset-2">
                        <form class="form-horizontal" id="reset_link">
                            <div class="form-group">
                                <label class="control-label col-sm-4" ></label>
                                <div class="col-sm-6 text-center">
                                    <div class="col-sm-12" style="    background: rgba(1, 1, 1, 0.41);    color: white;    padding: 8px;">
                                        <b style="text-decoration: underline;">RESET PASSWORD?</b>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-4" >New Password</label>
                                <div class="col-sm-6">
                                    <input type='password' name='kss-password' required id='kss-password' placeholder="Password" maxlength="50" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" >Confirm Password</label>
                                <div class="col-sm-6">
                                    <input type='password' name='kss-retypepassword' required id='kss-retypepassword' placeholder="Confirm-Password" maxlength="50" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4"></label>
                                <div class="col-sm-4 col-sm-offset-2">
                                    <input type="hidden" name="reqtype" value="resetLink">
                                    <input type="hidden" name="token" id="token" value="<?php echo $_GET['token'];?>">
                                    <input type="submit" class="y-btn col-sm-4" value="Save">
                                </div>
                            </div>
                        </form>
                    </div>
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
                <?php include_once "adv_section.php";?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php include_once "include_bottom.php"?>