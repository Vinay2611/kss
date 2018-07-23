<?php include_once "head.php";?>
    <style>
        .kss-container .kss-tutoring{
            text-transform: none;
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
        .box3{
            background-color: yellow;
            font-size: large;
            border-radius: 12px;
            background-color: rgba(224, 255, 4, 0.57);
            padding: 15px;
            text-align: center;
            margin-top: -15px;
        }
        .box4{
            background-color: #00a3d9;
            font-size: large;
            border-radius: 12px;
            background-color: rgba(26, 152, 255, 0.57);
            text-align: center;
            padding: 15px;
            margin-top: -15px;

        }
        .box5{
            margin-top: -15px;
            background-color: white;
            color: black;
            background-color: rgba(255, 255, 255, 0.57);
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            font-size: large;
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
                        <a href="index.php" class="back-btn BackClick">Back</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="kss-content row">
                    <div class="">
                        <div class="box1 col-sm-6 col-xs-12"><span></span></div>
                        <div class="box2 col-sm-6 col-xs-12">KSS Programs is excited to announce our<br>
                            <span style=" font-family: Broadway;">NEW TUTORING PROGRAM</span>
                        </div>
                        <div class="box3 col-sm-6 col-sm-offset-2 col-xs-12">KSS Programs can offer group-tutoring classes at schools. These classes are typically one hour long. They can be divided by grade and subject.   </div>
                            <div class="clearfix"></div>
                        <div class="box4 col-sm-6 col-sm-offset-4 col-xs-12">We offer tutoring in homework help, study skills, subjects, and SOL/MSA/CAS testing.</div>


                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-10">
                        <div class="box5"> We are also able to offer individual tutoring to students with specific needs.</div>
                        <div><p style="text-align: center;margin-top: 5px">If you are interested in learning more about individual or <br> group tutoring, please email <a
                                    href="">info@kssprograms.com</a></p></div>
                    </div>
                    <div class="col-xs-10 col-sm-2" style=""><span>...GO NOW!</span>
                        <a href="tutorings.php" class="save-btn">TUTORING</a>
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