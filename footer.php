<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    /* ============================================
       PREMIUM FOOTER DESIGN - CLEAN & PROFESSIONAL
       ============================================ */
    
    .footer {
        background: #1a4d5e;
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    .footer::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px),
            linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px);
        background-size: 50px 50px;
        pointer-events: none;
        opacity: 0.3;
    }

    /* Footer Top Section */
    .footer-top {
        padding: 60px 0 40px;
        position: relative;
        z-index: 1;
    }

    .footer-top .h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 22px;
        text-transform: uppercase;
        letter-spacing: 1.2px;
        position: relative;
        padding-bottom: 12px;
    }

    .footer-top .h4::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: #4ecdc4;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links ul li {
        margin-bottom: 10px;
    }

    .footer-links ul li a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .footer-links ul li a:hover {
        color: #a8e6cf;
        padding-left: 5px;
    }

    /* Contact Section */
    .footer-contact p {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.9rem;
        margin-bottom: 16px;
        display: flex;
        align-items: flex-start;
        line-height: 1.7;
    }

    .footer-contact p i {
        font-size: 1.1rem;
        color: #4ecdc4;
        margin-right: 12px;
        margin-top: 3px;
        min-width: 18px;
        flex-shrink: 0;
    }

    .footer-contact a {
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .footer-contact a:hover {
        color: #a8e6cf;
    }

    /* Social Icons */
    .social-icons {
        margin-top: 20px;
        padding: 0;
        list-style: none;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .social-icons li {
        margin: 0;
    }

    .social-icons li a {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: #ffffff;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .social-icons li a:hover {
        background: #4ecdc4;
        border-color: #4ecdc4;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(78, 205, 196, 0.3);
    }

    .social-icons li a i {
        font-size: 1.1rem;
    }

    /* Footer Bottom */
    .footer-bottom {
        padding: 25px 0;
        background: rgba(0, 0, 0, 0.2);
        border-top: 1px solid rgba(255, 255, 255, 0.08);
        position: relative;
        z-index: 1;
    }

    .copytext {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
        margin: 0;
    }

    .payment-icons {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 12px;
        align-items: center;
        flex-wrap: wrap;
    }

    .payment-icons li {
        margin: 0;
    }

    .payment-icons li i {
        font-size: 2.2rem;
        color: rgba(255, 255, 255, 0.8);
        transition: all 0.2s ease;
        filter: brightness(1.1);
    }

    .payment-icons li:hover i {
        opacity: 1;
        transform: scale(1.1);
        filter: brightness(1.3);
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .footer-top {
            padding: 50px 0 35px;
        }

        .footer-top .h4 {
            font-size: 1rem;
            margin-bottom: 18px;
        }
    }

    @media (max-width: 768px) {
    }

    @media (max-width: 576px) {
        .footer-top {
            padding: 40px 0 30px;
        }

        .footer-bottom {
            text-align: center;
        }

        .footer-bottom .d-flex {
            flex-direction: column;
            gap: 15px;
        }

        .payment-icons {
            justify-content: center;
        }

        .social-icons {
            justify-content: center;
        }
    }
</style>
<!-- Custom Stitching Section -->
<?php include 'footer-stitching.php'; ?>

<!--Footer-->
<div class="footer">
    <!-- Footer Top Section -->
    <div class="footer-top clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 footer-links mb-4 mb-md-0">
                    <h4 class="h4">INFORMATIONS</h4>
                    <ul>
                        <li><a href="my-account.php">My Account</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="my-wishlist.php">Wishlist</a></li>
                        <li><a href="my-cart.php">My Cart</a></li>
                    </ul>
                </div>

                <div class="col-12 col-sm-12 col-md-4 col-lg-4 footer-links mb-4 mb-md-0">
                    <h4 class="h4">CUSTOMER SERVICES</h4>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="terms-and-condition.php">Terms And Condition</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>

                <div class="col-12 col-sm-12 col-md-4 col-lg-4 footer-contact">
                    <h4 class="h4">CONTACT US</h4>
                    <p class="address">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Shop no 119-120, First Floor, SS Omnia, Sector 86, Gurugram, Haryana 122004</span>
                    </p>
                    <p class="phone">
                        <i class="fas fa-phone-alt"></i>
                        <a href="tel:8826446755">+91-8826446755</a>
                    </p>
                    <p class="email">
                        <i class="fas fa-envelope"></i>
                        <span>
                            <a href="mailto:Info@nari18.com">Info@nari18.com</a>, 
                            <a href="mailto:richa@nari18.com">richa@nari18.com</a>
                        </span>
                    </p>
                    <ul class="social-icons">
                        <li>
                            <a href="https://www.facebook.com/share/17CuUJyWF9/" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/richa_nari18?igsh=cGt3dDU2MGVheHZs&utm_source=qr" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom Section -->
    <div class="footer-bottom clearfix">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-center">
                <div class="copytext mb-3 mb-md-0">Copyright &copy; 2025 Nari18. All Rights Reserved.</div>
                <ul class="payment-icons">
                    <li><i class="fab fa-cc-visa"></i></li>
                    <li><i class="fab fa-cc-mastercard"></i></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--End Footer-->

<!-- WhatsApp Floating Icon -->
<a href="https://wa.me/918826446755" target="_blank"
    style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; background-color: #25D366; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="24" height="24">
</a>


<!--Scoll Top-->
<div id="site-scroll"><i class="icon anm anm-arw-up"></i></div>
<!--End Scoll Top-->

<!--MiniCart Drawer-->
<div id="minicart-drawer" class="minicart-right-drawer offcanvas offcanvas-end" tabindex="-1">

    <div id="cart-drawer" class="block block-cart">
        <?php
        if (!empty($_SESSION['cart'])) {
        ?>
            <div class="minicart-header">
                <button class="close-cart border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></button>
                <h4 class="fs-6">Your cart (<?php echo $_SESSION['qnty']; ?> Items)</h4>
            </div>
        <?php } else { ?>
            <div class="minicart-header">
                <button class="close-cart border-0" data-bs-dismiss="offcanvas" aria-label="Close"><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="left" title="Close"></i></button>
                <h4 class="fs-6">Your cart (0 Items)</h4>
            </div>
        <?php } ?>
        <div class="minicart-content">
            <ul class="m-0 clearfix">

                <?php
                if (!empty($_SESSION['cart'])) {
                ?>

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
                                    <img class="blur-up lazyload" data-src="admin/productimages/<?php echo $row['id']; ?>/<?php echo $row['productImage1']; ?>" alt="product" title="Product" width="120" height="170" />
                                </a>
                                <div class="product-details">
                                    <a class="product-title" href="product-details.php?pid=<?php echo $row['id']; ?>"><?php echo $row['productName']; ?></a>
                                    <div class="priceRow">
                                        <div class="product-price">
                                            <strong> RS - <span class="price"><?php echo ($row['productPrice'] + $row['shippingCharge']); ?>*<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?></span></strong>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="qtyDetail text-center">
                                                    <div class="qtyField">
                                                        <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                                                        <input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]" pattern="[0-9]*" class="qty">
                                                        <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                                                    </div>
                                                    <a href="#" class="remove" ><i class="icon anm anm-times-r" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"></i></a>
                                                </div> -->
                            </li>


                    <?php }
                    } ?>


            </ul>
        </div>
        <div class="minicart-bottom">

            <div class="subtotal clearfix my-3">
                <div class="totalInfo clearfix"><span>Total:</span><span class="item product-price"><?php echo $_SESSION['tp'] = "$totalprice" . ".00"; ?> </span></div>


            </div>
            <div class="minicart-action d-flex mt-3">
                <a href="index.php" class="proceed-to-checkout btn btn-primary w-50 me-1">Continue Shopping</a>
                <a href="my-cart.php" class="cart-btn btn btn-secondary w-50 ms-1">View Cart</a>
            </div>
        </div>
    </div>
    <!--MiniCart Content-->
</div>

<?php } else { ?>

    <div id="cartEmpty" class="cartEmpty d-flex-justify-center flex-column text-center p-3 text-muted ">
        <div class="cartEmpty-content mt-4">
            <i class="icon anm anm-cart-l fs-1 text-muted"></i>
            <p class="my-3">No Products in the Cart</p>
            <a href="index.php" class="btn btn-primary cart-btn">Continue shopping</a>
        </div>
    </div>

<?php } ?>
<!--End MiniCart Drawer-->


<!-- Including Jquery/Javascript -->
<!-- Plugins JS -->
<script src="assets/js/plugins.js"></script>
<!-- Main JS -->
<script src="assets/js/main.js"></script>

</div>


<!--End Page Wrapper-->
</body>

</html>
