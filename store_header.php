<div class="col-md-3 col-sm-3 col-xs-4 logo">
    <a href="store.php"><img src="images/product/storelogo.png" alt="Kss Store" title="Logo"></a>
</div>
<div class="col-md-5 col-sm-5 col-xs-6 kss-search">
    <div class="form-group">
        <div class="icon-addon addon-md">
            <input type="search" name="mysearch" placeholder="SEARCH FOR A PRODUCT OR ITEM NUMBER" class="search-box" id="search">
            <label for="search" style="color: #35a6c4;" class="fa fa-search" rel="tooltip" title="search"></label>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-4 hidden-xs kss-user">
    <div class="pull-right">
        <a class="kss-home-btn" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
    </div><div class="clearfix"></div>
    <div class="pull-right">
        <?php if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
            ?>
           <a href="profile.php"> <span style="font-weight: 700;"><?php echo $_SESSION['username']; ?></span>&nbsp;&nbsp;</a>
            <?php
        } else { ?>
            <a href="store-register.php">Sign In</a>/<a href="store-register.php">Join</a> &nbsp;
        <?php }?>

        <img width="35px;" src="images/flag.png">&nbsp;&nbsp;
        <a href="javascript:void(0);" class="back-btn BackClick">Back</a>
    </div>

</div>
<div class="visible-xs col-xs-2 pull-right" style="cursor:pointer;margin-top: 3%;"><i class="fa fa-bars" style="font-size: 35px;" aria-hidden="true"></i></div>
<div class="clearfix"></div>
<div class="col-xs-12 kss-mobile-show kss-user" >
    <div class="kss-menu">
        <a class="kss-home-btn" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
    </div>
    <?php if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
        ?>
        <a href="profile.php"> <span style="font-weight: 700;"><?php echo $_SESSION['username']; ?></span>&nbsp;&nbsp;</a> | <a href="profile.php">Wish List</a> | <a href="logout.php">Logout</a>
        <?php
    } else { ?>

        <form class="LoginForm">
            <input type="email" placeholder="USERNAME" required="" name="username">
            <input type="password" placeholder="PASSWORD" required="" name="password">
            <input type="hidden" name="reqtype" value="Login">
            <input type="submit" class="SubmitBtn" value="Login"><br>
        </form>
        WITHOUT AN ACCOUNT ?<br>
        <a href="store-register.php" style="font-size: 20px;    font-weight: 700;">JOIN US</a><br>
        <a href="forget-password.php">FORGET PASSWORD</a>
    <?php }?>


</div>