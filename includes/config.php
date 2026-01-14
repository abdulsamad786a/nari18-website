<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'u746862318_nari18');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// 2factor.in API Configuration
define('TWO_FACTOR_API_KEY', '37380a45-d1bd-11f0-a6b2-0200cd936042');
define('TWO_FACTOR_TEMPLATE', 'LoginOTP');
?>