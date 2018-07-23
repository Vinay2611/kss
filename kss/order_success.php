<?php include_once "head.php";
if(isset($_SESSION['payment_status']) && isset($_SESSION['payment_id'])){
    $payment_id=$_SESSION['payment_id'];
    unset($_SESSION['payment_id']);
    unset($_SESSION['payment_status']);
}else{
    echo "Invalid request";die;
}
?>
<div class="kss-container">
    <div class="kss-home kss-cm-bx">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded">
            </div>
            <div class="kss-header">
                <div class="col-md-3 col-sm-3 col-xs-4">
                    <img src="images/logo.png" alt="Kss" title="Logo">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-8 hidden-xs kss-menu">
                    <div class="">
                        <a class="kss-btn" href="aboutus.php">About</a>
                        <a class="kss-btn" href="contactus.php">Contact</a>
                        <a class="kss-home-btn" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 hidden-xs kss-user">
                    <?php if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
                        ?>
                        <div style="    font-size: 18px; margin-top: 40px;   font-weight: 700;      letter-spacing: 2px;">Welcome </div>
                        <div><a href="profile.php"><?php echo $_SESSION['username']; ?></a> | <a href="logout.php">Logout</a></div>
                        <?php
                    } else{
                        ?>
                        <form class="LoginForm"><input type="text" placeholder="USERNAME" required name="username">
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
                        <a class="kss-home-btn" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                    </div>

                    <?php if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
                        ?>
                        <div style="    font-size: 18px; font-weight: 700;      letter-spacing: 2px;">Welcome </div>
                        <div><a href="profile.php"><?php echo $_SESSION['username']; ?></a> | <a href="logout.php">Logout</a></div>
                        <?php
                    } else{
                        ?>
                        <form class="LoginForm"><input type="text" placeholder="USERNAME" required name="username">
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
            <div class="kss-r2 kss-content">
                <div class="col-md-12" style="font-weight: 700; background: gainsboro;">
                    <h3>Your order has been placed successfully!<br>
                        Your Order No. is - <b><?php echo $payment_id?></b><br>
                    </h3>
                    <br>
                    <h4>
                        Please check your email for order detail!<br>
                        Thanks for your order !
                    </h4>

                </div>
                <div class="clearfix"></div>
            </div>
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

<script>
    $(function () {
        setTimeout(function () {
            // location.href="index.php";
        },7000)
    })
</script>
