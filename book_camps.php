<?php include_once "head.php";
if(isset($_GET['type'])){
    $type=$_GET['type'];
    if($type=='season'){
        $cat="Camps by Season";
    }elseif ($type=='date'){
        $cat="Camps by Date";
    }elseif ($type=='school'){
        $cat="Camps by School";
    }elseif ($type=='location'){
        $cat="Camps by Location";
    }else{
        echo "Invalid Request";die;
    }

    $stm = $con->prepare("select * from packages where type='Camps' and category='$cat'");
    $stm->execute();
    $PackageList = $stm->fetchAll(PDO::FETCH_ASSOC);

}
?>
<style>
    .kss-parties input[type='text'],.kss-parties select,.kss-parties input[type='number']{
        padding: 6px 8px;
        border: 0;
        background: rgba(246,246,246,0.78);
        border-radius: 7px;
        box-shadow: 1px 2px 11px #807979;
    }
    #sample_5{
        background: rgba(246,246,246,0.78);
        border-radius: 7px;
    }
    .boxshadows{
        background: rgba(184,184,184,0.79);
        border-radius: 8px;
    }
    .catTitle{
        background: #f7f7f7;
        padding: 20px 4px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0px 1px 4px #cec8c8;
    }
    .packageInfo .col-md-2{
        min-width: 22%;
        background-color: #eeeeee;
        margin: 5px;
        padding: 24px 2px;
        text-align: center;
        box-shadow: 1px 2px 11px #807979;
        border-radius: 5px;
    }
    .packageInfo{
        display: none;
        margin-top: -75px;
    }
    .InfoBox{
        padding: 10px;
        text-align: center;
        display: none;
        width: 100%;
        min-height: 200px;
        background: #eeeeee;
    }
    .packageBox{
        cursor: pointer;
    }
    html body .CardHtml input[type='radio']{
        width: inherit!important;
    }
