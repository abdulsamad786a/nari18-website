<?php
session_start();
include('includes/config.php');

header('Content-Type: application/json');

$response = array(
    'status' => 'error',
    'msg' => 'Invalid request',
    'new_qty' => 0,
    'total_count' => 0
);

if (!empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = isset($_GET['action']) ? $_GET['action'] : 'add';

    // Initialize cart if not exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Handle Actions
    if ($action == 'add' || $action == 'increase') {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            // Fetch price for new item
            $sql_p = "SELECT productPrice FROM products WHERE id={$id}";
            $query_p = mysqli_query($con, $sql_p);
            if (mysqli_num_rows($query_p) != 0) {
                $row_p = mysqli_fetch_array($query_p);
                $_SESSION['cart'][$id] = array("quantity" => 1, "price" => $row_p['productPrice']);
            }
        }
    } elseif ($action == 'decrease') {
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']--;
            if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
    }

    // Calculate Response Data
    $new_qty = isset($_SESSION['cart'][$id]) ? $_SESSION['cart'][$id]['quantity'] : 0;

    $total_count = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total_count += $item['quantity'];
        }
    }

    $response['status'] = 'success';
    $response['msg'] = 'Cart updated';
    $response['new_qty'] = $new_qty;
    $response['total_count'] = $total_count;
}

echo json_encode($response);
?>