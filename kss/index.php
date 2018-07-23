
<?php include_once "head.php";?>

    <div class="kss-container">
        <div class="kss-home kss-cm-bx">
            <div class="kss-col1 col-md-10">
                <div class="kss-shaded">
                </div>
                <div class="kss-header">
                    <div class="col-md-3 col-sm-3 col-xs-4">
                        <img src="images/logo.png" alt="Kss" title="Logo">
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-8 hidden-xs kss-menu">
                        <div class="">
                            <a class="kss-btn" href="aboutus.php">About</a>
                            <a class="kss-btn" href="contactus.php">Contact</a>
                            <a class="kss-home-btn" href=""><i class="fa fa-home" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-8 ">

                    </div>
                    <div class="col-md-3 col-sm-3 hidden-xs kss-user">
                        <?php if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
                            ?>
                            <div style="font-size: 18px; margin-top: 40px;   font-weight: 700;      letter-spacing: 2px;">Welcome </div>
                            <div><a href="profile.php"><?php echo $_SESSION['username']; ?></a> | <a href="logout.php">Logout</a></div>
                            <?php
                        } else{
                            ?>
                            <form class="LoginForm">
                                <input type="email" placeholder="USERNAME" required name="username">
                                <input type="password" placeholder="PASSWORD" required name="password">
                                <input type="hidden" name="reqtype" value="Login">
                                <input type="submit" class="SubmitBtn" value="Login"><br></form>
                            WITHOUT AN ACCOUNT ?<br>
                            <a href="register.php" class="join-us-btn">JOIN US</a><br>
                            <a href="forget-password.php">FORGET PASSWORD</a>
                            <?php
                        }?>

                    </div>
                    <div class="visible-xs col-xs-2 pull-right" style="cursor:pointer;margin-top: 3%;"><i class="fa fa-bars" style="font-size: 35px;" aria-hidden="true"></i></div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12 kss-mobile-show kss-user" >
                        <div class="kss-menu">
                            <a class="kss-btn" href="aboutus.php">About</a>
                            <a class="kss-btn" href="contactus.php">Contact</a>
                            <a class="kss-home-btn" href=""><i class="fa fa-home" aria-hidden="true"></i></a>
                        </div>

                        <?php if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
                            ?>
                            <div style="    font-size: 18px; font-weight: 700;      letter-spacing: 2px;">Welcome </div>
                            <div><a href="profile.php"><?php echo $_SESSION['username']; ?></a> | <a href="logout.php">Logout</a></div>
                            <?php
                        } else{
                            ?>
                            <form class="LoginForm"><input type="email" placeholder="USERNAME" required name="username">
                                <input type="password" placeholder="PASSWORD" required name="password">
                                <input type="hidden" name="reqtype" value="Login">
                                <input type="submit" class="SubmitBtn" value="Login"><br></form>
                            WITHOUT AN ACCOUNT ?<br>
                            <a href="register.php" class="join-us-btn">JOIN US</a><br>
                            <a href="forget-password.php">FORGET PASSWORD</a>
                            <?php
                        }?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="kss-r2">
                    <div class="carousel hidden-sm  hidden-xs">
                        <div class="slides">
                            <?php
                            $stm = $con->prepare("select * from slider where featured = '1' and status= '1'");
                            $stm->execute();
                            $slider_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($slider_res as $sr){
                                ?>
                                <div class="slideItem">
                                    <a href="<?php echo $sr['link'];?>"><div class="slide_text"><?php echo $sr['title'];?></div></a>
                                    <a href="<?php echo $sr['link'];?>"> <img src="uploads/slider/<?php echo $sr['image']?>"></a>
                                    <div class="shadow">
                                        <div class="shadowLeft"></div>
                                        <div class="shadowMiddle"></div>
                                        <div class="shadowRight"></div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="owl-carousel hidden-lg hidden-md">
                        <?php
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

                <div class="kss-home-r3 col-xs-12" style="margin-top: 25px;">
                    <div class="col-md-4 col-sm-4 col-xs-12 kss-store-icon">
                        Visit<br>
                        <a href="store.php" style="font-size: 24px;    color: black;">
                            <img src="images/kss-store.png"><br>
                            Shop Now !
                        </a>
                        <br><br>
                    </div>
                    <div class="col-md-8 col-md-8 col-sm-8 col-xs-12 kss-cat">
                        <?php
                        $stm = $con->prepare("select * from categories where featured = '1' and status= '1' and parent_id='0'");
                        $stm->execute();
                        $cat_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($cat_res as $sr){
                            $link="";
                            if($sr['name']=="CLASSES"){
                                $link="classes.php";
                            }elseif($sr['name']=="SCHOOL PROGRAM"){
                                $link="programs.php";
                            }
                            elseif($sr['name']=="PARTIES AND CAMPS"){
                                $link="parties-camps.php";
                            }
                            elseif($sr['name']=="TUTORING"){
                                $link="tutoring.php";
                            }
                            ?>
                            <div class="col-md-2 col-sm-3 col-xs-6">
                                <a href="<?php echo $link; ?>">
                                    <img src="uploads/cat/<?php echo $sr['image']?>">
                                </a>
                                <a href="<?php echo $link; ?>">  <div  class="cat-link">

                                    <?php echo $sr['name']?>
                                </div></a>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-4" align="center">Kss programs © <span style="text-transform: lowercase">all right reserved</span><br><br></div>

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

