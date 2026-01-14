<?php
// success_payment.php or payment_status.php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['login'])==0){
    header('location:login.php');
    exit;
}

// Get payment status from URL or session
$status = isset($_GET['status']) ? $_GET['status'] : 'success';
$payment_id = isset($_GET['payment_id']) ? $_GET['payment_id'] : '';
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

// Set messages based on status
if($status == 'success') {
    $title = "Payment Successful!";
    $icon = "✓";
    $message = "Thank you for your payment! Your order has been confirmed.";
    $sub_message = "We've received your payment of ₹" . (isset($_SESSION['grandtotal_data']) ? $_SESSION['grandtotal_data'] : '') . " successfully.";
    $btn_text = "Continue Shopping";
    $btn_link = "index.php";
    $btn_class = "btn-success";
    $alert_class = "alert-success";
} else {
    $title = "Payment Failed";
    $icon = "✗";
    $message = "Oops! Something went wrong with your payment.";
    $sub_message = "Your payment could not be processed. Please try again or contact support if the issue persists.";
    $btn_text = "Try Again";
    $btn_link = "pay.php";
    $btn_class = "btn-danger";
    $alert_class = "alert-danger";
}
?>

<?php include 'header.php'?>

            <!-- Body Container -->
            <div id="page-content"> 
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                <div class="page-title"><h1>Payment Status</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.php" title="Back to the home page">Home</a><span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i>Payment Status</span></div>
                                <!--End Breadcrumbs-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container payment-status">
                    <div class="row justify-content-center my-5">
                        <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                            <!-- Payment Status Card -->
                            <div class="card shadow border-0">
                                <div class="card-body text-center p-5">
                                    <!-- Status Icon -->
                                    <div class="status-icon mb-4">
                                        <div class="icon-circle <?php echo $alert_class; ?> d-inline-flex align-items-center justify-content-center rounded-circle">
                                            <span class="display-1 fw-bold"><?php echo $icon; ?></span>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Title -->
                                    <h2 class="card-title mb-3 <?php echo $status == 'success' ? 'text-success' : 'text-danger'; ?>">
                                        <?php echo $title; ?>
                                    </h2>
                                    
                                    <!-- Status Message -->
                                    <p class="card-text fs-5 mb-4">
                                        <?php echo $message; ?>
                                    </p>
                                    
                                    <!-- Additional Details -->
                                    <div class="alert <?php echo $alert_class; ?> bg-light border-0 mb-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <p class="mb-2"><?php echo $sub_message; ?></p>
                                            <?php if($status == 'success' && $payment_id): ?>
                                            <div class="payment-details mt-3 p-3 bg-white rounded w-100">
                                                <h6 class="text-muted mb-3">Payment Details</h6>
                                                <div class="row text-start">
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Payment ID</small>
                                                        <p class="mb-2 fw-bold"><?php echo substr($payment_id, 0, 12) . '...'; ?></p>
                                                    </div>
                                                    <div class="col-6">
                                                        <small class="text-muted d-block">Order ID</small>
                                                        <p class="mb-2 fw-bold"><?php echo $order_id; ?></p>
                                                    </div>
                                                    <?php if(isset($_SESSION['grandtotal_data'])): ?>
                                                    <div class="col-12">
                                                        <small class="text-muted d-block">Amount Paid</small>
                                                        <p class="mb-0 fs-5 fw-bold text-success">₹ <?php echo $_SESSION['grandtotal_data']; ?></p>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
                                        <a href="<?php echo $btn_link; ?>" class="btn <?php echo $btn_class; ?> btn-lg px-5">
                                            <i class="icon anm anm-arrow-right me-2"></i><?php echo $btn_text; ?>
                                        </a>
                                        <?php if($status == 'success'): ?>
                                        <a href="order-history.php" class="btn btn-outline-secondary btn-lg px-5">
                                            <i class="icon anm anm-history me-2"></i>View Orders
                                        </a>
                                        <?php else: ?>
                                        <a href="contact-us.php" class="btn btn-outline-secondary btn-lg px-5">
                                            <i class="icon anm anm-phone me-2"></i>Contact Support
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Additional Info -->
                                    <div class="mt-5 pt-3 border-top">
                                        <?php if($status == 'success'): ?>
                                        <p class="text-muted mb-2">
                                            <i class="icon anm anm-envelope-l me-2"></i>A confirmation email has been sent to your registered email address.
                                        </p>
                                        <p class="text-muted mb-0">
                                            <i class="icon anm anm-clock me-2"></i>Your order will be processed within 24 hours.
                                        </p>
                                        <?php else: ?>
                                        <p class="text-muted mb-2">
                                            <i class="icon anm anm-info-circle me-2"></i>If money was deducted from your account, it will be refunded within 5-7 business days.
                                        </p>
                                        <p class="text-muted mb-0">
                                            <i class="icon anm anm-exclamation-triangle me-2"></i>Please ensure your card details and internet connection are correct.
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <!-- End Payment Status Card -->
                            
                           
                        </div>
                    </div>
                </div>
                <!--End Main Content-->
            </div>
            <!-- End Body Container -->

<style>
/* Custom Styles for Payment Status Page */
.payment-status .icon-circle {
    width: 120px;
    height: 120px;
    margin: 0 auto;
}

.payment-status .alert-success {
    color: #0f5132;
    background-color: #d1e7dd;
    border-color: #badbcc;
}

.payment-status .alert-danger {
    color: #842029;
    background-color: #f8d7da;
    border-color: #f5c2c7;
}

.payment-status .icon-circle.alert-success {
    background-color: #d1e7dd;
    color: #0f5132;
}

.payment-status .icon-circle.alert-danger {
    background-color: #f8d7da;
    color: #842029;
}

.payment-status .payment-details {
    border: 1px solid #dee2e6;
}

.payment-status .btn-lg {
    padding: 12px 30px;
    font-weight: 600;
}

.payment-status .hover-shadow {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.payment-status .hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.payment-status .icon-lg {
    font-size: 24px;
}
</style>

<?php include 'footer.php';?>