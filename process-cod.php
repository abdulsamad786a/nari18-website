<?php
session_start();
error_reporting(0);
include('includes/config.php');

// Check if user is logged in
if (strlen($_SESSION['login']) == 0) {
    header('location:login.php');
    exit;
}

// Check if order data exists
if (!isset($_SESSION['order_data']) || !isset($_SESSION['grandtotal_data'])) {
    $_SESSION['cart_notification'] = ['title' => 'Order Data Missing', 'message' => 'Order data is missing. Please try adding items to cart again.'];
    header('location:my-cart.php');
    exit;
}

$order_data = $_SESSION['order_data'];
$grandtotal = $_SESSION['grandtotal_data'];
$userId = $_SESSION['id'];

// Debug: Log order data for troubleshooting (remove in production)
if (empty($order_data)) {
    $_SESSION['cart_notification'] = ['title' => 'Empty Cart', 'message' => 'Your cart appears to be empty. Please add items before placing an order.'];
    header('location:my-cart.php');
    exit;
}

// Get user details
$userQuery = mysqli_query($con, "SELECT * FROM users WHERE id='" . $userId . "'");
$user = mysqli_fetch_array($userQuery);

// Check if shipping address is set
if (empty($user['shippingAddress']) || empty($user['shippingCity']) || empty($user['shippingState']) || empty($user['shippingPincode'])) {
    $_SESSION['cart_notification'] = ['title' => 'Address Required', 'message' => 'Please update your shipping address before placing a COD order.'];
    header('location:my-cart.php');
    exit;
}

// Insert orders into database
$orderSuccess = false;
$orderDate = date('Y-m-d H:i:s');
$errorMessages = array();
$successfulInserts = 0;

// Validate order_data
if (empty($order_data) || !is_array($order_data)) {
    $_SESSION['cart_notification'] = ['title' => 'Order Error', 'message' => 'No items in cart. Please add items to your cart before placing an order.'];
    header('location:my-cart.php');
    exit;
}

foreach ($order_data as $productId => $quantity) {
    $productId = intval($productId);
    $quantity = intval($quantity);
    
    // Validate product ID and quantity
    if ($productId <= 0 || $quantity <= 0) {
        $errorMessages[] = "Invalid product ID or quantity: Product ID=$productId, Quantity=$quantity";
        continue;
    }

    // Insert order with paymentMethod = 'COD'
    // Note: productId can be varchar in some databases, but we'll use the integer value
    $sql = "INSERT INTO orders (userId, productId, quantity, paymentMethod, orderDate, orderStatus) 
            VALUES ('" . mysqli_real_escape_string($con, $userId) . "', 
                    '" . mysqli_real_escape_string($con, $productId) . "', 
                    '" . mysqli_real_escape_string($con, $quantity) . "', 
                    'COD', 
                    '" . mysqli_real_escape_string($con, $orderDate) . "', 
                    'Pending')";

    $result = mysqli_query($con, $sql);

    if ($result) {
        $successfulInserts++;
        $orderSuccess = true;
    } else {
        $errorMessages[] = "Failed to insert order for Product ID $productId: " . mysqli_error($con);
    }
}

// Ensure at least one order was successfully inserted
if ($orderSuccess && $successfulInserts > 0 && empty($errorMessages)) {
    // Clear cart
    unset($_SESSION['cart']);
    unset($_SESSION['order_data']);
    unset($_SESSION['qnty']);
    unset($_SESSION['tp']);
    unset($_SESSION['pid']);

    // Redirect to success page
    header('location:payment_status.php?status=success&method=cod');
    exit;
} else {
    // Order failed - log errors if needed
    $errorMsg = !empty($errorMessages) ? implode('; ', $errorMessages) : 'Unknown error occurred. No orders were inserted.';
    
    // If some orders were inserted but others failed, clear cart anyway
    if ($successfulInserts > 0) {
        // Some orders succeeded - clear cart but show warning
        unset($_SESSION['cart']);
        $_SESSION['cart_notification'] = ['title' => 'Partial Order Success', 'message' => "Order placed, but some items may have failed: $errorMsg"];
    } else {
        // No orders succeeded - keep cart
        $_SESSION['cart_notification'] = ['title' => 'Order Failed', 'message' => 'Failed to place order. Please try again.'];
    }
    
    error_log("COD Order Failed for User ID: $userId. Successful Inserts: $successfulInserts. Errors: $errorMsg");
    header('location:my-cart.php');
    exit;
}
?>