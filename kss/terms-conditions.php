<?php include_once "head.php"?>
<div class="kss-container">
    <div class="kss-home kss-terms">
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
            <div class="kss-content col-sm-12">
                <h3 style="color: black" align="center">Terms And Conditions</h3>

                <?php
                $sql = "SELECT * from pages where title='terms_conditions'";
                $users = $con->query($sql);
                $result = $users->fetch(PDO::FETCH_ASSOC);
                if($users->rowCount()>0){
                    echo $result['description'];
                }
                ?>
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

                <?php include_once "adv_section.php"?>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php include_once "include_bottom.php"?>

