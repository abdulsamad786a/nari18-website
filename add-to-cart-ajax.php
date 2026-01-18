<?php
session_start();
include('includes/config.php');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $qty = isset($_POST['qty']) ? intval($_POST['qty']) : 1;
    if ($qty < 1)
        $qty = 1;

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $qty;
    } else {
        $sql_p = "SELECT * FROM products WHERE id={$id}";
        $query_p = mysqli_query($con, $sql_p);
        if (mysqli_num_rows($query_p) != 0) {
            $row_p = mysqli_fetch_array($query_p);
            $_SESSION['cart'][$row_p['id']] = array("quantity" => $qty, "price" => $row_p['productPrice']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid product ID']);
            exit;
        }
    }

    // Calculate new count
    $totalCount = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $totalCount += $item['quantity'];
        }
    }
    $_SESSION['qnty'] = $totalCount;

    echo json_encode(['status' => 'success', 'count' => $totalCount]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No product ID provided']);
}
?>