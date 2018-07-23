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
</head>
<link rel="stylesheet" href="css/pkstyle.css">
<body>
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
    .class-btn {
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
    .class-btn:hover {
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2d869c), color-stop(1, #99fffa));
        background:-moz-linear-gradient(top, #2d869c 5%, #99fffa 100%);
        background:-webkit-linear-gradient(top, #2d869c 5%, #99fffa 100%);
        background:-o-linear-gradient(top, #2d869c 5%, #99fffa 100%);
        background:-ms-linear-gradient(top, #2d869c 5%, #99fffa 100%);
        background:linear-gradient(to bottom, #2d869c 5%, #99fffa 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2d869c', endColorstr='#99fffa',GradientType=0);
        background-color:#2d869c;
    }
    .class-btn:active {
        position:relative;
        top:1px;
    }

</style>
<div class="kss-container">
    <div class="kss-store">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded">
            </div>
            <div class="kss-header">
                <div class="col-md-3 col-sm-3 col-xs-4 logo">
                    <img width="150px" src="images/logo.png">
                </div>
                <div class="col-md-5 col-sm-5 col-xs-6">
                `   <img width="150px" src="images/clas1.png">
                    <div class="col-md-12 col-sm-12 col-xs-12" kss-user>
                    <p style="font-family: Broadway;size: 28px;margin-left: 25%">...WE OFFER A WIDE RANGE OF ACTIVITIES FOR BOYS AND GIRLS!</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 hidden-xs kss-user">
                    <div class="pull-right">
                        <a class="kss-home-btn" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </div><div class="clearfix"></div>
                </div>
                <div class="visible-xs col-xs-2 pull-right" style="cursor:pointer;margin-top: 3%;"><i class="fa fa-bars" style="font-size: 35px;" aria-hidden="true"></i></div>
                <div class="clearfix"></div>
                <div class="col-xs-12 kss-mobile-show kss-user" >
                    <div class="kss-menu">
                        <a class="kss-home-btn" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </div>
                    <input type="text" placeholder="USERNAME" name="username">
                    <input type="password" placeholder="PASSWORD" name="password">
                    <input type="button" value="Login"><br>
                    WITHOUT AN ACCOUNT ?<br>
                    <a href="" style="font-size: 20px;    font-weight: 700;">JOIN US</a><br>
                    <a href="">FORGET PASSWORD</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="kss-store-main">
                <div class="col-md-12 col-sm-12 col-xs-12" kss-user>
                    <div style="margin-left: 35%;">
                        <P>Please take the time to look over the programs we have for your child,<br> separated in four areas:</P>
                        </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="col-md-12 col-sm-12 col-xs-12" kss-user>
                    <p style="alignment: center"> If you want to enjoy with us create your account and <br><span style="font-family:Broadway;size: 26px ">JOIN US NOW!!!</span></p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" kss-user>
                        <input type="text" placeholder="USERNAME" name="kss-user" style="padding: 6px 8px;border: 0;background: rgba(246,246,246,0.78);border-radius: 7px;width: 100%;">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" kss-user>
                        <input type="password" placeholder="PASSWORD" name="kss-user" style="padding: 6px 8px;border: 0;background: rgba(246,246,246,0.78);border-radius: 7px;width: 100%;">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" kss-user>
                        <a href="" class="class-btn">log IN</a><br>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12" kss-user>
                        <a href="" class="class-btn">New Account</a>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <img width="150px" src="images/clas2.png">
                        <P>SPORTS & MOVEMENT</P>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        `   <img width="150px" src="images/clas3.png">
                        <P>SCHOLASTICS</P>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <img width="150px" src="images/clas4.png">
                        <P>CREATIVE ARTS</P>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        `   <img width="150px" src="images/clas5.png">
                        <P>PERFORMING ARTS</P>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4" kss-user>
                        <a href="" class="class-btn">Gallery</a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <a href="" class="class-btn">Experience</a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <a href="" class="class-btn">Share Your Experience!</a>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12" kss-user>
                    <P>...All of our instructors have undergone thorough background checks and have experience working with children!.</P>
                </div>
            </div>

            <div class="kss-store-main">
                <div class="kss-home-r3">
                    <div class="col-md-12 col-md-12 col-sm-12">
                        <div class="owl-carousel ">
                            <div class="article">
                                <a href="#"> <img src="images/home-slide/cook.png"></a>
                            </div>
                            <div class="article">
                                <a href="#"> <img src="images/home-slide/mus.png"></a>
                            </div>
                            <div class="article">
                                <a href="#"> <img src="images/home-slide/ches.png"></a>
                            </div>
                            <div class="article">
                                <a href="#"> <img src="images/home-slide/socc.png"></a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <script>
                        $(document).ready(function()
                        {
                            $('.owl-carousel').owlCarousel({
                                items: 1,
                                loop: true,
                                margin: 10,
                                lazyLoad: true,
                                merge: true,
                                video: true,
                                responsive:{
                                    480:{
                                        items:1
                                    },

                                    678:{
                                        items:2
                                    },

                                    960:{
                                        items:4
                                    }
                                }
                            });
                        });
                    </script>

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
                    <img src="images/adv/adv2.png">
                </a>
                <a href="">
                    <img src="images/adv/adv3.png">
                </a>
                <a href="">
                    <img src="images/adv/adv4.png">
                </a>
                <a href="">
                    <img src="images/adv/adv5.png">
                </a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</body>
</html>

<script>
    $(function () {
        $(".fa-bars").click(function () {
            $(".kss-mobile-show").toggle();
        }) ;
    });
</script>