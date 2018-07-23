<?php include_once "head.php"?>
<style>
    .classes .col-md-3 img{
        max-height: 130px;
    }
    .classes .col-md-3 a{
       color: black;
    }
    .classes .col-md-4 .blue-btn{
        width: 100%;
    }
    .classes-user{
        margin-top: 100px;
    }
    .classes{
        margin-top: -130px;
    }
    .psubcat{
        min-height: 165px;
    }
</style>
<div class="kss-container">
    <div class="kss-home kss-programs">
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
            <div class="col-sm-3">
                <?php
                if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){

                }else{
                    ?>
                    <div class="col-md-12 col-sm-12 hidden-xs kss-user classes-user">
                        <span style="color: black;">If you want to enjoy with us create your account and<br><span style="font-family: Broadway; font-size: 17px;"> JOIN US NOW!!!</span></span>
                        <form class="LoginForm">
                            <input type="email" placeholder="USERNAME" required="" name="username">
                            <input type="password" placeholder="PASSWORD" required="" name="password">
                            <input type="hidden" name="reqtype" value="Login">
                            <input type="hidden" name="referrer" value="Classes">
                            <input type="submit" class="SubmitBtn" value="Login"><br>
                        </form>
                        WITHOUT AN ACCOUNT ?<br>
                        <a href="register.php" class="join-us-btn">JOIN US</a><br>
                    </div>
                <?php
                }
                ?>

            </div>
            <div class="classes col-sm-8">
                <div class="col-sm-12">
                    <img src="images/classes/la.png"><div class="clearfix"></div>
                </div>
                <div align="center">
                    <div class="col-sm-12">

                        <span style="font-family: Broadway; margin: 0; font-size: 17px;">...WE OFFER A WIDE RANGE OF ACTIVITIES FOR BOYS AND GIRLS!</span>
                        <br>
                        <span style="text-transform: none;color: black;">Please take the time to look over the programs we have for your child, separated in four areas:</span>

                    </div> <div class="clearfix"></div>
                    <br>
                    <div class="psubcat col-md-3 col-sm-3 col-xs-6">
                        <a href="javascript:void(0);" data-val="Sports & Movement" class="cat-link">
                            <img src="images/classes/sp.png">
                        </a>
                        <a href="javascript:void(0);" data-val="Sports & Movement" class="cat-link">
                            Sports & Movement
                        </a>
                    </div>
                    <div class="psubcat col-md-3 col-sm-3 col-xs-6">
                        <a href="javascript:void(0);" data-val="Scolastics" class="cat-link">
                            <img src="images/classes/sc.png">
                        </a>
                        <a href="javascript:void(0);" data-val="Scolastics" class="cat-link">
                            Scolastics
                        </a>
                    </div>
                    <div class="psubcat col-md-3 col-sm-3 col-xs-6">
                        <a href="javascript:void(0);"  data-val="Creative Arts" class="cat-link">
                            <img src="images/classes/pa.png">
                        </a>
                        <a href="javascript:void(0);" data-val="Creative Arts" class="cat-link">
                            Creative Arts
                        </a>
                    </div>
                    <div class="psubcat col-md-3 col-sm-3 col-xs-6">
                        <a href="javascript:void(0);" data-val="Performing Arts" class="cat-link">
                            <img src="images/classes/ca.png">
                        </a>
                        <a href="javascript:void(0);" data-val="Performing Arts" class="cat-link">
                            Performing Arts
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a class="blue-btn" style="    padding-top: 15px;    padding-bottom: 15px;" href="gallery.php">Gallery</a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a class="blue-btn" style="    padding-top: 15px;    padding-bottom: 15px;" href="experiences.php">Experiences</a>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <a class="blue-btn" href="share_experiences.php">Share Your<br>Experiences</a>
                    </div>
                </div>

            </div><div class="clearfix"></div>


            <div class="kss-home-r3" style="margin-top: 10px;">
                <div class="col-sm-12" style="font-size:16px;color:black;text-transform: lowercase;">…All of our instructors have undergone thorough background checks and have experience working with children!.</div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="owl-carousel ">
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
            <script>
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
                            items:4
                        }
                    }
                });
            </script>
            <div class="clearfix"></div>
            <div class="kss-footer">
                <?php include_once "footer.php";?>
            </div>
        </div>

        <div class="kss-col2 col-md-2 col-sm-12 col-xs-12 ">

                <?php include_once "adv_section.php"?>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php include_once "include_bottom.php"?>


