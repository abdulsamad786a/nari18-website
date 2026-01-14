<?php
session_start();
error_reporting(0);
include('includes/config.php');

header('Content-Type: application/json');

// Check if OTP is provided
if (!isset($_POST['otp']) || empty($_POST['otp'])) {
    echo json_encode(['success' => false, 'message' => 'OTP is required']);
    exit();
}

// Check if session ID exists
if (!isset($_SESSION['otp_session_id']) || empty($_SESSION['otp_session_id'])) {
    echo json_encode(['success' => false, 'message' => 'OTP session expired. Please request a new OTP.']);
    exit();
}

// Check if phone number exists in session
if (!isset($_SESSION['otp_phone']) || empty($_SESSION['otp_phone'])) {
    echo json_encode(['success' => false, 'message' => 'Phone number not found. Please request a new OTP.']);
    exit();
}

$otp = preg_replace('/[^0-9]/', '', $_POST['otp']); // Remove all non-numeric characters
$session_id = $_SESSION['otp_session_id'];
$phone = $_SESSION['otp_phone'];

// Validate OTP format (should be numeric)
if (empty($otp) || !is_numeric($otp)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid OTP']);
    exit();
}

// Build 2factor Verify API URL
$api_key = TWO_FACTOR_API_KEY;
$api_url = "https://2factor.in/API/V1/{$api_key}/SMS/VERIFY/{$session_id}/{$otp}";

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

// Execute API call
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

// Check for cURL errors
if ($curl_error) {
    echo json_encode(['success' => false, 'message' => 'Failed to verify OTP. Please try again.']);
    exit();
}

// Parse JSON response
$result = json_decode($response, true);

if ($result && isset($result['Status']) && $result['Status'] == 'Success') {
    // OTP verified successfully, now check if user exists in database
    // Since contactno is bigint, try both string and integer comparison
    $phone_clean = mysqli_real_escape_string($con, $phone);
    $phone_int = (int)$phone; // Convert to integer for bigint comparison
    
    // Try string comparison first
    $query = mysqli_query($con, "SELECT * FROM users WHERE contactno='$phone_clean'");
    $user = mysqli_fetch_array($query);
    
    // If not found, try integer comparison
    if (!$user || count($user) == 0) {
        $query = mysqli_query($con, "SELECT * FROM users WHERE contactno=$phone_int");
        $user = mysqli_fetch_array($query);
    }
    
    if ($user && count($user) > 0) {
        // User found, create login session
        $_SESSION['login'] = $user['email'];
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        
        // Log user login
        $uip = $_SERVER['REMOTE_ADDR'];
        $status = 1;
        $log = mysqli_query($con, "INSERT INTO userlog(userEmail, userip, status) VALUES('".$user['email']."', '$uip', '$status')");
        
        // Clear OTP session variables
        unset($_SESSION['otp_session_id']);
        unset($_SESSION['otp_phone']);
        
        echo json_encode([
            'success' => true, 
            'message' => 'Login successful!',
            'redirect' => 'index.php'
        ]);
    } else {
        // User not found in database
        unset($_SESSION['otp_session_id']);
        unset($_SESSION['otp_phone']);
        echo json_encode(['success' => false, 'message' => 'Phone number not registered. Please register first.']);
    }
} else {
    // OTP verification failed
    $error_message = isset($result['Details']) ? $result['Details'] : 'Invalid or expired OTP. Please try again.';
    
    // Check if OTP expired
    if (isset($result['Details']) && strpos($result['Details'], 'Expired') !== false) {
        unset($_SESSION['otp_session_id']);
        unset($_SESSION['otp_phone']);
    }
    
    echo json_encode(['success' => false, 'message' => $error_message]);
}
?>