</style>
<div class="kss-container">
    <div class="kss-home kss-parties">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded"></div>
            <div class="kss-header">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <a href="index.php"> <img src="images/logo.png" alt="Kss" title="Logo"></a>
                </div>
                <div class="pull-right">
                    <a class="kss-home-btn" style="position: relative;" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                    <br>
                    <a href="camps.php" class="back-btn BackClick">Back</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="kss-content">
                <div style="position: absolute; width: 100%;">
                    <div class="pull-right col-sm-4">
                        <div class="bubble-2"></div>
                        <div class="bubble-3"></div>
                        <div class="bubble-1"></div>
                    </div>
                </div>
                <div class="col-sm-12 cbox" style="z-index:10;color: black;">
                    <div class="col-md-offset-2 col-md-8 col-sm-8 col-xs-8">

                        <div class="col-sm-12" style=" padding: 8px;">
                            <div class="col-sm-3 catTitle">
                                <?php echo $cat;?>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group" >
                                    <label style="font-weight: 400;" ></label><br>
                                    <select class="SelPackage">
                                        <option value="">select</option>
                                        <?php foreach ($PackageList as $pl){
                                            ?>
                                            <option value="<?php echo $pl['id']?>"><?php echo $pl['package_title']?></option>
                                            <?php
                                        }?>
                                    </select>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2">
                        <div style="font-family: Broadway;">
                            <div style="font-size: 30px;">Share</div>
                            <div style="font-size: 22px;margin-left: 14px;">Play</div>
                            <div style="font-size: 16px;margin-left: -20px;">fun</div>
                            <div style="font-size: 24px;">JOY</div>
                            <div style="font-size: 24px;    margin-left: 28px;">SMILE</div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 packageInfo">
                        <div class="col-md-8 ">
                            <div class="col-md-2 packageBox p-age" data-title="Age" data-description="">AGE
                            </div>
                            <div class="col-md-2 packageBox p-time" data-title="Time" data-description="">TIME
                            </div>
                            <div class="col-md-2 packageBox p-location" data-title="LOCATION" data-description="">LOCATION
                            </div>
                            <div class="col-md-2 packageBox p-description" data-title="Description" data-description="description dummy text">Description
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-2 packageBox p-bring" data-title="What to Bring" data-description="" style="font-size: 12px;">What to Bring
                            </div>
                            <div class="col-md-2 packageBox p-wear" data-title="What to Wear" data-description="">What to Wear
                            </div>
                            <div class="col-md-2 packageBox p-fees" data-title="Fees" data-description="">Fees
                            </div>
                            <div class="col-md-2 BuyNowBtn">BUY NOW
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="InfoBox">
                                <div align="center" style="font-weight: 700; margin-bottom: 10px;" class="InfoTitle">

                                </div>
                                <div class="InfoDesc">

                                </div>
                            </div>
                            <div class="PackagePay" style="display: none;background: #e2e2e2;    padding: 15px 7px;">
                                <?php
                                $card=false;
                                if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
                                    $card=true;
                                    ?>
                                    <?php
                                } else { ?>
                                    <div class="col-md-12 col-sm-12 kss-user">
                                        <form class="LoginForm">
                                            <input type="email" placeholder="USERNAME" required="" name="username">
                                            <input type="password" placeholder="PASSWORD" required="" name="password">
                                            <input type="hidden" name="reqtype" value="Login">
                                            <input type="hidden" name="referrer" value="Classes">
                                            <input type="submit" class="SubmitBtn" value="Login to Book"><br>
                                        </form>
                                        WITHOUT AN ACCOUNT ?<br>
                                        <a href="register.php" class="join-us-btn">JOIN US</a><br>
                                    </div>
                                <?php }?>
                                <div class="clearfix"></div>
                                <div class="CardHtml" style="display:<?php echo $card==true?'block':'none';?>">
                                    Fee Details
                                    <div class="FeeDetail">

                                    </div>
                                    <hr>
                                    <div class="pull-right">
                                        <a href="javascript:void(0);" id="AddToCart2" class="blue-btn EnrollNow">Book</a><br>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="owl-carousel11 ">
                        <div class="article">
                            <a href=""> <img src="images/party_camp/sh1.png"></a>
                        </div>
                        <div class="article">
                            <a href=""> <img src="images/party_camp/sh4.png"></a>
                        </div>
                        <div class="article">
                            <a href=""> <img src="images/party_camp/sh1.png"></a>
                        </div>
                        <div class="article">
                            <a href=""> <img src="images/party_camp/sh4.png"></a>
                        </div>


                    </div>
                    <script>
                        $('.owl-carousel11').owlCarousel({
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
                    <div class="col-md-12" align="center">
                        <br>
                        For more information about parties please email <br> <a href="mailto:info@kssprograms.com">info@kssprograms.com</a>
                    </div>

                </div>

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

<script>
    var width = $(window).width(), height = $(window).height();

    $(function () {

        $(".packageBox").click(function () {
            if ((width <= 640)) {
                $(".InfoBox").show();
                $(".PackagePay").hide();
                $('html,body').animate({
                    scrollTop: $(".InfoBox").offset().top},
                'slow');
            }
            else
            {
                $(".InfoBox").show();
                $(".PackagePay").hide();
            }

            $(".InfoBox .InfoTitle").html($(this).attr('data-title'));
            $(".InfoBox .InfoDesc").html($(this).attr('data-description'));
        });

        $(".BuyNowBtn").click(function () {
            $(".PackagePay").show();
            $(".InfoBox").hide();

        });
        $(".SelPackage").change(function () {
            if($(this).val()==""){
                $(".PackagePay").hide();
                $(".InfoBox").hide();
                $(".packageInfo").hide();
                return false;
            }
            $.ajax({
                type	: "POST",
                url	: "lib/ServerResponse.php",
                dataType : 'json',
                data : {
                    package: $(this).val(),
                    reqtype:'GetPackage'
                },
                success	: function (resp) {
                    if(resp.success) {
                        if(resp.data){
                            $(".packageInfo").show();
                            $(".p-age").attr('data-description',resp.data['age']);
                            $(".p-time").attr('data-description',resp.data['time']);
                            $(".p-description").attr('data-description',resp.data['description']);
                            $(".p-location").attr('data-description',resp.data['location']);
                            $(".p-bring").attr('data-description',resp.data['what_bring']);
                            $(".p-wear").attr('data-description',resp.data['what_wear']);
                            $fee=JSON.parse(resp.data['fee_detail']);
                            $fee_op="";
                            $fee_op2="";
                            $i=0;
                            $package_id=resp.data['id'];
                            $.each($fee['fees'],function (index,val) {
                                $fees=$fee['fees'][$i];
                                $desc=$fee['description'][$i];
                                $fee_op+='$'+$fees+' '+$desc+'<br>';
                                $fee_op2+='<input type="radio" data-id="'+$package_id+'" data-price="'+$fees+'" data-desc="'+$desc+'" class="package_fees" name="package_fees" value="'+$fees+'"> $'+$fees+' '+$desc+'<br>';
                                $i++;
                            });
                            $(".FeeDetail ").html($fee_op2);
                            $(".p-fees").attr('data-description',$fee_op);

                        }else{
                            $.toaster({ priority : 'warning', title : 'Error', message : "No Data Found!"});
                        }
                    }else{
                        $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
                        console.log(resp.msg);
                    }
                    /* $(".loading").remove();
                     $elm.show();*/
                }
            });
        });

        $(document).on('click','#AddToCart2',function () {
            if(!$("input[name=package_fees]:checked").length>0){
                $.toaster({ priority : 'warning', title : 'Error', message : "Please select a package!"});
                return false;
            }
            $fees=$("input[name=package_fees]:checked").attr('data-price');
            $package=$("input[name=package_fees]:checked").attr('data-id');
            $data_desc=$("input[name=package_fees]:checked").attr('data-desc');

            if(isProcessing){return false;}
            isProcessing=true;
            $elm=$(this);
            $elm.html("Processing");
            // $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
            $.ajax({
                type	: "POST",
                url	: "lib/my_cart.php",
                dataType : 'json',
                data	:{
                    id:$package,
                    reqtype:'add',
                    item_type:'camps',
                    color:'',
                    size:'',
                    quantity:'1',
                    package_total:$fees,
                    item_description:$data_desc
                },
                success	: function (resp) {
                    if(resp.success){
                        $elm.html('Added to Bag');
                        $.toaster({ priority : 'success', title : 'Success', message : "Added to Cart"});
                        setTimeout(function () {
                            location.href="addon_packages.php";
                        },1500);
                    }else{
                        $elm.html('Add To Bag');
                        $.toaster({ priority : 'warning', title : 'Error', message : "Please Try Again!"});
                    }
                    /*$(".loading").remove();
                     $elm.show();*/
                }
            });
        });

        /*$("#PayWithCard2").click(function () {

            $number=$("input[name=cardnumber]").val();
            $cvc=$("input[name=cvc]").val();
            $exp_month=$("select[name=exp_month]").val();
            $exp_year=$("select[name=exp_year]").val();

            if(!$("input[name=package_fees]:checked").length>0){
                $.toaster({ priority : 'warning', title : 'Error', message : "Please select a package fees!"});
                return false;
            }
            $fees=$("input[name=package_fees]:checked").attr('data-price');
            $package=$("input[name=package_fees]:checked").attr('data-id');

            if(!validateCard()){
                return false;
            }

            $elm=$(this);
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
            $.ajax({
                type	: "POST",
                url	: "lib/ServerResponse.php",
                dataType : 'json',
                data : {
                    package_type:'camp',
                    package_id:$package,
                    fees:$fees,
                    cardnumber:$("input[name=cardnumber]").val(),
                    cvc:$("input[name=cvc]").val(),
                    exp_month:$("select[name=exp_month]").val(),
                    exp_year:$("select[name=exp_year]").val(),
                    reqtype:"ValidatePackage"
                },
                success	: function (resp) {
                    if(resp.success) {
                        $.ajax({
                            type	: "POST",
                            url	: "lib/authorize/PaymentTransactions/charge-credit-card2.php",
                            dataType : 'json',
                            data : {
                                reqtype:"ChargeCard"
                            },
                            success	: function (resp) {
                                if(resp.success) {
                                    $.toaster({ priority : 'success', title : 'Success', message : resp.msg});
                                    setTimeout(function () {
                                        location.reload();
                                    },3000);
                                }else{
                                    $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
                                    console.log(resp.msg);
                                }
                                $(".loading").remove();
                                $elm.show();
                            }
                        });
                    }else{
                        $.toaster({ priority : 'warning', title : 'Error', message : "Invalid Details"});
                        console.log(resp.msg);
                    }
                }
            });
        });*/
    });
</script>
