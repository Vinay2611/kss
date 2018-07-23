<?php include_once "head.php";
if(isset($_SERVER['HTTP_REFERER'])){
    $back_url=$_SERVER['HTTP_REFERER'];
}else{
    $back_url="index.php";
}
?>
    <style>
        hr{
            border-top: 0.5px solid #9da9b7;
        }
    </style>
    <div class="kss-container">
        <div class="kss-home">
            <div class="kss-col1 col-md-10">
                <div class="kss-shaded"></div>
                <div class="kss-header">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <a href="index.php"> <img src="images/logo.png" alt="Kss" title="Logo"></a>
                    </div>
                    <div class="pull-right">
                        <a class="kss-home-btn" style="position: relative;" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a><br>
                        <a href="<?php echo $back_url;?>" class="save-btn">Back</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="kss-content col-sm-10 col-sm-offset-1" style="color: black;   background: rgba(228, 228, 228, 0.62);    padding: 20px;    margin-top: 15px;    margin-bottom: 15px;">
                    <h3 style="font-family: Broadway" align="center">Experiences</h3>
                    <?php
                    $query="SELECT * FROM experience WHERE status AND featured=1";
                    $connect = $con->query($query);
                    $final = $connect->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($final as $f){
                        ?>
                        <div class="">
                            <div class="col-sm-9">
                            <p style="font-size: 18px;"><b>Shared By</b> : <?php echo $f['name'] ?></p>
                            <p><b>Subject</b> : <?php echo $f['subject'] ?></p>
                            <p><b>Message</b> : <?php echo $f['message'] ?></p>
                            <p><b>On Date</b> : <?php echo $f['created_date'] ?></p>
                            </div>
                            <div class="col-sm-3">
                                <?php if(!empty($f['attachment'])){
                                    ?>
                                    <img style="max-width: 100%" src="uploads/exper/<?php echo $f['attachment'];?>">

                            <?php
                                } ?>
                            </div>
                            <div class="clearfix"></div>
                            <hr>

                        </div>
                    <?php } ?>
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