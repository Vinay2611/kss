<?php include_once "head.php";?>
<body>
<div class="kss-container">
    <div class="kss-about">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded"></div>
            <div class="kss-header">
                <div class="col-md-12 col-sm-12 col-xs-12" align="center">
                    <div class="col-xs-offset-2 col-md-8 col-sm-8 col-xs-8  ">
                        <div style="font-family: Broadway;font-size: 25px;">contact us</div>
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="col-sm-5" style="border-bottom: 2px solid;"></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-5"  style="border-bottom: 2px solid;"></div>
                            <div style="position: absolute;    right: -50px;    top: -60px;"> <a class="kss-home-btn" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a></div>
                        </div>
                        <div class="clearfix"></div>
                        <h1 style="font-family: Broadway; margin: 0; font-size: 60px;">KSS</h1>
                        <div align="center">PROGRAMS</div>
                    </div> <div class="clearfix"></div>
                    <div align="center" class="col-sm-12" style="font-size: 16px;"><b><i>PROGRAMS CAN BE REACHED BY PHONE, EMAIL, OR MAIL</i></b></div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-sm-12" style=" font-size: 14px; letter-spacing: 1px;  color: black;  padding: 25px; background-color: rgba(195, 195, 195, 0.29);">
                    <h3 align="right">2945724522 <b class="bway">Phone</b></h3>
                    <div class="bway pull-left"><h3>Email:</h3></div>
                    <div class="pull-right" style="font-size: 16px;">PO Box 16211 Alexandria VA 22302 &nbsp;<span style="font-size:22px; " class="bway">Mail</span></div>
                    <div class="clearfix"></div>
                    <div >
                        For general questions &nbsp;&nbsp;&nbsp; + <span class="c-grn">info@kssprograms.com</span><br>
                        For immediate assistance +  <span class="c-grn">help@kssprograms.com</span><br>
                        To learn more about the programs we are currently offering and to register, visit<br>
                        www.bluesombrero.com/khary
                        <br> <br>
                        <a href="employment.php"><div class="emp-link" style="font-size: 25px; color: #11726b;" align="right">CLICK HERE FOR EMPLOYEMENT INFORMATION</div></a>
                    </div>
                </div>
            </div>
            <br>
            <div class="kss-home-r3">
                <div class="col-md-3 col-sm-2 hidden-xs">
                    <br>
                    <a href="index.php">
                        <img width="150px" src="images/logo.png">
                    </a>
                </div>
                <div class="col-md-9 col-md-9 col-sm-12">
                    <div class="owl-carousel">
                        <?php
                        $stm = $con->prepare("select * from slider where featured = '1' and status= '1'");
                        $stm->execute();
                        $slider_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($slider_res as $sr){
                            ?>
                            <div class="article"><a href="<?php echo $sr['link'];?>"><div class="slide_text"><?php echo $sr['title'];?></div></a>
                                <a href="<?php echo $sr['link'];?>"> <img src="uploads/slider/<?php echo $sr['image']?>"></a>
                            </div>
                            <?php
                        }
                        ?>
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
                            autoplay:true,
                            nav:true,
                            navText: [
                                "<i class='fa fa-chevron-left'></i>",
                                "<i class='fa fa-chevron-right'></i>"
                            ],
                            video: true,
                            responsive:{
                                480:{
                                    items:1
                                },

                                678:{
                                    items:2
                                },

                                960:{
                                    items:3
                                }
                            }
                        });
                    });
                </script>

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