<?php include_once "head.php";?>
    <style>
        .kss-container .kss-tutoring{
            text-transform: uppercase;
        }
        .back-btn {
            -moz-box-shadow:inset 1px -27px 19px 0px #36a7c6;
            -webkit-box-shadow:inset 1px -27px 19px 0px #36a7c6;
            box-shadow:inset 1px -27px 19px 0px #36a7c6;
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #99fffa), color-stop(1, #2d869c));
            background:-moz-linear-gradient(top, #99fffa 5%, #2d869c 100%);
            background:-webkit-linear-gradient(top, #99fffa 5%, #2d869c 100%);
            background:-o-linear-gradient(top, #99fffa 5%, #2d869c 100%);
            background:-ms-linear-gradient(top, #99fffa 5%, #2d869c 100%);
            background:linear-gradient(to bottom, #99fffa 5%, #2d869c 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#99fffa', endColorstr='#2d869c',GradientType=0);
            background-color:#99fffa;
            -moz-border-radius:6px;
            -webkit-border-radius:6px;
            border-radius:6px;
            display:inline-block;
            cursor:pointer;
            color:#000000;
            font-size:13px;
            padding:7px 30px;
            text-decoration:none;
            text-shadow:0px 1px 0px #0586ff;
        }
        .back-btn:hover {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2d869c), color-stop(1, #99fffa));
            background:-moz-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-webkit-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-o-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-ms-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:linear-gradient(to bottom, #2d869c 5%, #99fffa 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2d869c', endColorstr='#99fffa',GradientType=0);
            background-color:#2d869c;
        }
        .back-btn:active {
            position:relative;
            top:1px;
        }

        .box1{
            color: black;
            background-color: rgba(255, 255, 255, 0.57);
            border-radius: 12px;
            text-align: center;

            padding: 37px;
            float: right;

            width: 52%;
        }
        .box2{
            background-color: white;
            color: black;
            background-color: rgba(255, 255, 255, 0.57);
            border-radius: 12px;
            text-align: center;

            font-size: 20px;
            padding: 23px;
            float: right;
            margin-top: -86px;
        }


        .white-btn {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #f6f6f6));
            background:-moz-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
            background:-webkit-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
            background:-o-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
            background:-ms-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
            background: linear-gradient(to bottom, #ffffff 5%, #d8d8d8 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0);
            background-color:#ffffff;
            -moz-border-radius:6px;
            -webkit-border-radius:6px;
            border-radius:6px;
            cursor:pointer;
            color:#666666;
            padding: 12px 20px;
            margin-right: 10px;
            font-size: 15px;
            text-decoration:none;
            text-align: center;
        }
        .white-btn:hover {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2d869c), color-stop(1, #99fffa));
            background:-moz-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-webkit-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-o-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-ms-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:linear-gradient(to bottom, #2d869c 5%, #99fffa 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2d869c', endColorstr='#99fffa',GradientType=0);
            background-color:#2d869c;
        }

    </style>
    <div class="kss-container">
        <div class="kss-home kss-tutoring">
            <div class="kss-col1 col-md-10">
                <div class="kss-shaded"></div>
                <div class="kss-header">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <a href="index.php"> <img src="images/logo.png" alt="Kss" title="Logo"></a>
                    </div>
                    <div class="pull-right">
                        <a class="kss-home-btn" style="position: relative;" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                        <br>
                        <a href="tutoring.php" class="back-btn BackClick">Back</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="kss-content row">
                    <div class="col-sm-12">
                        <div class="box1 col-sm-6 col-xs-10"><span></span></div>
                        <div class="clearfix"></div>
                        <div class="box2 col-sm-6 col-xs-10">
                            <span style=" font-family: Broadway;">Select your tutoring program</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right col-sm-8 col-xs-12" style="    background: rgba(77, 105, 113, 0.63);    float: right;    padding: 35px;    border-radius: 12px;    margin-top: -17px;"></div>
                        <div style="width: 100%"><div class="pull-left col-sm-8" style="    background: rgba(192, 192, 64, 0.7);    float: right;    padding: 35px;    border-radius: 12px;    margin-top: -25px;"></div>
                            <div class="clearfix"></div>
                        </div>
                       <div class="clearfix"></div>
                            <div class="col-sm-offset-2" style=" width: 100%;    position: relative;    top: -80px;">
                                <a href="book_tutoring.php?type=grade"> <div class="col-md-2 col-sm-2 col-xs-4 white-btn">Tutoring by Grade</div></a>
                                <a href="book_tutoring.php?type=school"> <div class="col-md-2 col-sm-2 col-xs-4 white-btn">Tutoring by School</div></a>
                                <a href="book_tutoring.php?type=subject"> <div class="col-md-2 col-sm-2 col-xs-4  white-btn">Tutoring by Subject</div></a>
                                <a href="book_tutoring.php?type=subject"> <div class="col-md-2 col-sm-2 col-xs-4  white-btn">Request a Particular Subject</div></a>
                                <div class="clearfix"></div>
                            </div>

                            <div class="col-sm-8" style="text-transform: none;     margin-top: -75px;    float: right;   background-color: rgba(122, 186, 122, 0.74);    font-size: large;   border-radius: 12px;      /* padding: 2% 2% 2% 2%; */    text-align: center;    /* margin: -17px 0% 5% 52%; */    padding: 15px;">REMEMBER we are also able to offer individual tutoring to students with specific needs.</div>


                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-10">
                        <div class="" style="background-color: rgba(204, 204, 75, 0.72);    color: black;        border-radius: 12px;text-align: center;    font-size: large;    padding: 20px;    margin-top: -20px;"> <p style="text-transform:none;text-align: center;margin-top: 5px">If you are interested in learning more about individual or <br> group tutoring, please email <a                                    href="">info@kssprograms.com</a></p></div>

                    </div>
                </div>
                <div class="kss-home-r3" style="margin-top: 50px;">
                    <br>
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