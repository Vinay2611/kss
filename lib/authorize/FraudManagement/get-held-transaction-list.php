<?php
  require 'vendor/autoload.php';
  use net\authorize\api\contract\v1 as AnetAPI;
  use net\authorize\api\controller as AnetController;
  
  define("AUTHORIZENET_LOG_FILE", "phplog");

  function getHeldTransactionList() {
    // Common Set Up for API Credentials
    $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
    $merchantAuthentication->setName(\SampleCode\Constants::MERCHANT_LOGIN_ID);
    $merchantAuthentication->setTransactionKey(\SampleCode\Constants::MERCHANT_TRANSACTION_KEY);

    $refId = 'ref' . time();


    $request = new AnetAPI\GetUnsettledTransactionListRequest();
    $request->setMerchantAuthentication($merchantAuthentication);
    $request->setStatus("pendingApproval");


    $controller = new AnetController\GetUnsettledTransactionListController($request);

    $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

    if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
    {
		if(null != $response->getTransactions())
		{
			foreach($response->getTransactions() as $tx)
			{
			  echo "SUCCESS: TransactionID: " . $tx->getTransId() . "\n";
			}
        }
		else{
			echo "No suspicious transactions for the merchant." . "\n";
		}
    }
    else
    {
        echo "ERROR :  Invalid response\n";
        $errorMessages = $response->getMessages()->getMessage();
        echo "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText() . "\n";
    }

    return $response;
  }

  if(!defined('DONT_RUN_SAMPLES'))
    getHeldTransactions();

?>
