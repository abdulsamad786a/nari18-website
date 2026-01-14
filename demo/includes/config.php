<?php
define('DB_SERVER','localhost');
define('DB_USER','u746862318_nari18');
define('DB_PASS' ,'U746862318_nari18');
define('DB_NAME', 'u746862318_nari18');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>