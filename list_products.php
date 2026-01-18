<?php
include('includes/config.php');
$query = mysqli_query($con, "SELECT id, productName FROM products ORDER BY id DESC LIMIT 20");
while ($row = mysqli_fetch_array($query)) {
    echo "ID: " . $row['id'] . " - Name: " . $row['productName'] . "\n";
}
?>