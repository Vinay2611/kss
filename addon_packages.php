<?php include_once "head.php";
$stm = $con->prepare("select * from packages where category='addon'");
$stm->execute();
$AddOnList = $stm->fetchAll(PDO::FETCH_ASSOC);
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
                    <div class="col-md-offset-2 col-md-8 col-sm-8 col-xs-8" style="padding:20px;z-index:1000;background: rgba(255, 255, 255, 0.68);">
                        <h4><b>Add On Packages</b></h4>
                        <div class="" style="display: block;">
                            <form id="addOnForm">
                            <table width="100%" class="table ResultTable">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Date &amp; Time</th>
                                    <th>Description</th>
                                    <th align="left">Fee</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php  $k=0; foreach ($AddOnList as $al){

                                        ?>
                                        <tr class="AddonRow <?php echo 'Row-'.$k;?>" data-id="<?php echo 'Row-'.$k;?>">
                                            <td><?php echo $al['package_title']?></td>
                                            <td><?php echo $al['location']?></td>
                                            <td><?php echo $al['time']?></td>
                                            <td><?php echo $al['description']?></td>
                                            <td align="left"><?php
                                                $j=0;
                                                $fd=(array)json_decode($al['fee_detail']);

                                                ?>
                                                    <input type="checkbox" data-id="<?php echo $al['id'];?>" data-price="<?php echo $fd['fees'][$j];?>" data-desc="<?php echo $fd['description'][$j];?>" class="package_fees" name="package_fees" value="<?php echo $fd['fees'][$j];?>"> $<?php echo $fd['fees'][$j];?> <?php echo $fd['description'][$j];?><br>
                                                <?php
                                               
                                                ?></td>
                                            <input type="hidden" name="SelAddonId[]" class="SelAddonId" value="<?php echo $al['id'];?>">
                                            <input type="hidden" name="SelAddonFees[]" class="SelAddonFees" value="0">
                                            <input type="hidden" name="SelAddonDesc[]" class="SelAddonDesc" value="">
                                        </tr>
                                    <?php
                                        $k++;
                                    }?>
                                </tbody>
                            </table>
                                <input type="hidden" name="reqtype" value="AddOnBook">
                           </form>
                            <br>
                            <div class="PackagePay col-sm-4 pull-right">
                                <div class="clearfix"></div>
                                <div class="CardHtml" style="display:block">
                                    <div class="pull-right">
                                        <button type="submit" form="addOnForm" class="blue-btn EnrollNow" id="AddToCart2">Book</button>
                                       <!-- <a href="javascript:void(0);" id="AddToCart2" class="blue-btn EnrollNow">Book</a><br>-->
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <br>
                            <br>
                            <div class="pull-right"><a href="product_recommended.php" class="skipandcheckout">Skip And CheckOut</a></div>
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
    $(function () {

        $(".packageBox").click(function () {
            $(".InfoBox").show();
            $(".PackagePay").hide();
            $(".InfoBox .InfoTitle").html($(this).attr('data-title'));
            $(".InfoBox .InfoDesc").html($(this).attr('data-description'));
        });

        $(".BuyNowBtn").click(function () {
            $(".PackagePay").show();
            $(".InfoBox").hide();

        });

        $(document).on('submit','#addOnForm',function (e) {
            e.preventDefault();
            if(!$("input[name=package_fees]:checked").length>0){
                $.toaster({ priority : 'warning', title : 'Error', message : "Please select a package!"});
                return false;
            }

            $('form .AddonRow').each(function () {
                $cls=$(this).attr('data-id');
                $fee=0;
                $desc="";
                $('.'+$cls+' input[name=package_fees]').each(function () {
                    if(this.checked)
                    {
                       $fee=$fee+parseFloat($(this).attr('data-price'));
                        $desc=$desc+$(this).attr('data-desc')+", ";
                    }
                });

               $(this).find('.SelAddonFees').val($fee);
                //$package=$("input[name=package_fees]:checked").attr('data-id');
               $(this).find('.SelAddonDesc').val($desc);
            });

            $elm=$("#AddToCart2");
            $elm.html("Processing");
            $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
            var callComplete=0;
            var callLength=0;
            $.ajax({
                type	: "POST",
                url	: "lib/ServerResponse.php",
                dataType : 'json',
                data	:$(this).serialize(),
                success	: function (resp) {
                    if(resp.success){
                        $dt=resp.data;
                        for($i=0;$i<$dt.length;$i++){
                            callLength=$dt.length;
                            $.ajax({
                                type	: "POST",
                                url	: "lib/my_cart.php",
                                dataType : 'json',
                                data	:{
                                    id:$dt[$i]['id'],
                                    reqtype:'add',
                                    item_type:'camps',
                                    color:'',
                                    size:'',
                                    quantity:'1',
                                    package_total:$dt[$i]['fees'],
                                    item_description:$dt[$i]['desc']
                                },
                                success	: function (resp) {
                                    if(resp.success){
                                        callComplete++;
                                        if(callComplete==callLength){
                                            $.toaster({ priority : 'success', title : 'Success', message : "Added to Cart"});
                                            setTimeout(function () {
                                                location.href="product_recommended.php";
                                            },1500);
                                        }
                                        $elm.html('Added to Bag');

                                    }else{
                                        $elm.html('Add To Bag');
                                        $.toaster({ priority : 'warning', title : 'Error', message : "Please Try Again!"});
                                    }
                                    /*$(".loading").remove();
                                     $elm.show();*/
                                }
                            });
                        }
                    }else{

                    }
                }
            });
            return false;


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
