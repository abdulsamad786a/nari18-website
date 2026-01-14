<?php
// Diagnostic script to check phone number in database
include('includes/config.php');

$test_phone = '9648482274'; // Your test phone number

echo "<h2>Phone Number Database Check</h2>";
echo "<p><strong>Testing Phone:</strong> " . $test_phone . "</p>";
echo "<hr>";

// Check if phone exists in database (as string)
$phone_clean = mysqli_real_escape_string($con, $test_phone);
$query1 = mysqli_query($con, "SELECT * FROM users WHERE contactno='$phone_clean'");
$user1 = mysqli_fetch_array($query1);

echo "<h3>1. Search as String (contactno='$phone_clean'):</h3>";
if ($user1 && count($user1) > 0) {
    echo "<p style='color: green;'>✓ Found user!</p>";
    echo "<pre>";
    echo "ID: " . $user1['id'] . "\n";
    echo "Name: " . $user1['name'] . "\n";
    echo "Email: " . $user1['email'] . "\n";
    echo "Contact No (as stored): " . $user1['contactno'] . "\n";
    echo "Contact No (type): " . gettype($user1['contactno']) . "\n";
    echo "</pre>";
} else {
    echo "<p style='color: red;'>✗ User not found</p>";
}

// Check if phone exists in database (as integer)
$phone_int = (int)$test_phone;
$query2 = mysqli_query($con, "SELECT * FROM users WHERE contactno=$phone_int");
$user2 = mysqli_fetch_array($query2);

echo "<h3>2. Search as Integer (contactno=$phone_int):</h3>";
if ($user2 && count($user2) > 0) {
    echo "<p style='color: green;'>✓ Found user!</p>";
    echo "<pre>";
    echo "ID: " . $user2['id'] . "\n";
    echo "Name: " . $user2['name'] . "\n";
    echo "Email: " . $user2['email'] . "\n";
    echo "Contact No (as stored): " . $user2['contactno'] . "\n";
    echo "</pre>";
} else {
    echo "<p style='color: red;'>✗ User not found</p>";
}

// Show all users with their contact numbers
echo "<h3>3. All Users in Database:</h3>";
$query_all = mysqli_query($con, "SELECT id, name, email, contactno FROM users LIMIT 10");
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Contact No</th><th>Type</th></tr>";
while ($row = mysqli_fetch_array($query_all)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['contactno'] . "</td>";
    echo "<td>" . gettype($row['contactno']) . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<hr>";
echo "<p><strong>Note:</strong> The phone number must match EXACTLY as stored in database for OTP login to work.</p>";
echo "<p><small>Delete this file after testing for security.</small></p>";
?>

