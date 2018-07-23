<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" >
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!--    <link rel="stylesheet" href="css/home-slider.css">-->
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="fonts/style.css">
    <link rel="stylesheet" href="css/custom.css">
    <!--script for js-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment.js"></script>
    <!--    <script src="js/slider.min.js"></script>-->
    <script src="js/jquery.mousewheel.min.js"></script>
    <script src="js/jquery.carousel-1.1.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>

    <?php
    require "lib/lessc.inc.php";
    $less = new lessc;
    /*echo $less->compileFile("css/pkstyle.scss");*/
    $less->checkedCompile("css/pkstyle.less", "css/pkstyle.css");
    ?>
    <title>Kss Site</title>
    <style>
    h4{
        margin-top: 70px;
    }

    </style>
</head>
<link rel="stylesheet" href="css/pkstyle.css">
<body>
<div class="kss-container">
    <div class="kss-home">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded"></div>
            <div class="kss-header">
                <div class="col-md-3 col-sm-3 col-xs-4">
                    <img src="images/logo.png" alt="Kss" title="Logo">
                </div>
                <div class="pull-right">
                    <a class="kss-home-btn" style="position: relative;" href=""><i class="fa fa-home" aria-hidden="true"></i></a>
                </div>
            </div>
                <div class="form-horizontal register-page col-sm-10 col-sm-offset-2" style="margin-top: -105px;">
                    <form class="form-horizontal">
                        <div class="col-sm-6 col-sm-offset-4" style="font-size: 18px;">CREATE YOUR<br> ACCOUNT</div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" >YOU ARE </label>
                            <div class="col-sm-6">
                                <select>
                                    <option value="value1"> SELECT ONE </option>
                                    <option value="value1"> PARENT/GUARDIAN</option>
                                    <option value="value2"> PRINCIPAL/ ASSISTANCE PRINCIPAL/ PTA</option>
                                    <option value="value3"> BUSINESS </option>
                                    <option value="value3">ADMINISTRATOR / STAFF</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" >USER NAME</label>
                            <div class="col-sm-3">
                            <input type='text' name='username' id='username' maxlength="50" placeholder="USER NAME"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" >PASSWORD</label>
                            <div class="col-sm-3">
                            <input type='password' name='password' id='password' maxlength="50" placeholder="PASSWORD"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" >CONFIRM<br> PASSWORD</label>
                            <div class="col-sm-3">
                            <input type='password' name='password' id='password' maxlength="50" placeholder="PASSWORD"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" >SELECT A SECURITY QUESTION </label>
                            <div class="col-sm-6">
                            <select name="select" >
                                <option value="value1"> SELECT ONE </option>
                                <option value="value1"> Your Childhood Name</option>
                                <option value="value2">  Your Friend Name</option>
                                <option value="value3"> Your First Company Name </option>
                                <option value="value3"> Your First School Name</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" >SECURITY ANSWER</label>
                            <div class="col-sm-6">
                            <input type='text' name='ans' id='ans' maxlength="50" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4"></label>
                            <div class="col-sm-3">
                               <a href="" class="adv-btn">Terms and <br> Conditions</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4"></label>
                            <div class="col-sm-3">
                               <a href="" class="save-btn">Save</a>
                            </div>
                        </div>
                    </form>
                </div>
            <div class="kss-home-r3" style="margin-top: 50px;">
                <div class="col-sm-12">Kss programs © <span style="text-transform: lowercase">all right reserved</span></div>
            </div>
            <div class="clearfix"></div>
            <div class="kss-footer">
                <div class="footer-shadow"></div>
                <div class="col-md-3 col-sm-3 col-xs-12 bx" align="center" style="font-size: 12px;">
                    <div>would you like to advertising your company here?!<br></div>
                    <div style="margin: 10px 0px;"><a href="" class="adv-btn">Advertise Now</a><br></div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12 bx">
                    <img src="images/fimg1.png">
                    <img src="images/bimg12.png">
                    <img src="images/bimg2.png">
                    <img src="images/bimg3.png">
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 bx bx3">
                    Find Us On<br>
                    <a href="" class="facebook" >
                        <i class="fa fa-facebook-square" style="color: #314f87;" aria-hidden="true"></i>
                    </a>
                    <a href="" class="instagram">
                        <i class="fa fa-instagram" style="color: #907269;" aria-hidden="true"></i>
                    </a>
                    <a href="" class="pinterest">
                        <i class="fa fa-pinterest" style="color: #be2b29;" aria-hidden="true"></i>
                    </a>
                    <a href="" class="twitter">
                        <i class="fa fa-twitter" style="color:  #28a4d4;" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="kss-col2 col-md-2 col-sm-12 col-xs-12 ">
            <div class="kss-col2-inner">
                <a href="">
                    <img src="images/adv/adv1.png">
                </a>
                <a href="">

                </a>
                <a href="">

                </a>
                <a href="">

                </a>
                <a href="">

                </a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</body>
</html>