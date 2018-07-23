<?php include_once "head.php";
if(isset($_GET['type'])){
    $type=$_GET['type'];
    if($type=='grade'){
        $cat="Tutoring by Grade";

    }elseif ($type=='school'){
        $cat="Tutoring by School";
    }elseif ($type=='subject'){
        $cat="Tutoring by Subject";
    }else{
        echo "Invalid Request";die;
    }

    $stm = $con->prepare("select distinct subject from packages where type='Tutoring' and category='$cat'");
    $stm->execute();
    $SubjectList = $stm->fetchAll(PDO::FETCH_ASSOC);

     $stm = $con->prepare("select distinct grade from packages where type='Tutoring' and category='$cat'");
    $stm->execute();
    $GradeList = $stm->fetchAll(PDO::FETCH_ASSOC);

    $stm1 = $con->prepare("select distinct school from packages where type='Tutoring' and category='$cat'");
    $stm1->execute();
    $SchoolList = $stm1->fetchAll(PDO::FETCH_ASSOC);

}
?>
    <style>
        .kss-container .kss-tutoring{
            text-transform: uppercase;
        }
        .back-btn {
            -moz-box-shadow:inset 1px -27px 19px 0px #36a7c6;
            -webkit-box-shadow:inset 1px -27px 19px 0px #36a7c6;
            box-shadow:inset 1px -27px 19px 0px #36a7c6;
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #99fffa), color-stop(1, #2d869c));
            background:-moz-linear-gradient(top, #99fffa 5%, #2d869c 100%);
            background:-webkit-linear-gradient(top, #99fffa 5%, #2d869c 100%);
            background:-o-linear-gradient(top, #99fffa 5%, #2d869c 100%);
            background:-ms-linear-gradient(top, #99fffa 5%, #2d869c 100%);
            background:linear-gradient(to bottom, #99fffa 5%, #2d869c 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#99fffa', endColorstr='#2d869c',GradientType=0);
            background-color:#99fffa;
            -moz-border-radius:6px;
            -webkit-border-radius:6px;
            border-radius:6px;
            display:inline-block;
            cursor:pointer;
            color:#000000;
            font-size:13px;
            padding:7px 30px;
            text-decoration:none;
            text-shadow:0px 1px 0px #0586ff;
        }
        .back-btn:hover {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2d869c), color-stop(1, #99fffa));
            background:-moz-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-webkit-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-o-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-ms-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:linear-gradient(to bottom, #2d869c 5%, #99fffa 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2d869c', endColorstr='#99fffa',GradientType=0);
            background-color:#2d869c;
        }
        .back-btn:active {
            position:relative;
            top:1px;
        }

        .box1{
            color: black;
            background-color: rgba(255, 255, 255, 0.57);
            border-radius: 12px;
            text-align: center;
            /* margin: -47px 0px 0% 38%; */
            /* padding: 7% 0px 7% 0px; */
            padding: 42px;
        }
        .box2{
            background-color: white;
            color: black;
            background-color: rgba(255, 255, 255, 0.57);
            border-radius: 12px;
            text-align: center;
            /* margin: -12% 1px 0px 35%; */
            /* padding: 3% 3% 5% 4%; */
            font-size: 20px;
            padding: 28px;
        }
        .box3{
            background-color: yellow;
            font-size: large;
            border-radius: 12px;
            background-color: rgba(224, 255, 4, 0.57);
            padding:4% 2% 4% 2%;
            text-align: center;
            margin: -30px 5% 0px 18%;
        }
        .box4{
            background-color: #00a3d9;
            font-size: large;
            border-radius: 12px;
            background-color: rgba(26, 152, 255, 0.57);
            padding: 2% 2% 2% 2%;
            text-align: center;
            margin: -17px 0% 5% 52%;
        }
        .box5{
            background-color: white;
            color: black;
            background-color: rgba(255, 255, 255, 0.57);
            border-radius: 12px;
            padding: 2% 1% 2% 1%;
            margin: -56px 0% 0% -4%;
            text-align: center;
            font-size: large;
        }

        .white-btn {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ffffff), color-stop(1, #f6f6f6));
            background:-moz-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
            background:-webkit-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
            background:-o-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
            background:-ms-linear-gradient(top, #ffffff 5%, #f6f6f6 100%);
            background: linear-gradient(to bottom, #ffffff 5%, #d8d8d8 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#f6f6f6',GradientType=0);
            background-color:#ffffff;
            -moz-border-radius:6px;
            -webkit-border-radius:6px;
            border-radius:6px;
            cursor:pointer;
            color:#666666;
            padding: 12px 20px;
            margin-right: 10px;
            font-size: 15px;
            text-decoration:none;
            text-align: center;
        }
        .white-btn:hover {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2d869c), color-stop(1, #99fffa));
            background:-moz-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-webkit-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-o-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:-ms-linear-gradient(top, #2d869c 5%, #99fffa 100%);
            background:linear-gradient(to bottom, #2d869c 5%, #99fffa 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2d869c', endColorstr='#99fffa',GradientType=0);
            background-color:#2d869c;
        }

    </style>
    <div class="kss-container">
        <div class="kss-home kss-tutoring">
            <div class="kss-col1 col-md-10">
                <div class="kss-shaded"></div>
                <div class="kss-header">
                    <div class="col-md-3 col-sm-3 col-xs-6">
                        <a href="index.php"> <img src="images/logo.png" alt="Kss" title="Logo"></a>
                    </div>
                    <div class="pull-right">
                        <a class="kss-home-btn" style="position: relative;" href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a>
                        <br>
                        <a href="tutorings.php" class="back-btn BackClick">Back</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="kss-content row">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="box1 col-sm-6 col-xs-9 pull-right"><span></span></div>
                        <div class="clearfix"></div>
                        <div class="box2 col-sm-6 col-xs-9 pull-right" style="    margin-top: -84px;    padding-left: 55px;">
                            <?php echo $cat;?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-sm-8 col-xs-10" style="    background: rgba(72, 136, 72, 0.37);    float: right;    padding: 25px;    border-radius: 12px;    margin-top: -30px;"></div>
                        <div class="clearfix"></div>
                        <div class="" style="background: rgba(23, 111, 134, 0.49);    float: right;    padding: 25px;    border-radius: 12px;    margin-top: -30px;    width: 100%;">
                        </div>
                        <div class="" style="background: rgba(195, 195, 0, 0.63);    float: right;    padding: 31px;    border-radius: 12px;    margin-top: -30px;    width: 100%;">
                        </div>
                        <style>
                            .book-tutoring select{
                                padding: 6px 8px;
                                border: 0;
                                background: rgba(246,246,246,0.78);
                                border-radius: 7px;
                                width: 100%;
                            }
                            .TutoringResult{
                                background: rgba(252, 250, 238, 0.75);
                                padding: 28px;
                                border-radius: 20px;
                                box-shadow: 0px 0px 13px grey;
                                overflow-y: auto;
                                margin-top: 20px;
                                max-height: 400px;
                                display: none;
                            }
                        </style>
                        <div class=" col-sm-12 col-xs-12 book-tutoring" style="    margin-top: -55px;">
                            <br>
                            <div class="col-md-5" style="    margin-top: 22px;    font-weight: 700; margin-bottom: 20px;">
                                <div style="background: rgba(255, 255, 255, 0.65);    padding: 10px;    border-radius: 10px;    text-align: center;    color: black;">
                                    LOCATIONS - DATE & TIME:<br> YOU WILL FOUND THE OPTIONS AVAILABLE DEPENDING ON THE GRADE AND SUBJETC YOU SELECT.
                                    <br>YOU CAN CHOOSE THE BEST OPTION FOR YOUR CHILD DURING THE ENROLLMENT PROCESS
                                </div>
                            </div>
                            <div class="col-md-offset-2 col-md-5 form-horizontal">
                                <?php
                                if($type=="grade"){
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Grade:</label>
                                        <div class="col-sm-8">
                                            <select class="SelGrade">
                                                <option value="">select</option>
                                                <?php foreach ($GradeList as $pl){
                                                    ?>
                                                    <option value="<?php echo $pl['grade']?>"><?php echo $pl['grade']?></option>
                                                    <?php
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                <?php
                                }elseif($type=='subject'){
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">Subject:</label>
                                        <div class="col-sm-8">
                                            <select class="SelSubject">
                                                <option value="">select</option>
                                                <?php foreach ($SubjectList as $sl){
                                                    ?>
                                                    <option value="<?php echo $sl['subject']?>"><?php echo $sl['subject']?></option>
                                                    <?php
                                                }?>
                                            </select>
                                        </div>
                                    </div>

                                <?php
                                }elseif($type=='school'){
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4">School:</label>
                                        <div class="col-sm-8">
                                            <select class="SelSchool">
                                                <option value="">select</option>
                                                <?php foreach ($SchoolList as $sl){
                                                    ?>
                                                    <option value="<?php echo $sl['school']?>"><?php echo $sl['school']?></option>
                                                    <?php
                                                }?>
                                            </select>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label class="control-label col-sm-4">&nbsp;</label>
                                    <div class="col-sm-8">
                                        <input type="button" class="blue-btn GetTutoring" name=""  value="Search">
                                    </div>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                            <div class="TutoringResult">
                                <table width="100%" class="table ResultTable">
                                    <thead>
                                        <tr>
                                            <th>Location</th>
                                            <th>Date & Time</th>
                                            <th>Description</th>
                                            <th>Fee</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <br>

                                <div class="PackagePay col-sm-4 pull-right">
                                    <?php
                                    $card=false;
                                    if(isset($_SESSION['isLoggedIn']) && !empty($_SESSION['isLoggedIn'])){
                                        $card=true;
                                        ?>
                                        <?php
                                    } else { ?>
                                        <div class="col-md-12 col-sm-12  kss-user">
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
                                        <div class="pull-right">
                                            <a href="javascript:void(0);" id="AddToCart2" class="blue-btn EnrollNow">Book</a><br>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br><br>

                    <div class="col-sm-12" style="text-transform:none;text-align: center;margin-top: 5px">If you are interested in learning more about individual or  group tutoring, please email <br><a
                            href="mailto:info@kssprograms.com">info@kssprograms.com</a></div>
                </div>
                <div class="kss-home-r3" style="margin-top:20px;">
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
       $(".GetTutoring").click(function(){
           $(".TutoringResult").hide();
           $('.ResultTable tbody').html('');
           $.ajax({
               type	: "POST",
               url	: "lib/ServerResponse.php",
               dataType : 'json',
               data : {
                   grade: $(".SelGrade").val(),
                   subject: $(".SelSubject").val(),
                   school: $(".SelSchool").val(),
                   reqtype:'GetTutoring'
               },
               success	: function (resp) {
                   if(resp.success) {
                       if(resp.data && resp.data.length>0){
                           $(".TutoringResult").show();
                           for($i=0;$i<resp.data.length;$i++){
                               $data=resp.data[$i];
                               console.log($data);
                               $fee=JSON.parse($data['fee_detail']);
                               $fee_op2="";
                               $j=0;
                               $package_id=$data['id'];
                               $.each($fee['fees'],function (index,val) {
                                   $fees=$fee['fees'][$j];
                                   $desc=$fee['description'][$j];
                                   $fee_op2+='<input type="radio" data-id="'+$package_id+'" data-price="'+$fees+'" data-desc="'+$desc+'" class="package_fees" name="package_fees" value="'+$fees+'"> $'+$fees+' '+$desc+'<br>';
                                   $j++;
                               });

                               $('.ResultTable tbody').append('<tr>'+
                               '<td>'+$data['location']+'</td>'+
                               '<td>'+$data['date_from']+' '+$data['time']+'</td>'+
                               '<td>'+$data['description']+'</td>'+
                               '<td>'+$fee_op2+'</td>'+
                               '</tr>');
                           }
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
                    item_type:'tutoring',
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
                    package_type:'tutoring',
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
