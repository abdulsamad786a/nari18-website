<?php
session_start();
error_reporting(0);
include('includes/config.php');

header('Content-Type: application/json');

// Check if phone number is provided
if (!isset($_POST['phone']) || empty($_POST['phone'])) {
    echo json_encode(['success' => false, 'message' => 'Phone number is required']);
    exit();
}

$phone = $_POST['phone'];

// Validate phone number (should be 10 digits)
$phone = preg_replace('/[^0-9]/', '', $phone); // Remove all non-numeric characters

if (strlen($phone) != 10 || !is_numeric($phone)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid 10-digit phone number']);
    exit();
}

// Add country code 91 for India (2factor requires country code)
$phone_with_country = '91' . $phone;

// Build 2factor API URL for SMS OTP
// Using SMS endpoint explicitly (not VOICE)
$api_key = TWO_FACTOR_API_KEY;
$template = TWO_FACTOR_TEMPLATE;
// SMS endpoint - this should send SMS, not voice call
$api_url = "https://2factor.in/API/V1/{$api_key}/SMS/{$phone_with_country}/AUTOGEN/{$template}";

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
    echo json_encode(['success' => false, 'message' => 'Failed to connect to OTP service. Please try again. Error: ' . $curl_error]);
    exit();
}

// Check HTTP response code
if ($http_code != 200) {
    echo json_encode(['success' => false, 'message' => 'API request failed. HTTP Code: ' . $http_code]);
    exit();
}

// Parse JSON response
$result = json_decode($response, true);

// Debug: Log the response (remove in production)
error_log("2factor API Response: " . $response);
error_log("2factor API URL: " . $api_url);

if ($result && isset($result['Status']) && $result['Status'] == 'Success') {
    // Check if phone number exists in database before sending OTP
    // Since contactno is bigint, try both string and integer comparison
    $phone_clean = mysqli_real_escape_string($con, $phone);
    $phone_int = (int)$phone;
    
    // Try string comparison first
    $check_user = mysqli_query($con, "SELECT * FROM users WHERE contactno='$phone_clean'");
    $user_exists = mysqli_fetch_array($check_user);
    
    // If not found, try integer comparison
    if (!$user_exists || count($user_exists) == 0) {
        $check_user = mysqli_query($con, "SELECT * FROM users WHERE contactno=$phone_int");
        $user_exists = mysqli_fetch_array($check_user);
    }
    
    // Store Session ID and phone in session
    $_SESSION['otp_session_id'] = $result['Details'];
    $_SESSION['otp_phone'] = $phone;
    
    $message = 'OTP sent successfully to ' . $phone . '. Please check your SMS inbox.';
    if (!$user_exists) {
        $message .= ' Note: This phone number is not registered. Please register first.';
    }
    
    // Log for debugging - check if SMS was actually sent or if voice fallback occurred
    error_log("OTP sent to phone: $phone_with_country, Session ID: " . $result['Details']);
    
    echo json_encode([
        'success' => true, 
        'message' => $message,
        'session_id' => $result['Details'],
        'user_exists' => $user_exists ? true : false
    ]);
} else {
    // More detailed error message
    $error_message = 'Failed to send OTP. ';
    if (isset($result['Details'])) {
        $error_message .= $result['Details'];
    } else if (isset($result['Status'])) {
        $error_message .= 'Status: ' . $result['Status'];
    } else {
        $error_message .= 'Please check your phone number and try again.';
    }
    
    // Log error for debugging
    error_log("2factor API Error: " . $response);
    
    echo json_encode(['success' => false, 'message' => $error_message]);
}
?>

