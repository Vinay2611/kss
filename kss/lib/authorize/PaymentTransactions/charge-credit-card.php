<?php
  require '../vendor/autoload.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
  include_once "../../config.php";
  define("AUTHORIZENET_LOG_FILE", "phplog");

 $post_data=$_POST;

 chargeCreditCard($post_data,$con);

  function chargeCreditCard($post_data,$con=''){
      $success=false;
      $msg="";
      $error_msg="";
      $cardnumber=$_POST['cardnumber'];
      $cvc=$_POST['cvc'];
      $exp_month=$_POST['exp_month'];
      $exp_year=$_POST['exp_year'];
      $exp_date=$exp_year.'-'.$exp_month;

      $sub_total=$_SESSION["TransactionData"]["SubTotal"];
      $tax_total=$_SESSION["TransactionData"]["total_tax"];
      $shipping_total=(float)$_POST['shipping_method'];
      $total=$sub_total+$shipping_total+$tax_total;
      $tble_data="<tr><td colspan='3'>Shipping</td><td>$shipping_total</td></tr>";
      $tble_data.="<tr><td colspan='3'>Tax</td><td>$tax_total</td></tr>";
      $tble_data.="<tr><td colspan='3'>Order Total</td><td>$total</td></tr>";
      $shipping_add=array(
        'recipient_name' => $_POST['recipient_name'],
          'line1'=>$_POST['line1'],
          'line2'=>$_POST['line2'],
          'postal_code'=>$_POST['postal_code'],
          'city'=>$_POST['city'],
          'state'=>$_POST['state'],
          'phone_no'=>$_POST['s_phone']
      );

      $sfname=$_POST['s_fname'];
      $slname=$_POST['s_lname'];
      $phone_no=$_POST['b_phone'];

      $billing_add=array(
          'recipient_name' => $_POST['b_recipient_name'],
          'line1'=>$_POST['b_line1'],
          'line2'=>$_POST['b_line2'],
          'postal_code'=>$_POST['b_postal_code'],
          'city'=>$_POST['b_city'],
          'state'=>$_POST['b_state'],
          'phone_no'=>$_POST['b_phone']
      );

      $bfname=$_POST['b_fname'];
      $blname=$_POST['b_lname'];
      $shipping_add=json_encode($shipping_add);
      $billing_add=json_encode($billing_add);

      $record_date=date('Y-m-d H:i:s');
      //$cartitems_old=$_SESSION["TransactionData"]["cart_items"];
      $product_detail=json_encode($_SESSION['TransactionData']['cart_items']);

      $user_id= $_SESSION['loggedId'];

      $stmt = $con->prepare("INSERT INTO transactions (user_id,gateway,token,product_detail,full_detail,shipping_address,billing_address,tax,shipping,sub_total,total,payment_status,entry_date,delivery_status,viewed,status,description,payment_id,payer_id,phone_no) 
                VALUES ('$user_id','Credit Card','','$product_detail','','$shipping_add','$billing_add','$tax_total','$shipping_total','$sub_total','$total','Pending','$record_date','','0','1','','','','$phone_no')");

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

      // Create the Bill To info
      $billto = new AnetAPI\CustomerAddressType();
      $billto->setFirstName($bfname);
      $billto->setLastName($blname);
      $billto->setAddress($_POST['b_line1']." ".$_POST['b_line2']);
      $billto->setCity($_POST['b_city']);
      $billto->setState($_POST['b_state']);
      $billto->setZip($_POST['b_postal_code']);
      $billto->setCountry("USA");

      // Create the Bill To info
      $shipto = new AnetAPI\CustomerAddressType();
      $shipto->setFirstName($sfname);
      $shipto->setLastName($slname);
      $shipto->setAddress($_POST['line1']." ".$_POST['line2']);
      $shipto->setCity($_POST['city']);
      $shipto->setState($_POST['state']);
      $shipto->setZip($_POST['postal_code']);
      $shipto->setCountry("USA");


      $order = new AnetAPI\OrderType();
      $order->setDescription("Kss Product Payment");
      $order->setInvoiceNumber($refId);

      //create a transaction
      $transactionRequestType = new AnetAPI\TransactionRequestType();
      $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
      $transactionRequestType->setAmount($total);
      $transactionRequestType->setOrder($order);
      //$transactionRequestType->setBillTo($billto);
      //$transactionRequestType->setShipTo($shipto);
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
              $_SESSION['payment_status']=true;
              $_SESSION['payment_id']=$payment_id;
              if($statement->rowCount()>0){
                  $statement = $con->prepare("update transactions set payment_status=:pay_status,payment_id=:payment_id,payer_id=:payer_id,token=:token where id = :id");
                  $statement->execute(array(':pay_status' => 'Complete',
                      ':payment_id' => $payment_id,
                      ':payer_id' => '',
                      ':id' => $ref_trans_id,
                      ':token' => $auth_code));
                    $t_data="";
                  $add_on_desc="";
                  foreach ($_SESSION['TransactionData']["cart_items"] as $item) {
                      $pid=$item['id'];
                      $item_type=$item['item_type'];
                      if($item_type=='camps'){
                          $statement = $con->prepare("select * from packages where id = :id and category='addon'");
                          $statement->execute(array(':id' => $pid));
                          $row = $statement->fetch(PDO::FETCH_ASSOC);
                          if($statement->rowCount()>0){
                              $add_on_desc.=$row['package_title']." - ".$row['time']."<br>";
                          }
                      }
                  }
                  foreach ($_SESSION['TransactionData']["cart_items"] as $item) {
                      $qty=$item['quantity'];
                      $pid=$item['id'];
                      $iname=$item['name'];
                      $size=$item['size'];
                      $price=$item['price'];
                      $discount=$item['discount'];
                      $color=$item['color'];
                      $itotal=$item['total'];
                      $item_type=$item['item_type'];
                      $item_description=$item['item_description'];
                      $add_on_detail="";
                      if($item_type=='camps'){
                          $statement = $con->prepare("select * from packages where id = :id and category='addon'");
                          $statement->execute(array(':id' => $pid));
                          $row = $statement->fetch(PDO::FETCH_ASSOC);
                          if($statement->rowCount()>0){
                          }else{
                              $add_on_detail=$add_on_desc;
                          }
                      }
                      $stmt = $con->prepare("INSERT INTO orders (transaction_id,item_id,item_type,item_description,`name`,`size`,color,quantity,price,discount,total,addon_detail) 
                                            VALUES (:transaction_id,:item_id,:item_type,:item_description,:name,:size,:color,:quantity,:price,:discount,:total,:addon_detail)");
                      $stmt->bindParam(':transaction_id', $ref_trans_id);
                      $stmt->bindParam(':item_id', $pid);
                      $stmt->bindParam(':item_type', $item_type);
                      $stmt->bindParam(':item_description', $item_description);
                      $stmt->bindParam(':name', $iname);
                      $stmt->bindParam(':size', $size);
                      $stmt->bindParam(':color', $color);
                      $stmt->bindParam(':quantity', $qty);
                      $stmt->bindParam(':price', $price);
                      $stmt->bindParam(':discount', $discount);
                      $stmt->bindParam(':total', $itotal);
                      $stmt->bindParam(':addon_detail', $add_on_detail);
                      $stmt->execute();

                      if($item['item_type']=="product"){
                          $statement = $con->prepare("update product set current_stock=current_stock-$qty where id = $pid");
                          $statement->execute();
                          $t_data.="<tr><td><b>Product Name:</b>$iname<br><b>Product Size:</b>$size<br><b>Product Color:</b>$color</td>
                                <td>$qty</td>
                                <td>$price</td>
                                <td>$itotal</td>
                                </tr>";
                      }else{
                          $t_data.="<tr><td><b>Name:</b>$iname<br><b>Type:</b>$item_type<br><b>Description:</b>$item_description</td>
                                <td>$qty</td>
                                <td>$price</td>
                                <td>$itotal</td>
                                </tr>";
                      }

                  }
                  $peers1="";

                 unset($_SESSION["TransactionData"]);
                 unset($_SESSION["cart_item"]);

                  $subject = 'KSS Product Order Notification';
                  $msg1    = "Your Order has been Placed Successfully<br>Thanks for your order!<br>
                                    Your Order No. is - $payment_id <br><br>
                                    <table>
                                    <tr><th>Description</th><th>Quantity</th><th>Price</th><th>Total</th></tr>
                                    $t_data.$tble_data
                                    </table>";

                  if (send_mail(array($_SESSION["useremail"]), $subject, $msg1)) {

                  } else {

                  }

                  echo json_encode(array('success'=>true,'msg'=>'Your order has been placed successfully!','data'=>''));
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
  /*if(!defined('DONT_RUN_SAMPLES'))
      chargeCreditCard(\SampleCode\Constants::SAMPLE_AMOUNT);*/
?>
