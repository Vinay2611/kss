<?php include_once "head.php";
if(isset($_SERVER['HTTP_REFERER'])){
    $back_url=$_SERVER['HTTP_REFERER'];
}else{
    $back_url="index.php";
}
?>
<style>
    #sh-exp{
        -moz-box-shadow: inset 1px -27px 19px 0px #36a7c6;
        -webkit-box-shadow: inset 1px -27px 19px 0px #36a7c6;
        box-shadow: inset 1px -27px 19px 0px rgb(249, 126, 37);
        background: -webkit-gradient(linear,left top,left bottom,color-stop(0.05,#99fffa),color-stop(1,#2d869c));
        background: -moz-linear-gradient(top,#99fffa 5%,#2d869c 100%);
        background: -webkit-linear-gradient(top,#99fffa 5%,#2d869c 100%);
        background: -o-linear-gradient(top,#99fffa 5%,#2d869c 100%);
        background: -ms-linear-gradient(top,#99fffa 5%,#2d869c 100%);
        background: linear-gradient(to bottom,#99fffa 5%,#2d869c 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#99fffa',endColorstr='#2d869c',GradientType=0);
        background-color: #99fffa;
        -moz-border-radius: 6px;
        -webkit-border-radius: 6px;
        border-radius: 6px;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-size: 13px;
        padding: 7px 30px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #0586ff;
    }
    #sh-exp:hover {
        background: -webkit-gradient(linear,left top,left bottom,color-stop(0.05,#2d869c),color-stop(1,#99fffa));
        background: -moz-linear-gradient(top,#2d869c 5%,#99fffa 100%);
        background: -webkit-linear-gradient(top,#2d869c 5%,#99fffa 100%);
        background: -o-linear-gradient(top,#2d869c 5%,#99fffa 100%);
        background: -ms-linear-gradient(top,#2d869c 5%,#99fffa 100%);
        background: linear-gradient(to bottom,#2d869c 5%,#99fffa 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2d869c',endColorstr='#99fffa',GradientType=0);
        background-color: #2d869c;
    }
    #sh-exp:active {
        position: relative;
        top: 1px;
    }
    #share{
        -moz-box-shadow: inset 1px -27px 19px 0px #36a7c6;
        -webkit-box-shadow: inset 1px -27px 19px 0px #36a7c6;
        box-shadow: inset 1px -27px 19px 0px rgb(88, 181, 82);
        background: -webkit-gradient(linear,left top,left bottom,color-stop(0.05,#99fffa),color-stop(1,#2d869c));
        background: -moz-linear-gradient(top,#99fffa 5%,#2d869c 100%);
        background: -webkit-linear-gradient(top,#99fffa 5%,#2d869c 100%);
        background: -o-linear-gradient(top,#99fffa 5%,#2d869c 100%);
        background: -ms-linear-gradient(top,#99fffa 5%,#2d869c 100%);
        background: linear-gradient(to bottom,#99fffa 5%,#2d869c 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#99fffa',endColorstr='#2d869c',GradientType=0);
        background-color: #99fffa;
        -moz-border-radius: 6px;
        -webkit-border-radius: 6px;
        border-radius: 6px;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-size: 13px;
        padding: 7px 30px;
        text-decoration: none;
        text-shadow: 0px 1px 0px #0586ff;
    }
    #share:hover {
        background: -webkit-gradient(linear,left top,left bottom,color-stop(0.05,#2d869c),color-stop(1,#99fffa));
        background: -moz-linear-gradient(top,#2d869c 5%,#99fffa 100%);
        background: -webkit-linear-gradient(top,#2d869c 5%,#99fffa 100%);
        background: -o-linear-gradient(top,#2d869c 5%,#99fffa 100%);
        background: -ms-linear-gradient(top,#2d869c 5%,#99fffa 100%);
        background: linear-gradient(to bottom,#2d869c 5%,#99fffa 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2d869c',endColorstr='#99fffa',GradientType=0);
        background-color: #2d869c;
    }
    #share:active {
        position: relative;
        top: 1px;
    }
    hr{
        border-top: 1px solid #000;
    }

</style>
<div class="kss-container">
    <div class="kss-home kss-parties">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded"></div>
            <div class="kss-header">
                <div class="col-md-3 col-sm-3 col-xs-4">
                    <img src="images/logo.png" alt="Kss" title="Logo">
                </div>
                <div class="col-md-9 col-sm-9 col-xs-8">
                    <div class="pull-right">
                        <a class="kss-home-btn" style="position: relative;" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a><br>
                        <a href="<?php echo $back_url;?>" class="save-btn">Back</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div style="position: absolute; width: 100%;">
                    <div class="pull-left col-sm-4">
                        <div class="bubble-1"></div>
                        <div class="bubble-2"></div>
                        <div class="bubble-3"></div>
                    </div>
                    <div class="pull-right col-sm-4">
                        <div class="bubble-2"></div>
                        <div class="bubble-3"></div>
                        <div class="bubble-1"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-2 col-xs-2 hidden-xs" style="font-family: Broadway; margin-top: 10%">
                    <div>share</div>
                    <div style="font-size: 24px;margin: 0px 0px 0px 8%">play</div>
                    <div>fun</div>
                    <div style="font-size: 26px;margin: 0px 0px 0px 12%">joy</div>
                    <div style="font-size: 28px;margin: 0px 0px 0px 24%">smile</div>
                </div>
                <div class="form-horizontal col-sm-8 col-xs-12">
                    <hr>
                    <form class="form-horizontal" id="experience">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label save-btn" style="color: whitesmoke">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" required id="Email3" placeholder="JESSICA NEWMAN">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label save-btn" style="color: whitesmoke">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" required name="email" id="Email3" placeholder="jessicanewman@gmail.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject_date" class="col-sm-3 control-label save-btn" style="color: whitesmoke">Subject</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" required name="subject" id="Subject3" placeholder="CAMP EXPERIENCE APHRIL 25TH, 2014">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="col-sm-3 control-label save-btn" style="color: whitesmoke">Message</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="3" required name="message" id="Message3" placeholder="MY SON ENJOY GREATLY SOCCER CAMP, DEFINITELY WILL ENROLL NEXT SUMMER, EXCELLENT EXPERIENCE AND EXCELLENT COACHES! I DEFENILETY RECOMMEND THIS CAMP!"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="attachment" class="col-sm-3 control-label save-btn" style="color: whitesmoke">Attachment</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="file" id="File3" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="hidden" name="reqtype" value="Experience">
                                <input type="submit" class="btn btn-default SubmitBtn save-btn pull-right" id="share" value="+Share Experience"></input>
                            </div>
                        </div>
                    </form>
                    <hr>

                </div>
                <div class="col-sm-2 col-xs-2 hidden-xs" style="font-family: Broadway; margin-top: 10%">
                    <div  style="font-size: 34px;margin: 0px 0px 0px 0px">share</div>
                    <div style="font-size: 24px;margin: 0px 0px 0px 8%">play</div>
                    <div>fun</div>
                    <div style="font-size: 18px;margin: 0px 0px 0px 0px">joy</div>
                    <div style="font-size: 14px;margin: 0px 0px 0px 24%">smile</div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-3" style="margin-top: 3%">Kss programs © all right reserved</div>
            <div class="col-sm-6">For more information about parties and camps please email <a href="">info@kssprograms.com</a></div>
            <div class="col-sm-3">
                <!--<button type="submit" class="btn btn-default pull-right" id="sh-exp">Share Your Experience</button>-->
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
