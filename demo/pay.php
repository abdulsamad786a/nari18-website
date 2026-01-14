<?php 
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['login'])==0)
        {   
    header('location:login.php');
    }
    else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <br><br>
    <center><h1>Payment for me!!</h1></center>
    <?php

// Replace these with your actual PhonePe API credentials

$merchantId = 'M1SDDD0F6LXD'; // sandbox or test merchantId
$apiKey='7b742acd-c53d-408b-b970-3caa1a279122'; // sandbox or test APIKEY
$redirectUrl = 'http://localhost/pankaj/adjoint%20eccomerce/Online%20Shopping%20Portal%20project/ui/success_payment.php';


// $merchantId = 'PGTESTPAYUAT'; // sandbox or test merchantId
// $apiKey='099eb0cd-02cf-4e2a-8aca-3e6c6aff0399'; // sandbox or test APIKEY
// $redirectUrl = 'http://localhost/pankaj/adjoint%20eccomerce/Online%20Shopping%20Portal%20project/ui/success_payment.php';


// Set transaction details
$order_id = uniqid(); 
 if(isset($_SESSION['order_data']) && isset($_SESSION['grandtotal_data'])) {
    $order_data = $_SESSION['order_data'];
    $amount = $_SESSION['grandtotal_data'];
    $userID = $_SESSION['id'];
    // echo $userID;
    $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
    $row=mysqli_fetch_array($query);
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['contactno'];   
}

$description = 'Payment for Product/Service';
$merchantTransactionId = 'MT' . uniqid();
$merchantUserId = 'MUID' . uniqid();

$paymentData = array(
    'merchantId' => $merchantId,
    'merchantTransactionId' => $merchantTransactionId, // test transactionID
    "merchantUserId"=> $merchantUserId,
    'amount' => $amount*100,
    'redirectUrl'=>$redirectUrl,
    'redirectMode'=>"POST",
    'callbackUrl'=>$redirectUrl,
    "merchantOrderId"=>$order_id,
   "mobileNumber"=>$mobile,
   "message"=>$description,
   "email"=>$email,
   "shortName"=>$name,
   "paymentInstrument"=> array(    
    "type"=> "PAY_PAGE",
  )
);


 $jsonencode = json_encode($paymentData);
 $payloadMain = base64_encode($jsonencode);
 $salt_index = 1; //key index 1
 $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
 $sha256 = hash("sha256", $payload);
 $final_x_header = $sha256 . '###' . $salt_index;
 $request = json_encode(array('request'=>$payloadMain));
                
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.phonepe.com/apis/hermes/pg/v1/pay",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS => $request,
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
     "X-VERIFY: " . $final_x_header,
     "accept: application/json"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
   $res = json_decode($response);
 
if(isset($res->success) && $res->success=='1'){
$paymentCode=$res->code;
$paymentMsg=$res->message;
$payUrl=$res->data->instrumentResponse->redirectInfo->url;
// echo $payUrl;exit;
// header('Location:'.$payUrl); exit;
$output = shell_exec('php /path/to/your/script.php');
echo $output;
header('Location:'.$payUrl); exit;

}
}
}        
?>
</body>
</html>