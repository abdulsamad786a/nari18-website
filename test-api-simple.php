<?php
// Simple API test - just test the API call without dependencies
$api_key = '37380a45-d1bd-11f0-a6b2-0200cd936042';
$phone = '919648482274'; // Your phone with country code
$template = 'LoginOTP';
$api_url = "https://2factor.in/API/V1/{$api_key}/SMS/{$phone}/AUTOGEN/{$template}";

echo "Testing 2factor API...<br>";
echo "URL: " . $api_url . "<br><br>";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Code: " . $http_code . "<br>";
echo "Response: " . $response . "<br>";

if ($error) {
    echo "Error: " . $error . "<br>";
}

$result = json_decode($response, true);
if ($result && $result['Status'] == 'Success') {
    echo "<br><strong style='color:green;'>SUCCESS! Check your phone for OTP.</strong>";
} else {
    echo "<br><strong style='color:red;'>FAILED: " . (isset($result['Details']) ? $result['Details'] : 'Unknown error') . "</strong>";
}
?>

