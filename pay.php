<?php 
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['login'])==0){
    header('location:login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Razorpay Payment</title>
</head>

<body>

<?php

// -------------------------------
// Razorpay LIVE Keys
// -------------------------------
$keyId     = "rzp_live_RjF57WHZ2PhoqJ";
$keySecret = "DiOLOeJFBiWSjHGhu2KMBdAE";

$order_id = uniqid(); 

if(isset($_SESSION['grandtotal_data'])) {
    $amount = $_SESSION['grandtotal_data'];  // INR
    $amount_paisa = $amount * 100;           // Razorpay paisa me leta hai

    $query = mysqli_query($con, "SELECT * FROM users WHERE id='".$_SESSION['id']."'");
    $row = mysqli_fetch_array($query);

    $name   = $row['name'];
    $email  = $row['email'];
    $mobile = $row['contactno'];
}

// -----------------------------
// 1) Razorpay Order Create API
// -----------------------------
$url = "https://api.razorpay.com/v1/orders";

$fields = array(
    "amount" => $amount_paisa,
    "currency" => "INR",
    "receipt" => $order_id,
    "payment_capture" => 1
);

$fields_string = json_encode($fields);

// cURL Request
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $keyId . ":" . $keySecret);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$response = curl_exec($ch);
$orderData = json_decode($response, true);

$razorpayOrderId = $orderData['id'];

?>

<!-- -------------------------------
Razorpay Checkout Script
-------------------------------- -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
var options = {
    "key": "<?php echo $keyId; ?>",
    "amount": "<?php echo $amount_paisa; ?>",
    "currency": "INR",
    "name": "<?php echo $name; ?>",
    "description": "Order Payment",
    "order_id": "<?php echo $razorpayOrderId; ?>",
    "handler": function (response){
        window.location.href = "payment_status.php?payment_id=" + response.razorpay_payment_id 
                               + "&order_id=<?php echo $razorpayOrderId; ?>&status=success";
    },
    "prefill": {
        "name": "<?php echo $name; ?>",
        "email": "<?php echo $email; ?>",
        "contact": "<?php echo $mobile; ?>"
    },
    "theme": {
        "color": "#3399cc"
    }
};

// Add modal close handler for failed payments
options.modal = {
    ondismiss: function() {
        // Redirect to failed payment page when user closes the modal without payment
        window.location.href = "payment_status.php?status=failed";
    }
};

var rzp1 = new Razorpay(options);
rzp1.open();
</script>

</body>
</html>
