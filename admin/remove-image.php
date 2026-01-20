<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $id = intval($_GET['id']);
    $img_column = $_GET['img']; // 'productImage1', 'productImage2', or 'productImage3'

    // Validate column name to prevent SQL injection
    $allowed_columns = ['productImage1', 'productImage2', 'productImage3'];
    if (!in_array($img_column, $allowed_columns)) {
        $_SESSION['error'] = "Invalid image identifier";
        header('location:edit-products.php?id=' . $id);
        exit();
    }

    // Get the image file name
    $query = mysqli_query($con, "SELECT $img_column FROM products WHERE id='$id'");
    $row = mysqli_fetch_array($query);
    $image_file = $row[$img_column];

    if ($image_file) {
        // Remove from folder
        $file_path = "productimages/$id/$image_file";
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Remove from database
        $sql = mysqli_query($con, "UPDATE products SET $img_column='' WHERE id='$id'");

        if ($sql) {
            $_SESSION['msg'] = "Image Removed Successfully !!";
        } else {
            $_SESSION['error'] = "Error removing image from database";
        }
    } else {
        $_SESSION['error'] = "No image found to remove";
    }

    header('location:edit-products.php?id=' . $id);
}
?>