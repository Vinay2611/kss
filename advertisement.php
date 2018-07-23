<?php include_once "head.php";?>
<style>
    h4{
        margin-top: 70px;
    }

</style>
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
                <form class="form-horizontal" id="submit_advv">
                    <div class="form-group">
                        <label class="control-label col-sm-4" ></label>
                        <div class="col-sm-6 text-center">
                            <div class="col-sm-12" style="background: rgba(1, 1, 1, 0.41);color: white;padding: 14px 0px 14px 0px;">
                                <span style="font-size: 12px;">Please Fill the Information below for Advertisement</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Company Name</label>
                        <div class="col-sm-6">
                            <input type='text' required name='company_name' id='com' maxlength="50" placeholder="Company Name"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Company Email</label>
                        <div class="col-sm-6">
                            <input type='email' required name='company_email' maxlength="50" placeholder="Company Email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Company Phone</label>
                        <div class="col-sm-6">
                            <input type='number' name='company_phone' maxlength="50" placeholder="Company Phone No."/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Company Websites</label>
                        <div class="col-sm-6">
                            <input type='text' required name='website' id='website' maxlength="50" placeholder="Websites"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" >Advertise Image</label>
                        <div class="col-sm-6">
                            <input type='file' name='file' id='advertise_image' maxlength="50" placeholder="Advertise Image"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" >Advertise Description</label>
                        <div class="col-sm-6">
                            <input type='text' name='description' id='description' maxlength="50" />
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 bx col-md-offset-4 col-sm-offset-4">
                        <input type="hidden" name="reqtype" value="Advertisement">
                        <div style="margin: 10px 0px;">
                        <input type="submit" class="save-btn SubmitBtn" value="Advertise Now">
                        <br></div>
                       <!-- <a href="" class="adv-btn">Advertise Now</a>-->
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
            <?php include_once "adv_section.php";?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php include_once "include_bottom.php"?>

