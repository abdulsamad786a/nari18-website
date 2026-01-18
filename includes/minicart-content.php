<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('includes/config.php'); 

if (!empty($_SESSION['cart'])) {
    ?>
    <div class="minicart-header">
        <button class="close-cart border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icon anm anm-times-r"
                data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></button>
        <h4 class="fs-6">Your cart (
            <?php echo $_SESSION['qnty']; ?> Items)
        </h4>
    </div>
    <div class="minicart-content">
        <ul class="m-0 clearfix">
            <?php
            $sql = "SELECT * FROM products WHERE id IN(";
            foreach ($_SESSION['cart'] as $id => $value) {
                $sql .= $id . ",";
            }
            $sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
            $query = mysqli_query($con, $sql);
            $totalprice = 0;
            $totalqunty = 0;
            if (!empty($query)) {
                while ($row = mysqli_fetch_array($query)) {
                    $quantity = $_SESSION['cart'][$row['id']]['quantity'];
                    $subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'];
                    $totalprice += $subtotal;
                    $_SESSION['qnty'] = $totalqunty += $quantity;
                    ?>
                    <li class="item d-flex justify-content-center align-items-center">
                        <a class="product-image rounded-3" href="product-details.php?pid=<?php echo $row['id']; ?>">
                            <img class="blur-up lazyload"
                                data-src="admin/productimages/<?php echo $row['id']; ?>/<?php echo $row['productImage1']; ?>"
                                alt="product" title="Product" width="120" height="170" />
                        </a>
                        <div class="product-details">
                            <a class="product-title" href="product-details.php?pid=<?php echo $row['id']; ?>">
                                <?php echo $row['productName']; ?>
                            </a>
                            <div class="priceRow">
                                <div class="product-price">
                                    <strong> RS - <span class="price">
                                            <?php echo ($row['productPrice'] + $row['shippingCharge']); ?>*
                                            <?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>
                                        </span></strong>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php }
            } ?>
        </ul>
    </div>
    <div class="minicart-bottom">
        <div class="subtotal clearfix my-3">
            <div class="totalInfo clearfix"><span>Total:</span><span class="item product-price">
                    <?php echo $_SESSION['tp'] = "$totalprice" . ".00"; ?>
                </span></div>
        </div>
        <div class="minicart-action d-flex mt-3">
            <a href="index.php" class="proceed-to-checkout btn btn-primary w-50 me-1 minicart-continue-btn"><span
                    class="btn-text">Continue Shopping</span></a>
            <a href="my-cart.php" class="cart-btn btn btn-secondary w-50 ms-1">View Cart</a>
        </div>
    </div>
<?php } else { ?>
    <div id="cartEmpty" class="cartEmpty d-flex-justify-center flex-column text-center p-3 text-muted ">
        <div class="cartEmpty-content mt-4">
            <i class="icon anm anm-cart-l fs-1 text-muted"></i>
            <p class="my-3">No Products in the Cart</p>
            <a href="index.php" class="btn btn-primary cart-btn minicart-continue-btn"><span class="btn-text">Continue
                    shopping</span></a>
        </div>
    </div>
<?php } ?>