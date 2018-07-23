<?php
require '../vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
include_once "../../config.php";
define("AUTHORIZENET_LOG_FILE", "phplog");

if(isset($_POST) && count($_POST)>0){
    if(isset($_SESSION) && isset($_SESSION['PackageData'])){
        chargeCreditCard($_POST,$con);
    }
}
function chargeCreditCard($post_data,$con=''){
    $success=false;
    $msg="";
    $error_msg="";
    $post_data= $_SESSION['PackageData'];
    $package_type=$post_data['package_type'];
    $cardnumber=$post_data['cardnumber'];
    $cvc=$post_data['cvc'];
    $exp_month=$post_data['exp_month'];
    $exp_year=$post_data['exp_year'];
    $exp_date=$exp_year.'-'.$exp_month;
    $product_id=$post_data['package_id'];
    $email=$_SESSION['useremail'];

    $record_date=date('Y-m-d H:i:s');
    //$cartitems_old=$_SESSION["TransactionData"]["cart_items"];
    $product_detail=json_encode(array('product_id'=>$post_data['package_id'],'fees'=>$post_data['fees']));
    $sub_total=$post_data['fees'];
    $total=$post_data['fees'];

    $user_id= $_SESSION['loggedId'];
    $msg1="";
    $sub="";
    $to=$email;
    if($package_type=='party' || $package_type=='camp' || $package_type=='tutoring'){
        $stm = $con->prepare("select * from packages where id = '$product_id' ");
        $stm->execute();
        $prd_res = $stm->fetch(PDO::FETCH_ASSOC);

        $product_detail=json_encode($prd_res);
        $package_title=$prd_res['package_title'];
        $type=$prd_res['type'];
        $category=$prd_res['category'];
        $time=$prd_res['time'];
        $location=$prd_res['location'];
        // $noofchildern=$prd_res['num_of_children'];
        $payment_for=$package_type;


        $sub = "New ".$package_type." Enrollment";
        $msg1 = "You have successfully enrolled for kss $package_type and below the details of the $package_type :<br> "."<b>$type Title:</b>" . $package_title . "<br>" . "<b>Location:</b>" . $location . "<br>" . "<b>Time:</b>" . $time . "<br>" . "<b>Party-Price:$</b>".$total."<br><br>for more Information please contact us:<a href='info@kssprograms.com'>info@kssprograms.com</a>";


    }

    else{
        $stm = $con->prepare("select * from classes where id = '$product_id'");
        $stm->execute();
        $prd_res = $stm->fetch(PDO::FETCH_ASSOC);
        $product_detail=json_encode($prd_res);
        $type=$prd_res['type'];
        $classes_type=$prd_res['classes_type'];
        $date_from=$prd_res['date_from'];
        $date_to=$prd_res['date_to'];
        $state=$prd_res['state'];
        $city=$prd_res['city'];
        $address1=$prd_res['address1'];
        $category=$prd_res['category'];
        $payment_for='Classes';
        $sub="New Classes Enrollment";
        $msg1 = "You have successfully enrolled for kss classes and below the details of the classes :<br> "."<b>Class Category:</b>" . $category . "<br>" . "<b>Class Type:</b>" . $classes_type . "<br>" . "<b>From Date:</b>" . $date_from . "<br>" . "<b>Date To:</b>".$date_to. "<br>" . "<b>Address:</b>".$address1. "<br>" . "<b>City:</b>".$city ."<br>" . "<b>State:</b>".$state."<br><br>for more Information please contact us:<a href='info@kssprograms.com'>info@kssprograms.com</a>";


    }

    $stmt = $con->prepare("INSERT INTO transactions (user_id,payment_for,gateway,token,product_detail,full_detail,shipping_address,billing_address,tax,shipping,sub_total,total,payment_status,entry_date,delivery_status,viewed,status,description,payment_id,payer_id) 
                VALUES ('$user_id','$payment_for','Credit Card','','$product_detail','','','','','','$sub_total','$total','Pending','$record_date','','0','1','','','')");

    $stmt->execute();
    $refId=$con->lastInsertId();

    // Common setup for API credentials
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(\SampleCode\Constants::MERCHANT_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(\SampleCode\Constants::MERCHANT_TRANSACTION_KEY);

    // Create the payment data for a credit card 4111111111111111
    $creditCard = new AnetAPI\CreditCardType();
    $creditCard->setCardNumber($cardnumber);
    $creditCard->setExpirationDate($exp_date);
    $creditCard->setCardCode($cvc);
    $paymentOne = new AnetAPI\PaymentType();
    $paymentOne->setCreditCard($creditCard);

    $order = new AnetAPI\OrderType();
    $order->setDescription("Kss Store Product Payment");
    $order->setInvoiceNumber("98100");

    //create a transaction
    $transactionRequestType = new AnetAPI\TransactionRequestType();
    $transactionRequestType->setTransactionType( "authCaptureTransaction");
    $transactionRequestType->setAmount($total);
    $transactionRequestType->setOrder($order);
    $transactionRequestType->setPayment($paymentOne);


    $request = new AnetAPI\CreateTransactionRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setRefId($refId);
    $request->setTransactionRequest($transactionRequestType);
    $controller = new AnetController\CreateTransactionController($request);

    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
    $msg="";
    if ($response != null)
    {
        if($response->getMessages()->getResultCode() == \SampleCode\Constants::RESPONSE_OK)
        {
            $tresponse = $response->getTransactionResponse();
            if ($tresponse != null && $tresponse->getMessages() != null)
            {
                $payment_id=$tresponse->getTransId();
                $auth_code=$tresponse->getAuthCode();
                $ref_trans_id=$response->getRefId();
                $statement = $con->prepare("select * from transactions where id = :id");
                $statement->execute(array(':id' => $ref_trans_id));
                $row = $statement->fetch(PDO::FETCH_ASSOC);
                if($statement->rowCount()>0){
                    $statement = $con->prepare("update transactions set payment_status=:pay_status,payment_id=:payment_id,payer_id=:payer_id,token=:token where id = :id");
                    $statement->execute(array(':pay_status' => 'Complete',
                        ':payment_id' => $payment_id,
                        ':payer_id' => '',
                        ':id' => $ref_trans_id,
                        ':token' => $auth_code));
                    $t_data="";

                    $peers1="";

                    unset($_SESSION["PackageData"]);
                    if (send_mail(array($to), $sub, $msg1)) {

                    } else {

                    }

                    echo json_encode(array('success'=>true,'msg'=>'Thank you for enrollment in the kss!','data'=>''));
                }else{
                    echo json_encode(array('success'=>false,'msg'=>'Invalid Request!','data'=>''));
                }
            }
            else
            {
                $error_msg= "Transaction Failed <br/>";
                $msg="Something went wrong!";
                if($tresponse->getErrors() != null)
                {

                    $error_msg.= " Error message : " . $tresponse->getErrors()[0]->getErrorText() . "";
                    $msg=$tresponse->getErrors()[0]->getErrorText();
                }
                echo json_encode(array('success'=>false,'msg'=>$msg,'data'=>'','error_msg'=>$error_msg));

            }
        }
        else
        {
            $error_msg= "Transaction Failed <br/>";
            $msg="Something went wrong!";
            $tresponse = $response->getTransactionResponse();
            if($tresponse != null && $tresponse->getErrors() != null)
            {
                $error_msg.= " Error message : " . $tresponse->getErrors()[0]->getErrorText() . "";
                $msg=$tresponse->getErrors()[0]->getErrorText();
            }
            else
            {
                $error_msg.= " Error message : " . $response->getMessages()->getMessage()[0]->getText() . "";
                $msg=$response->getMessages()->getMessage()[0]->getText();
            }
            echo json_encode(array('success'=>false,'msg'=>$msg,'data'=>'','error_msg'=>$error_msg));
        }

    }
    else
    {
        $msg="No Response Return!";
        $error_msg="No Response Return!";
        echo json_encode(array('success'=>false,'msg'=>$msg,'data'=>'','error_msg'=>$error_msg));
    }
    $statement = $con->prepare("update transactions set description=:description where id = :id");
    $statement->execute(array(':description' => $msg,
        ':id' => $refId,
    ));

}
?>
