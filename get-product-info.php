<?php
session_start();
error_reporting(0);
include('includes/config.php');

header('Content-Type: application/json');

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT id, productName, productPrice, productImage1 FROM products WHERE id = {$id}";
    $query = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        echo json_encode(array(
            'success' => true,
            'data' => array(
                'id' => $row['id'],
                'name' => $row['productName'],
                'price' => $row['productPrice'],
                'image' => $row['productImage1']
            )
        ));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Product not found'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Product ID required'));
}
?>

