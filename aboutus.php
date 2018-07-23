<?php include_once "head.php";?>
<style>
    .jumbotron p{
        margin-bottom: 15px;
        font-size: 14px;
        font-weight: 200;
    }
    .jumbotron {
        padding-top: none;
        padding-bottom: none;
    }
    body{
        line-height:none;
    }
    hr{
        border-top: 1px solid;
    }
</style>
<div class="kss-container">
    <div class="kss-about">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded"></div>
            <div class="kss-header">
                <div class="col-md-12 col-sm-12 col-xs-12" align="center">
                    <div class="col-xs-offset-2 col-md-8 col-sm-8 col-xs-8  ">
                        <div style="font-family: Broadway;font-size: 25px;">about us</div>
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="col-sm-5" style="border-bottom: 2px solid;"></div>
                            <div class="col-sm-2"></div>
                            <div class="col-sm-5"  style="border-bottom: 2px solid;"></div>
                           <div style="position: absolute;    right: -50px;    top: -60px;"> <a class="kss-home-btn" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a></div>
                        </div>
                        <div class="clearfix"></div>
                        <h1 style="font-family: Broadway; margin: 0; font-size: 60px;">KSS</h1>
                        <div align="center">PROGRAMS</div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            <div class="kss-r2" style="position: relative;z-index: 10">
                <div class="" style=" font-size: 12px; letter-spacing: 1px;   border-radius: 25px;    color: white;      padding: 25px;  background-color: rgba(0, 0, 0, 0.46);">
                            <p><b>KSS Programs was founded in 2001 as an after school soccer program where students could learn the skills and techniques of professional soccer players at the end of the regular school day. Falling under the direction of Khary Stockton, KSS Programs has expanded to offer a wide variety of extracurricular activities to students in the DC Metro area. Since his retirement after 13 years as a professional soccer player in the United States and abroad, Khary Stockton has been educating and mentoring young people in elementary, middle, and high school, as well as college.</b></p>
                            <p><b>KSS Programs was developed to assist schools in enriching their curricula by offering students the ability to participate in a wide variety of after school programs. Our aim is to relieve PTAs and schools from the additional stress of running an after school programming by offering quality extracurricular classes led by trained instructors, mentors, and coaches. We offer a comprehensive service dedicated to supporting the curriculum and cultures of local schools, while offering students exciting and engaging new experiences.</b></p>
                            <p><b>Whether you are a volunteer coordinator for a school, a parent, or a PTA member looking for more information about bringing an enrichment program to your school and students, we can help!</b></p>
                            <br>
                            <div style="float: right;"><p><b></b>FOR MORE INFORMATION EMAIL <a style="    color: #009ee1;" href="">INFO@KSSPROGRAMS.COM</a></b></p></div>
                    <div class="clearfix"></div>
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