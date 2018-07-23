<?php include_once "head.php";
if(isset($_SESSION['isLoggedIn'])){
}else{
    ?>
    <script>
        location.href="store-register.php";
    </script>
    <?php
}
include('lib/paypal/paypalConfig.php');

$_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(32));

if(SANDBOX_FLAG) {
    $environment = SANDBOX_ENV;
} else {
    $environment = LIVE_ENV;
}

?>
<style>
    .input-group .icon-addon .form-control {
        border-radius: 0;
    }
    .freeShipping{
        display: none;
    }

    .icon-addon {
        position: relative;
        color: #555;
        display: block;
    }

    .icon-addon:after,
    .icon-addon:before {
        display: table;
        content: " ";
    }

    .icon-addon:after {
        clear: both;
    }

    .icon-addon.addon-md .glyphicon,
    .icon-addon .glyphicon,
    .icon-addon.addon-md .fa,
    .icon-addon .fa {
        position: absolute;
        z-index: 2;
        right: 10px;
        font-size: 16px;
        width: 20px;
        margin-right: -2.5px;
        text-align: center;
        padding: 10px 0;
        top: 0px
    }
    .icon-addon.addon-md .form-control,
    .icon-addon .form-control {
        padding-right: 30px;
        float: right;
        font-weight: normal;
    }

    .icon-addon .form-control:focus + .glyphicon,
    .icon-addon:hover .glyphicon,
    .icon-addon .form-control:focus + .fa,
    .icon-addon:hover .fa {
        color: #2580db;
    }
