<?php
session_start();
error_reporting(0);
include('includes/config.php');

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT id, category, subCategory, productName, productPrice, productPriceBeforeDiscount, productDescription, productImage1, productImage2, productImage3, productAvailability, shippingCharge FROM products WHERE id = {$id}";
    $query = mysqli_query($con, $sql);

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_array($query);
        echo json_encode(array(
            'success' => true,
            'data' => array(
                'id' => $row['id'],
                'name' => $row['productName'],
                'price' => $row['productPrice'],
                'priceBefore' => $row['productPriceBeforeDiscount'],
                'description' => $row['productDescription'],
                'image' => $row['productImage1'],
                'images' => array_filter([$row['productImage1'], $row['productImage2'], $row['productImage3']]),
                'availability' => $row['productAvailability'],
                'shipping' => $row['shippingCharge'],
                'category' => $row['category'],
                'subCategory' => $row['subCategory']
            )
        ));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Product not found'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Product ID required'));
}
?>