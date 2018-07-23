<?php
include_once "lib/config.php";
$uniq=uniqueString();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <style type="text/css">
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-button {
            width: 0px;
            height: 0px;
        }
        ::-webkit-scrollbar-thumb {
            background: #dcdcdc;
            border: 0px none #ffffff;
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #c0c0c0;
        }
        ::-webkit-scrollbar-thumb:active {
            background: #9a9a9a;
        }
        ::-webkit-scrollbar-track {
            background: #ffffff;
            border: 0px none #ffffff;
            border-radius: 0px;
        }
        ::-webkit-scrollbar-track:hover {
            background: #ffffff;
        }
        ::-webkit-scrollbar-track:active {
            background: #ffffff;
        }
        ::-webkit-scrollbar-corner {
            background: transparent;
        }
    </style>
    <link rel="stylesheet" href="<?php echo BASE_URL;?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>css/bootstrap-theme.min.css" >
    <link rel="stylesheet" href="<?php echo BASE_URL;?>css/font-awesome.min.css">
    <!--    <link rel="stylesheet" href="css/home-slider.css">-->
    <link rel="stylesheet" href="<?php echo BASE_URL;?>css/carousel.css">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>css/owl.carousel.css">

    <script src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script
        src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://necolas.github.io/normalize.css/5.0.0/normalize.css"></script>

    <![endif]-->
    <script src="<?php echo BASE_URL;?>js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL;?>js/moment.js"></script>
    <!--    <script src="js/slider.min.js"></script>-->
    <script src="<?php echo BASE_URL;?>js/jquery.mousewheel.min.js"></script>
    <script src="<?php echo BASE_URL;?>js/jquery.carousel-1.1.min.js"></script>
    <script src="<?php echo BASE_URL;?>js/owl.carousel.min.js"></script>
    <script src="<?php echo BASE_URL;?>js/toast.js"></script>

    <link rel="stylesheet" href="<?php echo BASE_URL;?>fonts/style.css">


    <?php
    require "lib/lessc.inc.php";
    $less = new lessc;
    /*echo $less->compileFile("css/pkstyle.scss");*/
    $less->checkedCompile("css/pkstyle.less", "css/pkstyle.css");
    ?>
    <link rel="stylesheet" href="<?php echo BASE_URL;?>css/pkstyle.css?id<?php echo $uniq;?>">
    <title>Kss Site</title>
    <script>
        var activePage='';
        var isLogged=false;
        var currentCat=0;
        var currentSubCat=0;
        var searchTxt="";
        var isProcessing=false;
        var backPage="";
        var backUrl="";
        var RunStoreAjax=false;
    </script>
</head>
<body>