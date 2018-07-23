<?php
	/*
		* Contains call to create payment object and receive Approval URL to which user is then redirected to.
	*/
	if (session_id() == "")
		session_start();

	include('utilFunctions.php');
	include('paypalFunctions.php');
    include_once "../db_con.php";
	$access_token = getAccessToken();

	$_SESSION['access_token'] = $access_token;
        $hostName = $_SERVER['HTTP_HOST'];
        $appName = explode("/", $_SERVER['REQUEST_URI'])[1];
        $cancelUrl= "http://".$hostName."/".$appName."/cancel.php";
        $payUrl = "http://".$hostName."/".$appName."/pay.php";

	if(verify_nonce()){
		if(isset($_POST['markFlow']) && $_POST['markFlow'] == "true"){ //Proceed to Checkout or Mark flow
            $sub_total=$_SESSION["TransactionData"]["SubTotal"];
            $tax_total=$_SESSION["TransactionData"]["total_tax"];
            $shipping_total=(float)$_POST['shipping_method'];
            $total=$sub_total+$shipping_total+$tax_total;
            $cartitems_old=$_SESSION["TransactionData"]["cart_items"];
            $cartitems=array();
            $i=0;
            foreach ($cartitems_old as $cr){
                $cartitems[$i]['name']=$cr['name'];
                $cartitems[$i]['quantity']=$cr['quantity'];
                $cartitems[$i]['price']=$cr['common_price'];
                $cartitems[$i]['sku']='1';
                $cartitems[$i]['currency']='USD';
                $i++;
            }
            $markFlowArray = '{
                           "intent":"sale",
                           "payer":{
                              "payment_method":"paypal"
                           },
                           "transactions":[
                              {
                                 "amount":{
                                    "currency":"USD",
                                    "total":"'.$total.'",
                                    "details":{
                                       "shipping":"'.$shipping_total.'",
									   "subtotal":"'.$sub_total.'",
									   "tax":"'.$tax_total.'",
									   "insurance":"0",
									   "handling_fee":"0",
									   "shipping_discount":"0"
                                    }
                                 },
                                 "description":"Payment For Kss Store Product",
                                 "custom":"pkdheer",
                                 "item_list":{                                    
                                 }
                              }
                           ],
                           "redirect_urls":{
                              "return_url":"'.$payUrl.'",
                              "cancel_url":"'.$cancelUrl.'"
                           }
                        }';
            $markFlowArray = json_decode($markFlowArray, true);

            $markFlowArray['transactions'][0]['amount']['details']['shipping'] = $_POST['shipping_method'];
            $markFlowArray['transactions'][0]['item_list']['shipping_address']['recipient_name'] =  filter_input( INPUT_POST, 'recipient_name', FILTER_SANITIZE_SPECIAL_CHARS );
            $markFlowArray['transactions'][0]['item_list']['shipping_address']['line1'] =  filter_input( INPUT_POST, 'line1', FILTER_SANITIZE_SPECIAL_CHARS );
            $markFlowArray['transactions'][0]['item_list']['shipping_address']['line2'] =  filter_input( INPUT_POST, 'line2', FILTER_SANITIZE_SPECIAL_CHARS );
            $markFlowArray['transactions'][0]['item_list']['shipping_address']['city'] =  filter_input( INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS );
            $markFlowArray['transactions'][0]['item_list']['shipping_address']['country_code'] =  'US';
            $markFlowArray['transactions'][0]['item_list']['shipping_address']['postal_code'] =  filter_input( INPUT_POST, 'postal_code', FILTER_SANITIZE_SPECIAL_CHARS );
            $markFlowArray['transactions'][0]['item_list']['shipping_address']['state'] =  filter_input( INPUT_POST, 'state', FILTER_SANITIZE_SPECIAL_CHARS );
            $markFlowArray['transactions'][0]['item_list']['items']=$cartitems;


            $markFlowJson = json_encode($markFlowArray);
            $approval_url=getApprovalURL($access_token, $markFlowJson);
            if($approval_url=="Invalid"){
                echo "Please Provide Valid State,City and Zip Code!";
                die;
            }else{
                $url = $approval_url;
                $query_str = parse_url($url, PHP_URL_QUERY);
                parse_str($query_str, $query_params);
                $token=$query_params['token'];
                $product_detail=json_encode($_SESSION['TransactionData']['cart_items']);
                $full_detail=json_encode(json_decode($markFlowJson)->transactions[0]);
                //print_r(json_decode($markFlowJson)->transactions[0]->item_list->items);
                $shipping_add=json_encode(json_decode($markFlowJson)->transactions[0]->item_list->shipping_address);

                $total=json_decode($markFlowJson)->transactions[0]->amount->total;
                $shipping=json_decode($markFlowJson)->transactions[0]->amount->details->shipping;
                $subtotal=json_decode($markFlowJson)->transactions[0]->amount->details->subtotal;
                $tax=json_decode($markFlowJson)->transactions[0]->amount->details->tax;
                $record_date=date('Y-m-d H:i:s');

                $user_id= $_SESSION['loggedId'];

                $stmt = $con->prepare("INSERT INTO transactions (user_id,gateway,token,product_detail,full_detail,shipping_address,billing_address,tax,shipping,sub_total,total,payment_status,entry_date,delivery_status,viewed,status,description,payment_id,payer_id) 
                VALUES ('$user_id','Paypal','$token','$product_detail','$full_detail','$shipping_add','','$tax','$shipping','$subtotal','$total','Pending','$record_date','','0','1','','','')");
                $stmt->execute();


                $approval_url = $approval_url. "&useraction=commit";
            }

        	} else { //Express checkout flow

        	}
        	//redirect user to the Approval URL
        	header("Location:".$approval_url);
	}else {
		 die('Session expired');
	}

?>