</style>
<style>
    .btn-yellow{
        background: yellow;
        background-color: yellow!important;
    }

    .stepwizard-step p {
        margin-top: 10px;
        font-size: 16px;
        font-weight: 700;
        color: #353333;
    }

    .stepwizard-row {
        background: rgba(194, 194, 194, 0.32);
        display: table-row;
        border-radius: 10px;
    }

    .stepwizard {
        display: table;
        width: 73%;
        position: relative;
        margin-top: -40px;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .wired:after{
        bottom: 15px;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .wired_last:after{

        bottom: 15px;
        position: absolute;
        content: " ";
        width:65%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;
    }
    .btn.disabled, .btn[disabled], fieldset[disabled] .btn{
        opacity: 1;
    }


    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .bag-items td,.bag-items th{
        padding: 10px;
        font-size: 16px;
    }
    .bag-items th{
        color: #3e3d3f;
        font-weight: 700;
    }
    .bag-items table{
        background: rgba(137, 137, 137, 0.51);
        margin-bottom: 20px;
    }
    .bag-items table td,a{
        color: white;
    }
    .bag-items table tr{
        border-bottom: 1px solid #bbbbbb;
    }
    .bag-items table tr:last-child{
        border-bottom: 0px;
    }

    .p-method-tbl table tr{
        border-bottom: 1px solid #bbbbbb;
    }
    .p-method-tbl table tr:last-child{
        border-bottom: 0px;
    }

    .close-btn{
        color: red;
        position: absolute;
        top: 4px;
        right: 25px;
    }


</style>
<div class="kss-container">
    <div class="kss-store">
        <div class="kss-col1 col-md-10">
            <div class="kss-shaded">
            </div>
            <div class="kss-header">
                <?php include_once "store_header.php"; ?>
            </div>
            <div class="clearfix"></div>
            <div class="kss-checkout-step1">
                <div class="stepwizard pull-right">
                    <div class="stepwizard-row setup-panel">
                        <div class="stepwizard-step wired">
                            <p>Shopping Bag</p>
                            <a href="#step-1" type="button" class="btn btn-default btn-yellow btn-circle"></a>
                        </div>
                        <div class="stepwizard-step wired">
                            <p>Billing & Shipping</p>
                            <a href="#step-2" type="button" class="btn btn-default btn-circle" ></a>
                        </div>
                        <div class="stepwizard-step wired_last">
                            <p>Shipping Method</p>
                            <a href="#step-3" type="button" class="btn btn-default btn-circle" ></a>
                        </div>
                        <div class="stepwizard-step">
                            <p>Payment</p>
                            <a href="#step-4" type="button" class="btn btn-default btn-circle" ></a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <form action="lib/paypal/startPayment.php" method="POST" id="CheckoutForm">
                    <br>
                    <div class="row setup-content" id="step-1" style="display: block">
                        <div class="col-xs-12">
                            <div class="bag-items" style="overflow: auto">

                            </div>
                            <div class="col-md-5 total-box pull-right">
                                <br><br>
                                <div class="sub-total ">SUB TOTAL: $<span class="BagSubTotal"></span></div>
                                <a href="store.php" class="c-shopping" style="position: relative;
    z-index: 1000;">Continue Shopping</a>
                                <a href="#" class="p-checkout nextBtn" style="position: relative;
    z-index: 1000;">Procced to checkout</a>
                                <br><br>
                            </div>
                            <div class="col-sm-12">
                                We Accept:<span class="we-accept"><i class="fa fa-cc-visa" aria-hidden="true"></i><i class="fa fa-cc-mastercard" aria-hidden="true"></i><i class="fa fa-cc-paypal" aria-hidden="true"></i></span>
                                <br>
                                <b>Shop with Confidence</b><br>
                                <span>Your order is safe and secure</span><br>
                                <span>Your Satification is 100% guaranteed</span><br><br>

                                <span>
                                        Orders are placed is safe and secure<br>
                                        <a href="#" data-target="#myModal" data-toggle="modal">See Privacy Policy</a><br>
                                        <a href="#" data-target="#myModalshipping" data-toggle="modal">Shipping and delivery Policy</a>
                                        </span>



                            </div>
                        </div>
                    </div>
                    <style>
                        .PolicyBox #table {
                            table:80%;
                            border-collapse: collapse;

                        }
                        .PolicyBox td, th {
                            border: 1px solid #dddddd;
                            text-align: left;
                            padding: 8px;
                        }
                        .PolicyBox tr:nth-child(odd) {
                            background-color: #dddddd;
                        }
                        .PolicyBox{
                            border-radius: 10px;
                            box-shadow: 5px 7px 20px 12px grey;
                            background-color: rgba(0, 0, 0, 1);
                            /* margin: 0px 0px 0px 22%; */
                            background-color: rgb(255, 255, 255);
                            /* padding: 2% 2% 2% 2%; */
                            font-size: 12px;
                            /* position: absolute; */
                            padding: 20px;
                            z-index: 1000;
                            margin: 0 auto;
                        }
                        .PolicyBoxContainer{
                            position: relative;
                            margin-top: -400px;
                            display: none;
                        }
                    </style>
                    <div class="row setup-content" id="step-2">
                        <div class="BillingAddress">
                            <div class="col-xs-12 shipping-text">
                                <div class="col-sm-6 col-sm-offset-2">Billing Information</div>
                            </div>
                            <div class="col-xs-12">
                                <div class="col-sm-4 col-sm-offset-2 info-box">
                                    <br>
                                    Orders are placed is safe and secure
                                    <a href="#" data-target="#myModal" data-toggle="modal">See Privacy Policy</a><br>
                                    <a href="javascript:void(0);" class="ShippingPolicy">Shipping and delivery Policy</a>
                                    <br><br>
                                    <br>
                                </div>
                                <div class="col-sm-6 form-horizontal a-form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address Name *</label>
                                        <div class="col-sm-9">
                                            <!-- <select class="kss-input" placeholder="Choose address name">
                                                 <option>Address name 1</option>
                                                 <option>Address name 2</option>
                                             </select>-->
                                            <input class="kss-input" name="b_recipient_name" placeholder="Recipient Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Country</label>
                                        <div class="col-sm-9">
                                            <select class="kss-input" name="b_country_code" placeholder="Country">
                                                <option value="US">USA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="b_fname" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="b_lname" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address1 *</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="b_line1" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address2</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="b_line2" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">State *</label>
                                        <div class="col-sm-9">
                                            <select class="kss-input" name="b_state" placeholder="State">
                                                <?php
                                                $stm = $con->prepare("select * from states");
                                                $stm->execute();
                                                $state_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($state_res as $st){
                                                    ?>
                                                    <option value="<?php echo $st['state'];?>"><?php echo $st['state'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">City *</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="b_city" class="kss-input" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Zip Code *</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="b_postal_code" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="b_phone" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group text-center"><br>
                                        <a href="javascript:void(0);" class="checkout ShowShipping">Next</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="ShippingAddress" style="display: none;">
                            <div class="col-xs-12 shipping-text">
                                <div class="col-sm-6 col-sm-offset-2">Shipping Information</div>
                            </div>
                            <div class="col-xs-12">
                                <div class="col-sm-4 col-sm-offset-2 info-box">
                                    <br>
                                    <a href="#" data-target="#myModal" data-toggle="modal">Privacy and Policy</a><br>
                                    <a href="javascript:void(0);" class="ShippingPolicy">Shipping and delivery Policy</a>
                                    <br><br>
                                    <b>Same as Billing Addredss</b> <input type="radio" class="address_type" name="address_type" value="same"><br>
                                    <b>Another Address</b> <input type="radio" class="address_type" checked name="address_type" value="diff">
                                    <br>
                                    <br>
                                </div>
                                <div class="col-sm-6 form-horizontal a-form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address Name *</label>
                                        <div class="col-sm-9">
                                            <!-- <select class="kss-input" placeholder="Choose address name">
                                                 <option>Address name 1</option>
                                                 <option>Address name 2</option>
                                             </select>-->
                                            <input class="kss-input" name="s_recipient_name" placeholder="Recipient name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Country</label>
                                        <div class="col-sm-9">
                                            <select class="kss-input" name="s_country_code" placeholder="Country">
                                                <option value="US">USA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="s_fname" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="s_lname" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address1 *</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="s_line1" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Address2</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="s_line2" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">State</label>
                                        <div class="col-sm-9">
                                            <select class="kss-input" name="s_state" placeholder="State">
                                                <?php
                                                $stm = $con->prepare("select * from states");
                                                $stm->execute();
                                                $state_res = $stm->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($state_res as $st){
                                                    ?>
                                                    <option value="<?php echo $st['state'];?>"><?php echo $st['state'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">City *</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="s_city" class="kss-input" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Zip Code *</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="s_postal_code" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="s_phone" class="kss-input">
                                        </div>
                                    </div>
                                    <div class="form-group text-center"><br>
                                        <a href="javascript:void(0);" class="checkout ShowBilling">Back</a>  <a href="javascript:void(0);" class="checkout nextBtn">Procced to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8 pull-right PolicyBoxContainer">
                            <div class="PolicyBox">
                                <a href="javascript:void(0)" style="color:red;" data-val="classes_boxes,filter_result" class="close-btn">Close</a>
                                <div>
                                    <p>The chart below lists the estimated delivery timelines for KSS orders.
                                        Once you place your order, we will provide more detailed shipping and delivery information.</p>
                                </div>
                                <div id="table">
                                    <table>
                                        <tr>
                                            <th>Method & Cost</th>
                                            <th>Shipping</th>
                                        </tr>
                                        <tr>
                                            <td>Standard<br> $8</td>
                                            <td> 2 - 5 Business Days</td>
                                        </tr>
                                        <tr>
                                            <td>Two day<br> $15</td>
                                            <td> 2 - 3 Business Days </td>
                                        </tr>
                                        <tr>
                                            <td>Next day<br> $25</td>
                                            <td> 1 -2 Business Day</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">KSS Process order will send you an order confirmation email after you place your order. This email will also include the estimated delivery date.</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="list">
                                    <li>After you fill in your shipping information in Checkout, you can view the estimated delivery date for the available shipping options and make a selection.</li>
                                    <li>We will send you an order confirmation email after you place your order. This email will also include the estimated delivery date.</li>
                                    <li>Once your order ships, we will send you a shipping confirmation email with the tracking number and a link to the carrier's website. Click on the link in that email to go to the UPS, FedEx or USPS website and track your shipment.</li>
                                    <li>You may receive your order sooner or later depending on unforseen order processing factors, weather delays, and in the case of standard shipping.</li>
                                    <li>You can <a href="" style="color: blue">CHECK THE STATUS OF YOUR ORDER AND TRACK YOUR SHIPMENT</a> anytime after it's placed.</li>
                                </div>
                                <div>
                                    <p>CAN I SHIP TO AN P.O. BOX?
                                        Yes, you can ship most KSS orders to a P.O. Box address. Simply select 'P.O. Box' in Checkout or just start typing your P.O. Box address in the shipping address field.
                                        P.O. Box orders ship via USPS Standard and arrive within 2-7 business days. Express shipping options are not available for P.O. Box addresses</p>
                                </div>
                                <div>
                                    <p>CAN I CHANGE THE SHIPPING ADDRESS AFTER I PLACE THE ORDER?
                                        Changes to an order are possible for a brief period of time after the order is placed..</p>
                                </div>
                                <br>
                                <h4>Refund Policy</h4>

                                Refunds must be requested through the KSS Office at 202-679-1389. <br>

                                Full refunds for KSS programs will be made automatically when canceled by KSS due to insufficient enrollment or other unforeseen reasons, or upon request when schedule or location changes made by KSS prohibit or limit your attendance. <br><br>

                                In order to receive a refund, customers must cancel within 48 hours after the first class. All refunds due to customer cancelation are subject to a $25 service charge. No refunds or credits will be given after this deadline, or if a customer is unable to attend a one-session program, class, or workshop. <br><br>

                                All refunds for camp(s) are subject to a $25 service charge per participant per camp session. All summer camp registration changes/cancelations are processed by the KSS Office and not at the camp site. Fees are based on registration for the camp session, not daily attendance. It is the responsibility of the parent/guardian to cancel if the camper will not attend. The deadline to make any changes to camp registrations, including cancelation, is 5 businessdays prior to the start date of camp. No refunds will be issued for cancelations after this period and the start of camp. <br><br>

                                Refunds for medical reasons must be accompanied by a physician's note and shall be considered on a case by case basis. <br><br>

                                Refunds may be retained as household credits and used towards registration in future KSS programs. If not retained as a household credit, credit card charges will be refunded directly to the credit card, if possible. All other refunds will be made by check. Refunds will be processed within 30 -60 days of the request. <br>




                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-3">
                        <div class="col-xs-12">
                            <div class="col-xs-12 shipping-text">
                                <div class="col-sm-6 col-sm-offset-1" style="font-size: 14px;">Remember, FREE standard shipping<br>
                                    with purchase over $50 or more!
                                </div>
                                <div class="col-sm-4 col-sm-offset-1" style="font-size: 14px;">

                                    <a href="#" data-target="#myModal" data-toggle="modal">See Privacy Policy</a><br>
                                    <a href="#" data-target="#myModalshipping" data-toggle="modal" style='color:#514f4f;'>Shipping and delivery Policy</a>


                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br/>
                            <div class="col-sm-11 col-sm-offset-1 p-method-tbl" style="overflow: auto">
                                <table class="" width="100%">
                                    <tr style="    border-bottom: 1px solid;    border-color: #cccccc;">
                                        <td>Shipping Method</td>
                                        <td>Shipping Time</td>
                                        <td>Cost</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr class="freeShipping">
                                        <td>Free Shipping</td>
                                        <td>Free Shipping
                                        </td>
                                        <td>$0.00</td>
                                        <td><input type="radio" class="ShippingMethod" name="shipping_method1" data-val="Free Shipping" data-val2="Free Shipping" value="0"></td>
                                    </tr>
                                    <tr class="paidShipping">
                                        <td>Next day saver</td>
                                        <td>Next date Shipping
                                            <br>
                                            (1 bussiness day if placed before 11 am PST. SEE DETAILS)
                                        </td>
                                        <td>$22.95</td>
                                        <td><input type="radio" class="ShippingMethod" name="shipping_method1" data-val="Next date Shipping" data-val2="Next day saver" value="22.95"></td>
                                    </tr>
                                    <tr class="paidShipping">
                                        <td>Express</td>
                                        <td>Express Shipping
                                            <br>
                                            (2-3 Business Days)
                                        </td>
                                        <td>$18.95</td>
                                        <td><input type="radio" class="ShippingMethod" name="shipping_method1" data-val="Express Shipping" data-val2="Express" value="18.95"></td>
                                    </tr>
                                    <tr class="paidShipping">
                                        <td>Standarad</td>
                                        <td>Standard Ground Shipping
                                            <br>(4-9 Business Days)</td>
                                        <td>$6.95</td>
                                        <td><input type="radio" class="ShippingMethod" checked name="shipping_method1" data-val="Standard Ground Shipping" data-val2="Standard" value="6.95"></td>
                                    </tr>
                                </table>
                                <div class="form-group text-right"><br>
                                    <a href="javascript:void(0);" class="checkout nextBtn">Procced to checkout</a>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="row setup-content" id="step-4">
                        <div class="col-xs-12">
                            <div class="col-xs-12 payment-text">
                                <div class="col-sm-11 col-sm-offset-1" style="font-size: 14px;">
                                    <b>REVIEW YOUR ORDER.</b> BY PLACING YOUR ORDER, YOUR AGREE TO KSS's<br><b><a href="#" data-target="#myModal" data-toggle="modal">PRIVACY POLICY</a></b>and <b>TERMS OF USE.</b>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br/>
                            <div class="col-sm-11 col-sm-offset-1 last-step" style="overflow: auto">

                                <div class="col-sm-6 col-xs-12 form-horizontal">
                                    Payment Information<br>
                                    <img src="images/pay-method.png" style="margin: 10px 0px;" title="payment method">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">CARD #</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="kss-input" minlength="16" maxlength="16" name="cardnumber" placeholder="Card Number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">CVC #</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="kss-input" name="cvc" placeholder="Card CVC">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">EXP DATE</label>
                                        <div class="col-sm-8">
                                            <select class="kss-input" name="exp_month" style="width: 48%">
                                                <?php for($i=1;$i<13;$i++){
                                                    ?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php
                                                }?>
                                            </select>
                                            <select class="kss-input" name="exp_year" style="width: 48%">
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3">CARD NAME</label>
                                        <div class="col-sm-8">
                                            <input class="kss-input" name="card_name" placeholder="Name on card">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-sm-8">
                                            <a href="javascript:void(0);" id="PayWithCard" class="place-order">Pay With Card</a>
                                        </div>

                                    </div>
                                    <br><br>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="col-sm-6">
                                        <b> BILLING ADDRESS</b><br>
                                        <span class="FinalBillingText"></span>
                                    </div>
                                    <div class="col-sm-6">
                                        <b> SHIPPING ADDRESS</b><br>
                                        <span class="FinalShippingText"></span>
                                    </div>
                                    <div class="col-xs-12 final-balance"><br>
                                        <input type="hidden" name="csrf" value="<?php echo($_SESSION['csrf']);?>"  readonly>
                                        <input type="hidden" name="markFlow" value="true">
                                        <input type="hidden" name="recipient_name">
                                        <input type="hidden" name="line1">
                                        <input type="hidden" name="line2">
                                        <input type="hidden" name="postal_code">
                                        <input type="hidden" name="city">
                                        <input type="hidden" name="state">
                                        <input type="hidden" name="country_code">
                                        <input type="hidden" name="shipping_method">
                                        <input type="hidden" name="total">
                                        <b>SHIPPING INFORMATION.</b><br>
                                        <span class="FinalShippingMethod"></span>
                                        <br>
                                        <b>
                                            <span>SUB - TOTAL:</span> $<label class="FinalSubTotal"></label><br>
                                            <span>SHIPPING & HANDING:</span> $<label class="FinalShippingTotal"></label><br>
                                            <span>TAX:</span> $<label class="FinalTaxTotal"></label><br>
                                            <span>TOTAL:</span> $<label class="FinalTotal"></label><br>
                                            <span>BALANCE DUE:</span> $<label class="FinalBalanceDue"></label><br></b>
                                        <br>
                                        <!-- <button id="t1" id="t1" class="place-order" >Pay With Paypal</button>-->
                                    </div>
                                    <div class="clearfix"></div><br>
                                    <br>
                                </div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="clearfix"></div>
            <div class="kss-footer">
                <?php include_once "store_footer.php";?>
            </div>
        </div>
        <div class="kss-col2 col-md-2 col-sm-12 col-xs-12 ">
            <?php include_once "adv_section.php";?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div id="myModalshipping" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Shipping and Delivery Policy</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <div>
                            <p>The chart below lists the estimated delivery timelines for KSS orders.
                                Once you place your order, we will provide more detailed shipping and delivery information.</p>
                        </div>
                        <div id="table">
                            <table>
                                <tr>
                                    <th>Method & Cost</th>
                                    <th>Shipping</th>
                                </tr>
                                <tr>
                                    <td>Standard<br> $8</td>
                                    <td> 2 - 5 Business Days</td>
                                </tr>
                                <tr>
                                    <td>Two day<br> $15</td>
                                    <td> 2 - 3 Business Days </td>
                                </tr>
                                <tr>
                                    <td>Next day<br> $25</td>
                                    <td> 1 -2 Business Day</td>
                                </tr>
                                <tr>
                                    <td colspan="2">KSS Process order will send you an order confirmation email after you place your order. This email will also include the estimated delivery date.</td>
                                </tr>
                            </table>
                        </div>
                        <div class="list">
                            <li>After you fill in your shipping information in Checkout, you can view the estimated delivery date for the available shipping options and make a selection.</li>
                            <li>We will send you an order confirmation email after you place your order. This email will also include the estimated delivery date.</li>
                            <li>Once your order ships, we will send you a shipping confirmation email with the tracking number and a link to the carrier's website. Click on the link in that email to go to the UPS, FedEx or USPS website and track your shipment.</li>
                            <li>You may receive your order sooner or later depending on unforseen order processing factors, weather delays, and in the case of standard shipping.</li>
                            <li>You can <a href="" style="color: blue">CHECK THE STATUS OF YOUR ORDER AND TRACK YOUR SHIPMENT</a> anytime after it's placed.</li>
                        </div>
                        <div>
                            <p>CAN I SHIP TO AN P.O. BOX?
                                Yes, you can ship most KSS orders to a P.O. Box address. Simply select 'P.O. Box' in Checkout or just start typing your P.O. Box address in the shipping address field.
                                P.O. Box orders ship via USPS Standard and arrive within 2-7 business days. Express shipping options are not available for P.O. Box addresses</p>
                        </div>
                        <div>
                            <p>CAN I CHANGE THE SHIPPING ADDRESS AFTER I PLACE THE ORDER?
                                Changes to an order are possible for a brief period of time after the order is placed..</p>
                        </div>
                        <br>
                        <h4>Refund Policy</h4>

                        Refunds must be requested through the KSS Office at 202-679-1389. <br>

                        Full refunds for KSS programs will be made automatically when canceled by KSS due to insufficient enrollment or other unforeseen reasons, or upon request when schedule or location changes made by KSS prohibit or limit your attendance. <br><br>

                        In order to receive a refund, customers must cancel within 48 hours after the first class. All refunds due to customer cancelation are subject to a $25 service charge. No refunds or credits will be given after this deadline, or if a customer is unable to attend a one-session program, class, or workshop. <br><br>

                        All refunds for camp(s) are subject to a $25 service charge per participant per camp session. All summer camp registration changes/cancelations are processed by the KSS Office and not at the camp site. Fees are based on registration for the camp session, not daily attendance. It is the responsibility of the parent/guardian to cancel if the camper will not attend. The deadline to make any changes to camp registrations, including cancelation, is 5 businessdays prior to the start date of camp. No refunds will be issued for cancelations after this period and the start of camp. <br><br>

                        Refunds for medical reasons must be accompanied by a physician's note and shall be considered on a case by case basis. <br><br>

                        Refunds may be retained as household credits and used towards registration in future KSS programs. If not retained as a household credit, credit card charges will be refunded directly to the credit card, if possible. All other refunds will be made by check. Refunds will be processed within 30 -60 days of the request. <br>




                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Privacy and Policy</h4>
                </div>
                <div class="modal-body">
                    <p class="text-justify">Some text in the modal.
                        In connection with using the KSS Programs on-line registration services (the “Services”), Khary Stockton Soccer,
                        LLC. (“KSS Programs”, “our”, “we”, “us” or applicable derivation) collects Personal Information from users of our
                        Services ("You"/"Your"). We respect Your rights with respect to our collection of Your Personal Information and it will
                        only be collected, used and disclosed as provided for in this policy or as otherwise specifically consented to by You.
                        The policy will apply to and protect Personal Information (as defined below) collected by KSS Programs. <br>
                        Scope <br>
                        This policy applies to Personal Information about users of our Services that is collected, used or disclosed to KSS
                        Programs in connection with the Services.<br>
                        <b>Definitions</b> <br>
                        To better understand this policy, KSS Programs has set out some basic definitions to use when reading and
                        interpreting it.
                        Collection: the act of gathering, acquiring, recording, or obtaining Personal Information from any source, including
                        <br>

                        third parties, by any means. <br>
                        Consent: voluntary agreement to the collection, use and disclosure of Personal Information for defined purposes.
                        Consent can be either express or implied and can be provided directly by the individual or by an authorized
                        representative. Express consent can be given orally, electronically or in writing, but is always unequivocal and does
                        not require any inference on the part of KSS Programs. Implied consent is consent that can reasonably be inferred
                        from the circumstances or from an individual’s action or inaction. <br>

                        Disclosure: making Personal Information available to a third party. <br>
                        Personal Information: information about an identifiable individual that is recorded in any form, but does not include
                        aggregated information that cannot be associated with a specific customer. For a customer, such information does
                        not include that which is aggregated in such a manner that it cannot be connected to him/her and/or information
                        which is publicly listed in a written or online directory or typically made available through directory assistance.
                        Use: the treatment, handling and management of Personal Information by and within KSS Programs.<br>
                        Collection of Personal Information <br>
                        As indicated above, we only collect Personal Information that You consciously provide as we provide the Services.
                        We may also collect Personal Information if You contact us, through e-mail, telephone conversations or the
                        completion of forms, for support and other inquiries.<br>
                        Accountability <br>
                        KSS Programs is responsible for Personal Information under its control and has designated its Privacy Officer as
                        accountable for the company’s compliance with the following principles. <br>
                        1. KSS Programs is responsible for Personal Information in its possession or custody, including information that has
                        been transferred by KSS Programs to a third party for processing. KSS Programs shall use contractual or other
                        means to provide a comparable level of protection while the information is being processed by such a third party.
                        2. KSS Programs shall implement policies and practices to give effect to: <br>
                        (a) Implementing procedures to protect Personal Information; <br>
                        (b) Establishing procedures to receive and respond to complaints and inquiries; <br>
                        (c) Training staff and communicating to staff information about the organization’s policies and practices; and<br>
                        (d) Developing information to explain the organization’s policies and procedures. <br>
                        Purposes and Collection <br>
                        Where appropriate, KSS Programs will identify the purposes for which Personal Information is collected at or before
                        the time the information is collected. <br>
                        1. KSS Programs collects Personal Information only for the following purposes:
                        (a) To provide the Services to our camp or organization customers (“Customers”) or users, including to enroll You at
                        Your selected camp(s) or organization(s). In providing the Services, Your Personal Information will be disclosed to
                        the camp(s) or organization(s) You have chosen to create an account at; <br>
                        (b) To establish and maintain responsible commercial relations with Customers and users (which will include, but


                        not be limited to: billing, communication and account verification);
                        (c) To meet legal and regulatory requirements; and
                        (d) To administer and manage its business operations.
                        2. Persons collecting Personal Information directly, other than through the Services, will be able to explain to
                        individuals the purposes for which the information is being collected, or will, upon request, refer the individual to a
                        designated person at KSS Programs who will explain the purposes.
                        3. Unless required by law, KSS Programs shall not use or disclose Personal Information for any purpose other than
                        those described above without first identifying and documenting the new purpose and obtaining the consent from
                        You, where such consent may not reasonably be implied. <br>
                        Consent
                        The knowledge and consent of the individual are required for the collection, use, or disclosure of Personal
                        Information, except in certain circumstances as described below:
                        1. In certain circumstances, Personal Information can be collected, used, or disclosed without the knowledge and
                        consent of the individual. For example, legal, medical or security reasons may make it impossible or impractical to
                        seek consent. When information is being collected for the detection and prevention of fraud or for law enforcement,
                        seeking the consent of the individual might defeat the purpose of collecting the information. Seeking consent may
                        be impossible or inappropriate where there is an emergency threatening the individual’s life, health or security, or
                        where the individual is a minor, seriously ill, or mentally incapacitated. In other instances, information may be
                        publicly available. <br>
                        2. In obtaining consent, KSS Programs will use reasonable efforts to ensure that You are advised of the identified
                        purposes for which Personal Information collected will be used or disclosed. <br>
                        3. The form of consent sought by KSS Programs, in respect of information sought to be collected in association with
                        the Services but outside of the completion of the applicable online registration form, may vary depending upon the
                        circumstances and type of information disclosed. In determining the appropriate form of consent, KSS Programs
                        shall take into account the sensitivity of the Personal Information and the reasonable expectations of its customers
                        and employees. <br>
                        4. Your use of the Services in the completion of online registration form(s) will be considered implied consent to
                        collect, use and disclose the associated Personal Information for all identified purposes. <br>
                        5. You may withdraw consent at any time, subject to legal or contractual restrictions and reasonable notice. KSS
                        Programs will inform the individual of the implications of such withdrawal. In order to withdraw consent, You must
                        provide notice to KSS Programs in writing. <br>
                        Use and Retention of Personal Information
                        Any Personal Information collected by us will be used solely for the purposes of carrying on our internal business
                        affairs and providing KSS Programs Services to You and our customers, and other services as You or our
                        customers may request and authorize from time to time. Personal Information will be retained only as long as
                        necessary for the fulfillment of those purposes. <br>
                        1. Generally, all Personal Information collected by KSS Programs is to provide You or our customers with the
                        Services (i.e., enroll You or Your children at the selected camp(s) and organization(s)) and will be provided to the
                        applicable camp(s) and organization(s) for such purposes as well as for such reasonably ancillary use in
                        connection with the operation of such camp(s) and organization(s). We may also disclose Your Personal
                        Information to: <br>


                        (a) a credit card payment processing company; and
                        (b) any other third party, upon receiving Your consent or as required by law.
                        2. Only KSS Programs’ employees or our customers with a business need to know, or whose duties reasonably so
                        require are granted access to Your Personal Information.
                        3. Personal Information that is no longer required to fulfill the identified purposes will be destroyed, erased or made
                        anonymous according to the guidelines and procedures established by KSS Programs. It is KSS Programs’ practice
                        to retain Your account registration information after You have registered so that in the following year Your
                        registration information will be pre-filled to simplify the registration process.
                        4. In the event that we disclose Your Personal Information to the third parties described above or to a data storage
                        company, as appropriate, KSS Program commits to contractually bind such entities to abide by the fundamental
                        terms of this policy and applicable laws, including with respect to their capability to use, disclose and retain such
                        Personal Information. <br>
                        5. Except as provided for in this policy, we will not sell, rent, lease, commercially exploit or otherwise disclose
                        Your Personal Information or data to third parties unless: (i) required by law or to cooperate with any bona fide
                        legal investigation; (ii) required to protect the legal interests of KSS Programs or our customers, including for
                        credit checking and collection purposes, as applicable, or in connection with a potential financing, merger or
                        acquisition in which case the applicable counterparties shall be placed under obligations of confidentiality; or
                        (iii) You provide consent to such disclosure.
                        Accuracy <br>
                        At Your request and notification, KSS Programs will update Personal Information as necessary to fulfill the identified
                        purposes. You always have the right to request that we delete, destroy, return, amend or update Your Personal
                        Information in our possession as You may direct, subject to reasonable notice.
                        Security <br>
                        Personal Information will be protected by security safeguards appropriate to the sensitivity of the information.
                        1. Any Personal Information in our possession is stored electronically, either on our server (which may be hosted
                        offsite) or on other electronic storage media that may be retained as part of Your files or otherwise.
                        2. We have security measures in place to protect against the loss, misuse, access to or alteration of Your Personal
                        Information and data under our control.<br>
                        3. We operate computer networks that are protected by industry standard firewalls and password protection.
                        Appropriate physical and managerial security is also in place, including but not limited to the execution by our
                        employees of a confidentiality/non-disclosure agreement as a standard practice of our hiring and employment.
                        4. KSS Programs will protect Personal Information it discloses to third parties through contractual agreements
                        stipulating the confidentiality of the information and the purposes for which it is to be used.
                        5. While we cannot guarantee that loss, misuse or alteration to Your data will not occur, we will use our resources
                        and expertise to attempt to prevent such occurrences.
                        6. We commit to providing a minimum of an annual review and training with respect to this policy among our staff
                        with potential access to Your Personal Information.
                        Openness and Access <br>


                        KSS Programs will make readily available to You information about its policies and practices relating to the
                        management of Personal Information. KSS Programs will make this Privacy Policy available to You prior to
                        providing the Services. On request a copy of this Privacy Policy will be provided by mail.
                        You may access or inquire about Your Personal Information in our possession at any time during our business
                        hours. The Personal Information requested will be provided within a reasonable time, and at a minimal or no cost to
                        You.
                        Upon Your request, KSS Programs will be as specific as possible in providing an account of third parties to which it
                        has disclosed Your Personal Information. When it is not possible to provide a list of the organizations to which it has
                        actually disclosed information about an individual, KSS Programs will provide a list of organizations to which it may
                        have disclosed.
                        NOTE: In certain situations, KSS Programs may not be able to provide access to all of the Personal Information it
                        holds about You. Exceptions may include information that is prohibitively costly to provide, information that contains
                        references to other individuals, information that cannot be disclosed for legal, security or commercial proprietary
                        reasons, or information that is subject to solicitor-client or litigation privilege. KSS Programs will provide the reasons
                        for denying access upon request.
                        Challenging Compliance
                        In the event of any dispute, complaint or problem with respect to this policy and related KSS Programs practices, a
                        definitive procedure for resolution has been established as outlined below. KSS Programs is committed to resolving
                        any such issues promptly, justly, objectively and, where possible, confidentially.
                        A written outline of the issue should be forwarded directly to the Privacy Officer of KSS Programs, who in turn will
                        investigate, examine and evaluate all the facts. On the information gathered and other related details, a formal
                        written decision will be completed and will be forwarded to You within 30 days of the Privacy Officer’s receipt of
                        Your complaint. During investigation of the issue, it may be necessary for further Personal Information to be shared
                        with the Privacy Officer or other appropriate parties internal or external to KSS Programs. In all cases, KSS
                        Programs will remain responsible for the protection of all such Personal Information.
                        Children’s Privacy Protection
                        Children under 13 years of age are not permitted to use our Services. We do not knowingly collect any information
                        from children under 13 years of age. If You are under 13 years of age, You are not permitted to submit Personal
                        Information to us.
                        Notification of changes
                        We may update this privacy policy from time to time, so please review it periodically. However, regardless of our
                        right to update this policy as indicated, we will never use Personal Information that You have provided to us in a
                        new way without providing You an opportunity to give us Your consent.
                        Contact Us
                        For further information concerning this privacy policy or its application or for access to Your or Your Customers’
                        Personal Information, please write to us, in English only, via e-mail at info@kssprograms.

                        COPPA - Children's Online Privacy Protection Act
                        "COPPA" refers to a United States federal law called the "Children's Online Privacy Protection Act". The law applies


                        to the online collection of personal information from children under 13.
                        Children under 13 years of age are not permitted to use our service and sign-up through this website. We do not
                        knowingly collect any information from children under 13 years of age. If You are under 13 years of age, you are not
                        permitted to submit Personal Information to us.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- PayPal In-Context Checkout script -->
<script type="text/javascript">
    window.paypalCheckoutReady = function () {
        paypal.checkout.setup('<?php echo(MERCHANT_ID); ?>', {
            environment: '<?php echo($environment); ?>', //or 'production' depending on your environment
            button: ['t1']
        });
    };
</script>
<script src="//www.paypalobjects.com/api/checkout.js" async></script>

<script>
    var IsBagItem=false;
    var CurrentStep="#step-1";
    $(function () {
        GetBagData();

        $(".ShippingPolicy").click(function () {
            $(".PolicyBoxContainer").show();
        });

        $(".close-btn").click(function () {
            $(".PolicyBoxContainer").hide();
        });
    });
    function GetBagData(){
        console.log("called getbag");
        var isProduct=false;
        $.ajax({
            type	: "POST",
            url	: "lib/my_cart.php",
            dataType : 'json',
            data	:{
                reqtype:'get'
            },
            success	: function (resp) {
                if(resp.success){
                    $(".BagSubTotal").html(resp.SubTotal);

                    $items="";
                    if(resp.cart_items.length>0){
                        IsBagItem=true;
                        for(var i=0; i<resp.cart_items.length;i++){
                            $color=resp.cart_items[i]['color'];
                            $size=resp.cart_items[i]['size'];
                            $item_type=resp.cart_items[i]['item_type'];
                            if($item_type=="product"){
                                isProduct=true;
                            }
                            $item_description=resp.cart_items[i]['item_description'];
                            $package_total=resp.cart_items[i]['price'];
                            if($color!==""){
                                $color="<br><div><b>Color: </b>"+'<div style="display: inline-block; margin-bottom: -5px;height:25px; width:25px;background-color: '+$color+'"></div></div>';
                            }
                            if($size!==""){
                                $size="<br><b>Size: </b>"+$size;
                            }
                            if($item_type!==""){
                                $item_type="<br><b>Type: </b>"+$item_type;
                            }
                            if($item_description!==""){
                                $item_description=" - "+$item_description;
                            }

                            $items+='<tr>'+
                                '<td>'+resp.cart_items[i]['name']+' '+$size+' '+$color+'<input type="hidden" class="SizeColor" name="SizeColor" data-type="'+resp.cart_items[i]['item_type']+'" data-desc="'+resp.cart_items[i]['item_description']+'"  data-package="'+resp.cart_items[i]['price']+'" data-size="'+resp.cart_items[i]['size']+'" data-color="'+resp.cart_items[i]['color']+'" ></td>'+
                                '<td><input type="number" name="quantity" style="width: 50px;" class="kss-input NewQuantity" min="1" value="'+resp.cart_items[i]['quantity']+'"> &nbsp; <span data-val="'+resp.cart_items[i]['id']+'" class="UpdateQuantity">Update</span></td>'+
                                '<td>$'+resp.cart_items[i]['total']+'</td>'+
                                '<td>'+
                                '<a href="javascript:void(0);" data-slug="'+resp.cart_items[i]['slug']+'" class="RemoveProduct">REMOVE</a><br>'+
                                '<a style="font-size: 12px;" class="add-to-wish" data-val="'+resp.cart_items[i]['id']+'" href="javascript:void(0);">Save for Later</a>'+
                                '</td>'+
                                '</tr>'+
                                '<tr>';
                        }
                    }else{
                        IsBagItem=false;
                        $items='<tr><td colspan="4">No Item Available</td></tr>';
                    }
                    $(".ShippingMethod").attr('checked',false);
                    if(isProduct){
                        if(resp.SubTotal>49){
                            $(".freeShipping").show();
                            $(".freeShipping").find(".ShippingMethod").attr('checked',true);
                            $(".paidShipping").hide();
                        }else{
                            $(".freeShipping").hide();
                            $(".paidShipping").find(".ShippingMethod:last-child").attr('checked',true);
                            $(".paidShipping").show();
                        }
                    }else{
                        $(".freeShipping").show();
                        $(".freeShipping").find(".ShippingMethod").attr('checked',true);
                        $(".paidShipping").hide();
                    }

                    $('.bag-items').html(' <table width="100%">'+
                        '<tr style=" background: rgba(179, 179, 179, 0.63);">'+
                        '<th>Item Description</th>'+
                        '<th>Quantity</th>'+
                        '<th>Unit Price</th>'+
                        '<th >Edit</th>'+
                        '</tr>'+
                        $items+
                        '</table>');

                    $("input[name=quantity]").keypress(function(e){
                        if($(this).val()==0){
                            e.preventDefault();
                            return false;
                        }
                        if (e.which < 48 || 57 < e.which)
                            e.preventDefault();
                    });
                    $("input[name=quantity]").keyup(function(e){
                        if($(this).val()==0){
                            $(this).val(1);
                            e.preventDefault();
                            return false;
                        }
                    });

                }else{
                }
            }
        });
    }
</script>
<?php include_once "include_bottom.php"?>
<script>
    $(function () {
        $(".address_type").change(function () {
            $val=$(this).val();
            if($val=="same"){
                $("input[name=s_recipient_name]").val($("input[name=b_recipient_name]").val());
                $("input[name=s_line1]").val($("input[name=b_line1]").val());
                $("input[name=s_line2]").val($("input[name=b_line2]").val());
                $("input[name=s_city]").val($("input[name=b_city]").val());
                $("select[name=s_country_code]").val($("select[name=b_country_code]").val());
                $("select[name=s_state]").val($("select[name=b_state]").val());
                $("input[name=s_postal_code]").val($("input[name=b_postal_code]").val());

                $("input[name=s_fname]").val($("input[name=b_fname]").val());
                $("input[name=s_lname]").val($("input[name=b_lname]").val());
                $("input[name=s_phone]").val($("input[name=b_phone]").val());
            }else{
                $('.ShippingAddress input, .ShippingAddress select').each(function () {
                    if($(this).hasClass('address_type')){}else{
                        $(this).val('');
                    }
                });
            }
        });
        $(".ShowShipping").click(function () {
            $b_postal_code=$("input[name=b_postal_code]").val();
            $b_phone=$("input[name=b_phone]").val();
            $b_name=$("input[name=b_recipient_name]").val();
            $b_line1=$("input[name=b_line1]").val();
            $b_postal_code=$("input[name=b_postal_code]").val();
            $b_city=$("input[name=b_city]").val();
            $status=true;
            if($b_postal_code=="" || $b_name=="" || $b_line1=="" || $b_city==""){
                $.toaster({ priority : 'warning', title : 'Error', message : "Please Fill all fields with * !"});
                $status=false;
            }
            else if($b_postal_code.length!=5)
            {
                $.toaster({ priority : 'warning', title : 'Error', message : "Please enter valid Postal Code!"});
                $("input[name=b_postal_code]").focus();
                $status=false;
            }
            else if($b_phone!=="")
            {
                if($b_phone.length<7 || $b_phone.length>11){
                    $.toaster({ priority : 'warning', title : 'Error', message : "Please enter valid Phone Number!"});
                    $("input[name=b_phone]").focus();
                    $status=false;
                }else{
                    $status=true;
                }
            }
            else
            {
                $status=true;
            }
            if($status==true)
            {
                $(".ShippingAddress").show();
                $(".BillingAddress").hide();
            }
        });
        $(".ShowBilling").click(function () {
            $(".ShippingAddress").hide();
            $(".BillingAddress").show();
        });

        $("#PayWithCard").click(function () {
            $number=$("input[name=cardnumber]").val();
            $cvc=$("input[name=cvc]").val();
            $exp_month=$("select[name=exp_month]").val();
            $exp_year=$("select[name=exp_year]").val();
            if($number=="" || $cvc=="" || $exp_month=="" || $exp_year==""){
                $.toaster({ priority : 'warning', title : 'Error', message : "Please fill all card details!"});
                return false;
            }

            if(!validateCard()){
                return false;
            }

            $elm=$("#PayWithCard");
            $elm.hide();
            $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
            $.ajax({
                type	: "POST",
                url	: "lib/authorize/PaymentTransactions/charge-credit-card.php",
                data	: $("#CheckoutForm").serialize(),
                dataType:'json',
                success	: function (resp) {
                    if(resp.success){
                        $("#CheckoutForm")[0].reset();
                        $.toaster({ priority : 'success', title : 'Success', message : resp.msg});
                        setTimeout(function () {
                            location.href="order_success.php";
                        },3000);
                    }else{
                        $elm.show();
                        $(".loading").remove();
                        $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
                        alert(resp.error_msg);
                    }
                    $(".loading").remove();
                    $elm.show();
                }
            });
        });

    });

    $(document).on('click','.UpdateQuantity',function () {
        $elm=$(this);
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
        $.ajax({
            type	: "POST",
            url	: "lib/my_cart.php",
            dataType : 'json',
            data	: {
                id:$elm.attr('data-val'),
                quantity:$elm.parents('tr').find('.NewQuantity').val(),
                size:$elm.parents('tr').find('.SizeColor').attr('data-size'),
                color:$elm.parents('tr').find('.SizeColor').attr('data-color'),
                reqtype:'add',
                item_type:$elm.parents('tr').find('.SizeColor').attr('data-type'),
                item_description:$elm.parents('tr').find('.SizeColor').attr('data-desc'),
                package_total:$elm.parents('tr').find('.SizeColor').attr('data-package'),
            },
            success	: function (resp) {
                if(resp.success){
                    GetBagData();
                    $.toaster({ priority : 'success', title : 'Success', message : "Quantity Updated"});
                }else{
                    $elm.show();
                    $(".loading").remove();
                    $.toaster({ priority : 'warning', title : 'Error', message : resp.msg});
                }
                $(".loading").remove();
                $elm.show();
            }
        });
    });

    $(document).on('click','.RemoveProduct',function () {
        $elm=$(this);
        $elm.hide();
        $elm.after('<i class="fa fa-spinner fa-spin fa-1x fa-fw loading"></i>');
        $.ajax({
            type	: "POST",
            url	: "lib/my_cart.php",
            dataType : 'json',
            data	: {
                slug:$(this).attr('data-slug'),
                reqtype:'remove'
            },
            success	: function (resp) {
                if(resp.success){
                    GetBagData();
                    $.toaster({ priority : 'success', title : 'Success', message : "Product Removed!"});
                }else{
                    $elm.show();
                    $(".loading").remove();
                    $.toaster({ priority : 'warning', title : 'Error', message : "Please Try Again!"});
                }
                $(".loading").remove();
                $elm.show();
            }
        });
    });

    $(document).ready(function () {
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');
        allWells.hide();
        // $("#step-1").show();
        navListItems.click(function (e) {
            e.preventDefault();

            CurrentStep=$(this).attr('href');
            if($(this).attr('href')!=="#step-1"){
                if(!ValidateData()){
                    return false;
                }
            }
            var $target = $($(this).attr('href')),
                $item = $(this);
            if($(this).attr('href')=='#step-4'){
                getCartData();
            }
            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-yellow').addClass('btn-default');
                $item.addClass('btn-yellow');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();

            }
        });
        allNextBtn.click(function(){


            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;
            CurrentStep=nextStepWizard.attr('href');
            if(!ValidateData()){
                return false;
            }
            if(curStepBtn=='step-3'){
                getCartData();
            }
            $(".form-group").removeClass("has-error");

            nextStepWizard.removeAttr('disabled').trigger('click');
        });
        $('div.setup-panel div a.btn-yellow').trigger('click');
    });

    function ValidateData() {
        if(!IsBagItem){
            $('div.setup-panel div a[href="#step-1"]').trigger('click');
            $.toaster({ priority : 'warning', title : 'Error', message : "Your Cart Is Empty!"});
            return false;
        }else{
            console.log(''+CurrentStep);
            if(CurrentStep=="#step-3"){
                $city=$("input[name=s_city]").val();
                $post_code=$("input[name=s_postal_code]").val();
                $name=$("input[name=s_recipient_name]").val();
                $phone_no=$("input[name=s_phone]").val();
                $s_line1=$("input[name=s_line1]").val();

                $postal_code_length=$post_code.length;
                $phone_length=$phone_no.length;


                if($post_code=="" || $name=="" || $s_line1=="" || $city==""){
                    $.toaster({ priority : 'warning', title : 'Error', message : "Please Fill all fields with * !"});
                    return false;
                }

                if($postal_code_length!=5)
                {
                    $.toaster({ priority : 'warning', title : 'Error', message : "please Enter valid Postal code!"});
                    $("input[name=s_postal_code]").focus();
                    return false;

                }
                if($phone_no!==""){
                    if($phone_length<7 || $phone_length>11)
                    {
                        $.toaster({ priority : 'warning', title : 'Error', message : "please Enter valid Mobile No!"});
                        $("input[name=s_phone]").focus();
                        return false;
                    }else{
                        return true;
                    }
                }

            }

            if(CurrentStep=="#step-4"){
                $city=$("input[name=s_city]").val();
                $post_code=$("input[name=s_postal_code]").val();
                $name=$("input[name=s_recipient_name]").val();
                if($city=="" || $post_code=="" || $name==""){
                    $.toaster({ priority : 'warning', title : 'Error', message : "Please fill shipping details(city,zip etc.)!"});
                    return false;
                }
            }

        }
        return true;
    }

    function getCartData() {
        $(".FinalBillingText").html('' +
            $("input[name=b_recipient_name]").val()+'<br>' +
            $("input[name=b_line1]").val()+'<br>' +
            $("input[name=b_line2]").val()+',' +
            $("input[name=b_postal_code]").val()+'<br>' +
            $("input[name=b_city]").val()+',' +
            $("select[name=b_state]").val()+',' +
            $("select[name=b_country_code]").val()
        );
        $(".FinalShippingText").html('' +
            $("input[name=s_recipient_name]").val()+'<br>' +
            $("input[name=s_line1]").val()+'<br>' +
            $("input[name=s_line2]").val()+',' +
            $("input[name=s_postal_code]").val()+'<br>' +
            $("input[name=s_city]").val()+',' +
            $("select[name=s_state]").val()+',' +
            $("select[name=s_country_code]").val()
        );

        $("input[name=recipient_name]").val($("input[name=s_recipient_name]").val());
        $("input[name=line1]").val($("input[name=s_line1]").val());
        $("input[name=line2]").val($("input[name=s_line2]").val());
        $("input[name=city]").val($("input[name=s_city]").val());
        $("input[name=country_code]").val($("select[name=s_country_code]").val());
        $("input[name=state]").val($("select[name=s_state]").val());
        $("input[name=postal_code]").val($("input[name=s_postal_code]").val());
        $("input[name=shipping_method]").val($("input[name=shipping_method1]:checked").val());

        $(".FinalShippingMethod").html('' +
            $("input[name=shipping_method1]:checked").attr('data-val2')+'<br>'+
            $("input[name=shipping_method1]:checked").attr('data-val')+'<br>'
        );

        $.ajax({
            type	: "POST",
            url	: "lib/my_cart.php",
            dataType : 'json',
            data	:{
                reqtype:'get'
            },
            success	: function (resp) {
                if(resp.success){
                    $SubTotal=resp.SubTotal;

                    $TotalTax=resp.total_tax;
                    $ShippingTotal=parseFloat($("input[name=shipping_method]").val());
                    $Total=parseFloat($SubTotal)+parseFloat($TotalTax)+parseFloat($ShippingTotal);
                    $("input[name=total]").val($Total);
                    $(".FinalSubTotal").html($SubTotal);
                    $(".FinalTaxTotal").html($TotalTax);
                    $(".FinalShippingTotal").html($ShippingTotal);
                    $(".FinalBalanceDue").html($Total);
                    $(".FinalTotal").html($Total);
                }else{
                }
            }
        });
    }
</script>