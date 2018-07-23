<?php include_once "head.php";
include_once "classes_data.php";
?>
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
    .FilterForm .form-control{
        background-color: #f5f3e7;
    }

</style>
    <div class="kss-container">
        <div class="kss-home kss-classes">
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
                <div class="classes col-md-8 col-sm-12 col-md-offset-3">
                    <div class="col-sm-12">
                        <img src="images/classes/lg.png"><div class="clearfix"></div>
                    </div>
                    <div align="center">
                        <div class="col-sm-12">
                           <span style="color: black;"> ...we can bring any combination of classes to promote physical activity and the best healthy lifestyle!</span>

                        </div> <div class="clearfix"></div>

                           <!-- <?php
    /*                        $stm = $con->prepare("select * from categories where featured = '1' and status= '1' and parent_id='0'");
                            $stm->execute();
                            $cat_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($cat_res as $sr){
                            */?>
                            <div class="col-md-2 col-sm-3 col-xs-6">
                                <a href="">
                                    <img src="uploads/cat/<?php /*echo $sr['image']*/?>">
                                </a>
                                <div href="" class="cat-link">
                                    <?php /*echo $sr['name']*/?>
                                </div>
                            </div>
                            --><?php
    /*                        }
                            */?>
                        <div class="psubcat col-md-3 col-sm-3 col-xs-6">
                            <a href="javascript:void(0);" data-val="Sports & Movement" class="cat-link">
                                <img src="images/classes/sp.png">
                            </a>
                            <a href="javascript:void(0);" data-val="Sports & Movement" class="cat-link">
                                Sports & Movement
                            </a>
                        </div>
                        <div class="psubcat col-md-3 col-sm-3 col-xs-6">
                            <a href="javascript:void(0);" data-val="Scholastics" class="cat-link">
                                <img src="images/classes/sc.png">
                            </a>
                            <a href="javascript:void(0);" data-val="Scholastics" class="cat-link">
                                Scholastics
                            </a>
                        </div>
                        <div class="psubcat col-md-3 col-sm-3 col-xs-6">
                            <a href="javascript:void(0);"  data-val="Creative Arts" class="cat-link">
                                <img src="images/classes/ca.png">
                            </a>
                            <a href="javascript:void(0);" data-val="Creative Arts" class="cat-link">
                                Creative Arts
                            </a>
                        </div>
                        <div class="psubcat col-md-3 col-sm-3 col-xs-6">
                            <a href="javascript:void(0);" data-val="Performing Arts" class="cat-link">
                                <img src="images/classes/pa.png">
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
                            <a class="blue-btn" style="padding-top: 15px;    padding-bottom: 15px;" href="experiences.php">Experiences</a>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <a class="blue-btn" href="share_experiences.php">Share Your<br>Experiences</a>
                        </div>
                    </div>
                </div><div class="clearfix"></div>
                <div class="kss-home-r3" style="margin-top: 30px;">
                    <div class="col-sm-12"  style="font-size:16px;color:black;text-transform: lowercase;">...All of our instructors have undergone thorough background checks and have experience working with children!.</div>
                </div>
                <div class="clearfix"></div><br>
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
                <style>
                    .classes_boxes{
                        position: absolute;
                        top: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0, 0, 0, 0.35);
                        left: 0;
                    }
                    .filter_box{
                        float: right;
                        background: #fcfaee;
                        padding: 28px;
                        z-index: 1000;
                        border-radius:20px;
                        box-shadow: 0px 0px 13px gray;
                    }
                    .filter_result{
                        background: #fcfaee;
                        padding: 28px;
                        border-radius: 20px;
                        position: absolute;
                        z-index: 1100;
                        box-shadow: 0px 0px 13px gray;
                        overflow-y: auto;
                        max-height: 480px;
                        bottom: 0px;
                    }
                    .close-btn{
                        color: red;
                        position: absolute;
                        top: 4px;
                        right: 25px;
                    }
                    .classes_boxes{
                        display: none;
                    }
                    .filter_result{
                        display: none;
                    }
                    table tbody tr{
                        border-bottom: 1px solid #cbcbcb;
                    }
                    table tr td,table tr th{
                        padding: 10px;
                    }
                    .filter_box ul li{
                        color: black;
                        list-style-image: url("images/classes/mg.png");
                    }
                    .filter_box ul li a{
                        color: black;
                        list-style-image: url("images/classes/mg.png");
                    }
                </style>
                <div class="classes_boxes">
                    <div class="col-sm-5 filter_box">
                        <a href="javascript:void(0)" style="color:red;" data-val="classes_boxes,filter_result" class="close-btn">Close</a>
                        <label>Classes Type</label>
                        <select class="form-control" id="ClassesType" style="background-color: #f5f3e7;">
                            <option value="">select</option>
                        </select>

                        <h4 class="bway ClassesName" align="center"></h4>
                        <p style="color: black;" class="ClassesDescription">
                        </p>
                        <ul>
                            <li>
                                <a href="javascript:void(0);">Skills</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">What to bring what to wear</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Drop off and pick up</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Forms and healthy information</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Inclement Weather</a>
                            </li>
                        </ul>
                        <div class="col-sm-8 col-sm-offset-2">
                            <form class="FilterForm">
                            <!-- <div class="form-group">
                                    <label class="control-label col-sm-12">By State</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="state" id="f_state">
                                            <option value="">-select-</option>
                                            <?php
                                            $stm = $con->prepare("select distinct state from classes");
                                            $stm->execute();
                                            $state_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($state_res as $st){
                                                ?>
                                                <option value="<?php echo $st['state'];?>"><?php echo $st['state'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label class="control-label col-sm-12">By City</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="city" id="f_city">
                                            <option value="">-select-</option>
                                            <?php
                                            $stm = $con->prepare("select distinct city from classes");
                                            $stm->execute();
                                            $city_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($city_res as $st){
                                                ?>
                                                <option value="<?php echo $st['city'];?>"><?php echo $st['city'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12">By Zip Code</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="zip_code" id="f_zipcode">
                                            <option value="">-select-</option>
                                            <?php
                                            $stm = $con->prepare("select distinct zip_code from classes");
                                            $stm->execute();
                                            $city_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($city_res as $st){
                                                ?>
                                                <option value="<?php echo $st['zip_code'];?>"><?php echo $st['zip_code'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" id=""></label>
                                    <div class="col-sm-12">
                                        <br>
                                        <input type="hidden" name="reqtype" value="GetClasses">
                                        <a href="javascript:void(0);" class="blue-btn SearchClasses">Search</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>

                    </div>
                    <div class="col-sm-12 filter_result">
                        <a href="javascript:void(0)" style="color:red;" data-val="filter_result" class="close-btn">Close</a>
                        <table width="100%">
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Time</th>
                                <th>what to wear</th>
                                <th>what to bring</th>
                                <th>Health forms <br>and weather policy</th>
                                <th>Fees</th>

                            </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="3">No Result Found!</td></tr>
                            </tbody>
                        </table>
                        <br>
                        <div class="pull-right col-sm-6">

                            <div class="clearfix"></div><br>
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
                                        <input type="submit" class="SubmitBtn" value="Login to Enroll"><br>
                                    </form>
                                    WITHOUT AN ACCOUNT ?<br>
                                    <a href="register.php" class="join-us-btn">JOIN US</a><br>
                                </div>
                            <?php }?>
                            <div class="clearfix"></div>
                            <div class="CardHtml" style="display:<?php echo $card==true?'block':'none';?>">
                                <div class="pull-right">
                                    <a href="javascript:void(0);" id="AddToCart2" class="blue-btn EnrollNow">Pay & Enroll</a><br>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
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
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Wheather Policy</h4>
                    </div>
                    <div class="modal-body">
                        <p id="pid"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <div id="myhealth" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Health Form</h4>
                    </div>
                    <div class="modal-body">
                        <p id="hid"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php include_once "include_bottom.php"?>
<script>
    var ClickedSubCat="";
    var ClassesData=<?php echo $ClassesData; ?>;
    $(function () {

        $(".filter_box").click(function (e) {
            if (!$(e.target).hasClass('SearchClasses')) {
                $(this).css('z-index','1100');
                $(".filter_result").css('z-index','1000');
            }
        });

        $(".filter_result").click(function () {
            $(this).css('z-index','1100');
            $(".filter_box").css('z-index','1000');
        });

        $(".close-btn").click(function () {
            $close_elm=$(this).attr('data-val');
            arr=[];
            arr.push.apply(arr, $close_elm.split(",").map(String));
            $.each(arr,function (index, item) {
                $("."+item).hide();
            });
        });

        $(".cat-link").click(function () {
           ClickedSubCat=$(this).attr('data-val');
           $(".classes_boxes").show();
            $items=ClassesData[ClickedSubCat];
            $("#ClassesType").html('');
            $.each($items,function (index,val) {
                $("#ClassesType").append('<option value="'+val['title']+'">'+val['title']+'</option>');
            });
            $(".ClassesName").html($items[0]['title']);
            $(".ClassesDescription").html($items[0]['description']);
        });

        $("#ClassesType").change(function () {
            $val=$(this).val();
            $items=ClassesData[ClickedSubCat];
            $.each($items,function (index,val) {
                if(val['title']==$val){
                    $(".ClassesName").html(val['title']);
                    $(".ClassesDescription").html(val['description']);
                }
            });
        });

        $(document).on('click','#AddToCart2',function () {
            if(!$("input[name=sel_class]:checked").length>0){
                $.toaster({ priority : 'warning', title : 'Error', message : "Please select a package!"});
                return false;
            }
            $fees=$("input[name=sel_class]:checked").attr('data-price');
            $package=$("input[name=sel_class]:checked").attr('data-id');
            $data_desc=$("input[name=sel_class]:checked").attr('data-desc');

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
                    item_type:'classes',
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
                           location.href="product_recommended.php";
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

            if(!$("input[name=sel_class]:checked").length>0){
                $.toaster({ priority : 'warning', title : 'Error', message : "Please select a package!"});
                return false;
            }
            $fees=$("input[name=sel_class]:checked").attr('data-price');
            $package=$("input[name=sel_class]:checked").attr('data-id');

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
                    package_type:'classes',
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
        $(".SearchClasses").click(function () {
            $elm=$(this);
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
            $.ajax({
                type	: "POST",
                url	: "lib/ServerResponse.php",
                dataType : 'json',
                data : {
                   // state:$("#f_state").val(),
                    city:$("#f_city").val(),
                    zip:$("#f_zipcode").val(),
                    reqtype:'FilterClasses',
                    reqcat:'classes',
                    reqsubcat:ClickedSubCat,
                    reqclassestype:$("#ClassesType").val()
                },
                success	: function (resp) {
                    if(resp.success) {

                        if (resp.data.length > 0) {
                            $(".filter_result").show();
                            $(".filter_result").css('z-index', '1100');
                            $(".filter_box").css('z-index', '1000');
                            $(".filter_result table tbody").html('');
                            for ($i = 0; $i < resp.data.length; $i++) {
                                $detail=  resp.data[$i].form_data;
                                $detail=JSON.parse($detail);
                                $str1="";
                                $str2="";
                                $data_id=resp.data[$i]['id'];
                                $add1=resp.data[$i]['address1'];
                                $add2=resp.data[$i]['address2'];
                                $city=resp.data[$i]['city'];
                                $state=resp.data[$i]['state'];
                                $what_wear=resp.data[$i]['what_wear'];
                                $what_bring=resp.data[$i]['what_bring'];
                                $wheather_policy=resp.data[$i]['wheather_policy'];
                                $Health_form=resp.data[$i]['Health_form'];
                                $zip=resp.data[$i]['zip_code'];
                                $type=resp.data[$i]['type'];
                                $category=resp.data[$i]['type'];
                                $subcategory=resp.data[$i]['category'];

                                for($j=0;$j<$detail['age_from'].length;$j++){
                                    $str1+=$detail['time_from'][$j]+ " - " +$detail['time_to'][$j] +" "+$detail['age_from'][$j]+"yrs-"+$detail['age_to'][$j]+"yrs <br>";
                                    $fees=$detail['fees'][$j];
                                    $time_from=$detail['time_from'][$j];
                                    $time_to=$detail['time_to'][$j];
                                    $str2+='<input class="package_fee" value="'+$fees+'" type="radio" data-id="'+$data_id+'" data-cat="'+$category+'" data-desc="'+$time_from+'-'+$time_to+'" data-sub="'+$subcategory+'" data-price="'+$detail["fees"][$j]+'" name="sel_class">  '+$time_from+' class: $'+$fees+' <br>';
                                }

                                $(".filter_result table tbody").append('<tr>'+
                                    '<td>'+
                                    $add1 +'<br> '+$add2+'<br> '+$city+' <br>'+ $zip+
                                '</td>'+
                                '<td>'+
                                    $str1+
                                '(divided by ages)<br>'+
                                '</td>'+
                                    '<td>'+
                                    $what_wear+
                                    '</td>'+
                                    '<td>'+
                                    $what_bring+
                                    '</td>'+
                                    '<td>'+
                                    '<a href="#" onclick=showHealth($Health_form);>Health form</a><br>'+
                                    '<a href="#" onclick=show($wheather_policy); id="wheather_p">Wheather Policy</a>'+


                                '</td>'+
                                '<td>'+
                                    $str2+
                                '</td>'+

                                '</tr>')
                            }
                        }else{
                            $.toaster({ priority : 'warning', title : 'Error', message : "No package Found!"});

                        }
                    }else{
                        //$.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
                       // console.log(resp.msg);
                    }
                    $(".loading").remove();
                    $elm.show();
                }
            });


        });

    });
</script>

<script>
function show(data)
{
    $("#pid").html(data);
  $('#myModal').modal('show');
}
hid
function showHealth(data)
{
    $("#hid").html(data);
    $('#myhealth').modal('show');
}
</script>
