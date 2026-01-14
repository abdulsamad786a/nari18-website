<?php
// Test file to debug 2factor API
// Access this file directly in browser to test API call

include('includes/config.php');

// Test phone number - change this to your phone number
$test_phone = '9648482274'; // Your test phone number

// Add country code
$phone_with_country = '91' . $test_phone;

// Build API URL
$api_key = TWO_FACTOR_API_KEY;
$template = TWO_FACTOR_TEMPLATE;
$api_url = "https://2factor.in/API/V1/{$api_key}/SMS/{$phone_with_country}/AUTOGEN/{$template}";

echo "<h2>2factor API Test</h2>";
echo "<p><strong>API URL:</strong> " . htmlspecialchars($api_url) . "</p>";
echo "<p><strong>Phone Number (with country code):</strong> " . $phone_with_country . "</p>";
echo "<p><strong>Template:</strong> " . $template . "</p>";
echo "<hr>";

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

echo "<h3>Response Details:</h3>";
echo "<p><strong>HTTP Code:</strong> " . $http_code . "</p>";

if ($curl_error) {
    echo "<p style='color: red;'><strong>cURL Error:</strong> " . $curl_error . "</p>";
} else {
    echo "<p style='color: green;'><strong>cURL:</strong> No errors</p>";
}

echo "<p><strong>Raw Response:</strong></p>";
echo "<pre>" . htmlspecialchars($response) . "</pre>";

// Parse JSON response
$result = json_decode($response, true);

echo "<h3>Parsed Response:</h3>";
if ($result) {
    echo "<pre>";
    print_r($result);
    echo "</pre>";
    
    if (isset($result['Status']) && $result['Status'] == 'Success') {
        echo "<p style='color: green;'><strong>✓ Success!</strong> Session ID: " . $result['Details'] . "</p>";
        echo "<p>Check your phone (" . $test_phone . ") for the OTP message.</p>";
    } else {
        echo "<p style='color: red;'><strong>✗ Failed</strong></p>";
        if (isset($result['Details'])) {
            echo "<p><strong>Error:</strong> " . $result['Details'] . "</p>";
        }
    }
} else {
    echo "<p style='color: red;'>Failed to parse JSON response</p>";
}

echo "<hr>";
echo "<p><small>Note: Delete this file after testing for security.</small></p>";
?>

